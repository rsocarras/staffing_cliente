<?php

namespace app\controllers;

use app\components\ContratoFormSupport;
use app\components\ProfileFormOptionsProvider;
use app\components\TenantContext;
use app\models\Contrato;
use app\models\LocationSedes;
use app\models\Profile;
use app\models\ProfileSede;
use app\models\User;
use app\services\AdministracionPlantaService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Gestión de usuarios (lista, edición, activar/inactivar).
 */
class UserManagementController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->layout = 'main';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create-ajax' => ['POST'],
                    'update-ajax' => ['POST'],
                    'create-user-contrato' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Listado de usuarios.
     */
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        $allRoles = $auth->getRoles();
        $modelAdd = new User();
        $modelAdd->setScenario('create');
        $profileAdd = new Profile();
        $profileAdd->setScenario(Profile::SCENARIO_USER_MANAGEMENT);
        $eid = TenantContext::currentEmpresaId();
        if ($eid !== null) {
            $profileAdd->empresas_id = $eid;
        }
        $profileAdd->tipo_doc = Profile::TIPO_DOC_CC;
        $profileAdd->estado = Profile::ESTADO_ACTIVO;
        $profileFormOptions = $this->getProfileFormOptions();
        $profileFormOptions['empresaId'] = $eid;

        $baseQuery = $this->tenantUsersQuery();
        $summaryCounts = [
            'total' => (int) (clone $baseQuery)->count(),
            'activos' => (int) (clone $baseQuery)->andWhere(['u.blocked_at' => null])->count(),
            'inactivos' => (int) (clone $baseQuery)->andWhere(['not', ['u.blocked_at' => null]])->count(),
        ];

        return $this->render('index', [
            'allRoles' => $allRoles,
            'modelAdd' => $modelAdd,
            'profileAdd' => $profileAdd,
            'profileFormOptions' => $profileFormOptions,
            'summaryCounts' => $summaryCounts,
        ]);
    }

    /**
     * Detalle usuario: pestañas Perfil y Contrato (contrato tras existir perfil).
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $profile = Profile::find()
            ->where(['user_id' => (int) $model->id])
            ->with(['empresas', 'area', 'cargo', 'sede', 'locationSede', 'centroCosto', 'centroUtilidad'])
            ->one();
        if ($profile === null) {
            throw new NotFoundHttpException('El usuario no tiene perfil asociado.');
        }

        $auth = Yii::$app->authManager;
        $allRoles = $auth->getRoles();
        $model->roleNames = array_keys($auth->getAssignments((string) $model->id));

        $empresaId = TenantContext::requireEmpresaId();
        $profileFormOptions = $this->getProfileFormOptions();
        $profileFormOptions['empresaId'] = $empresaId;

        $contratos = Contrato::find()
            ->where(['empresa_id' => $empresaId, 'profile_id' => (int) $model->id])
            ->with(['contratoTipo', 'area', 'cargo'])
            ->orderBy(['fecha_inicio' => SORT_DESC])
            ->all();

        $contratoNew = new Contrato();
        $contratoNew->empresa_id = $empresaId;
        $contratoNew->profile_id = (int) $model->id;
        $contratoNew->estado = Contrato::ESTADO_ACTIVO;
        $contratoNew->fecha_inicio = date('Y-m-d');
        $planta = new AdministracionPlantaService();
        $contratoOptions = ContratoFormSupport::buildFormOptions($contratoNew, $planta);

        return $this->render('view', [
            'model' => $model,
            'profile' => $profile,
            'allRoles' => $allRoles,
            'profileFormOptions' => $profileFormOptions,
            'contratos' => $contratos,
            'contratoNew' => $contratoNew,
            'contratoOptions' => $contratoOptions,
            'canManageContratos' => ContratoFormSupport::currentUserCanManageContratos(),
        ]);
    }

    public function actionCreateUserContrato($id)
    {
        if (!ContratoFormSupport::currentUserCanManageContratos()) {
            throw new ForbiddenHttpException('No tiene permiso para crear contratos.');
        }

        $user = $this->findModel($id);
        $profile = $user->profile;
        if ($profile === null) {
            throw new NotFoundHttpException('El usuario no tiene perfil asociado.');
        }

        $empresaId = TenantContext::requireEmpresaId();
        $contrato = new Contrato();
        $contrato->empresa_id = $empresaId;
        $contrato->profile_id = (int) $user->id;
        $contrato->load(Yii::$app->request->post());

        if ($contrato->save()) {
            Yii::$app->session->setFlash('success', 'Contrato creado correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo crear el contrato: ' . implode(' ', $contrato->getFirstErrors()));
        }

        $returnTo = (string) Yii::$app->request->post('_return_to', '');
        if ($returnTo === 'empleados') {
            return $this->redirect(Url::to(['/empleados/index']));
        }

        return $this->redirect(['view', 'id' => $user->id]);
    }

    /**
     * JSON para DataTables server-side (usuarios).
     */
    public function actionData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $searchValue = trim($request->get('search', [])['value'] ?? '');
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 1);
        $orderDir = (strtolower($request->get('order', [])[0]['dir'] ?? 'asc') === 'desc') ? SORT_DESC : SORT_ASC;
        $auth = Yii::$app->authManager;

        $query = $this->tenantUsersQuery();
        $totalCount = (int) (clone $query)->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'u.username', $searchValue],
                ['like', 'u.email', $searchValue],
                ['like', 'p.telefono', $searchValue],
            ]);
        }
        $filteredCount = (int) (clone $query)->count();

        $orderColumns = [null, 'username', 'email', 'created_at', null, null, 'blocked_at'];
        $orderBy = $orderColumns[$orderCol] ?? 'username';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir === SORT_DESC ? SORT_DESC : SORT_ASC]);
        } else {
            $query->orderBy(['username' => SORT_ASC]);
        }

        $users = $query->offset($start)->limit($length <= 0 ? 100 : $length)->all();
        $data = [];
        foreach ($users as $u) {
            $roles = $auth->getAssignments((string) $u->id);
            $roleNames = array_keys($roles);
            $active = empty($u->blocked_at);
            $confirmed = !empty($u->confirmed_at);
            $data[] = [
                '',
                '<div class="d-flex align-items-center file-name-icon">' .
                    '<span class="avatar avatar-md avatar-rounded bg-primary text-white d-flex align-items-center justify-content-center">' .
                    strtoupper(mb_substr($u->username, 0, 1)) . '</span>' .
                    '<div class="ms-2"><h6 class="fw-medium mb-0">' . Html::encode($u->username) . '</h6></div></div>',
                Html::encode($u->email ?? '—'),
                $u->created_at ? date('d M Y', $u->created_at) : '—',
                $this->formatRolesColumn($roleNames),
                $confirmed
                    ? '<span class="badge badge-soft-success badge-xs"><i class="ti ti-check me-1"></i>Sí</span>'
                    : '<span class="badge badge-soft-danger badge-xs"><i class="ti ti-x me-1"></i>No</span>',
                $active
                    ? '<span class="badge badge-soft-success badge-xs"><i class="ti ti-point-filled me-1"></i>Activo</span>'
                    : '<span class="badge badge-soft-danger badge-xs"><i class="ti ti-point-filled me-1"></i>Inactivo</span>',
                $this->renderPartial('_user_actions_dropdown', [
                    'id' => $u->id,
                    'username' => $u->username,
                    'active' => $active,
                ]),
            ];
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ];
    }

    private function formatRolesColumn(array $roleNames): string
    {
        if (empty($roleNames)) {
            return '<span class="badge badge-soft-secondary">—</span>';
        }
        $out = '';
        foreach (array_values($roleNames) as $i => $r) {
            $out .= '<span class="badge badge-soft-primary me-1">' . Html::encode($r) . '</span>';
        }
        return $out;
    }

    /**
     * Formulario HTML para editar usuario (modal Ajax).
     */
    public function actionFormAjax($id)
    {
        $model = $this->findModel($id);
        $auth = Yii::$app->authManager;
        $allRoles = $auth->getRoles();
        $assigned = $auth->getAssignments((string) $model->id);
        $model->roleNames = array_keys($assigned);
        $profile = Profile::find()
            ->where(['user_id' => (int) $model->id])
            ->one();
        if ($profile === null) {
            $profile = new Profile();
            $profile->user_id = (int) $model->id;
        }
        $profile->setScenario(Profile::SCENARIO_USER_MANAGEMENT);
        if ($profile->empresas_id === null && ($eid = TenantContext::currentEmpresaId()) !== null) {
            $profile->empresas_id = $eid;
        }
        $empresaIdForForm = $this->resolveEmpresaIdForProfile($profile);
        $profileFormOptions = ProfileFormOptionsProvider::forEmpresaId($empresaIdForForm);
        $profileFormOptions['empresaId'] = $empresaIdForForm;
        $profileSedeIds = ProfileSede::locationSedeIdsForProfileModel($profile);
        $sedesMap = $this->buildSedesMapForTenant($empresaIdForForm);

        return $this->renderPartial('_user_form_modal', [
            'model' => $model,
            'profile' => $profile,
            'profileFormOptions' => $profileFormOptions,
            'allRoles' => $allRoles,
            'profileSedeIds' => $profileSedeIds,
            'sedesMap' => $sedesMap,
        ]);
    }

    /**
     * Crear usuario por Ajax. Retorna JSON.
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $auth = Yii::$app->authManager;
        $empresaId = TenantContext::requireEmpresaId();
        $upload = UploadedFile::getInstanceByName('Profile[photoFile]');

        $profileCandidate = new Profile();
        $profileCandidate->setScenario(Profile::SCENARIO_USER_MANAGEMENT);
        $profileCandidate->photoFile = $upload;
        $profilePost = Yii::$app->request->post('Profile', []);
        $profileCandidate->load($this->normalizeProfilePost($profilePost, $empresaId), '');
        if (!$profileCandidate->validate()) {
            return ['success' => false, 'errors' => $profileCandidate->getErrors()];
        }

        $model = new User();
        $model->setScenario('create');
        $model->load(Yii::$app->request->post());
        $post = Yii::$app->request->post('User', []);
        $model->pendingProfileData = $this->profileToPendingArray($profileCandidate);
        if (array_key_exists('isConfirmed', $post)) {
            $model->confirmed_at = (!empty($post['isConfirmed'])) ? time() : null;
        }
        $model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password ?: bin2hex(random_bytes(8)));
        $model->auth_key = Yii::$app->security->generateRandomString();
        if (!$model->validate()) {
            return ['success' => false, 'errors' => $model->getErrors()];
        }
        if (!$model->save(false)) {
            return ['success' => false, 'errors' => ['general' => ['No se pudo guardar el usuario.']]];
        }
        $freshUpload = UploadedFile::getInstanceByName('Profile[photoFile]');
        $this->handleProfileAvatarUpload((int) $model->id, $freshUpload);

        $roleNames = is_array($model->roleNames) ? $model->roleNames : [];
        foreach ($roleNames as $name) {
            $role = $auth->getRole($name);
            if ($role) {
                $auth->assign($role, (string) $model->id);
            }
        }

        return ['success' => true];
    }

    /**
     * Crear usuario (página completa, se mantiene por compatibilidad).
     */
    public function actionCreate()
    {
        $model = new User();
        $model->setScenario('create');
        $auth = Yii::$app->authManager;
        $allRoles = $auth->getRoles();

        $empresaId = TenantContext::currentEmpresaId();
        $profileForm = new Profile();
        $profileForm->setScenario(Profile::SCENARIO_USER_MANAGEMENT);
        if ($empresaId !== null) {
            $profileForm->empresas_id = $empresaId;
        }
        $profileForm->tipo_doc = Profile::TIPO_DOC_CC;
        $profileForm->estado = Profile::ESTADO_ACTIVO;

        if (Yii::$app->request->isPost) {
            $upload = UploadedFile::getInstanceByName('Profile[photoFile]');
            $profileForm->photoFile = $upload;
            $profileForm->load($this->normalizeProfilePost(Yii::$app->request->post('Profile', []), (int) TenantContext::requireEmpresaId()), '');

            $model->load(Yii::$app->request->post());
            $post = Yii::$app->request->post('User', []);
            $model->pendingProfileData = $this->profileToPendingArray($profileForm);
            if (array_key_exists('isConfirmed', $post)) {
                $model->confirmed_at = (!empty($post['isConfirmed'])) ? time() : null;
            }
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password ?: bin2hex(random_bytes(8)));
            $model->auth_key = Yii::$app->security->generateRandomString();

            if ($profileForm->validate() && $model->validate() && $model->save(false)) {
                $this->handleProfileAvatarUpload((int) $model->id, UploadedFile::getInstanceByName('Profile[photoFile]'));
                $roleNames = is_array($model->roleNames) ? $model->roleNames : [];
                foreach ($roleNames as $name) {
                    $role = $auth->getRole($name);
                    if ($role) {
                        $auth->assign($role, (string) $model->id);
                    }
                }
                Yii::$app->session->setFlash('success', 'Usuario creado correctamente.');
                return $this->redirect(['index']);
            }
        }

        $profileOpts = $this->getProfileFormOptions();
        $profileOpts['empresaId'] = $empresaId;

        return $this->render('create', [
            'model' => $model,
            'profile' => $profileForm,
            'profileFormOptions' => $profileOpts,
            'allRoles' => $allRoles,
        ]);
    }

    /**
     * Actualizar usuario por Ajax. Retorna JSON.
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $auth = Yii::$app->authManager;
        $allRoles = $auth->getRoles();
        $profile = $model->profile;
        if ($profile === null) {
            return ['success' => false, 'errors' => ['general' => ['El usuario no tiene perfil.']]];
        }
        $empresaId = $this->resolveEmpresaIdForProfile($profile);
        $profile->setScenario(Profile::SCENARIO_USER_MANAGEMENT);
        $upload = UploadedFile::getInstanceByName('Profile[photoFile]');
        $profile->photoFile = $upload;
        $profile->load($this->normalizeProfilePost(Yii::$app->request->post('Profile', []), $empresaId), '');
        if (!$profile->validate()) {
            return ['success' => false, 'errors' => $profile->getErrors()];
        }

        $model->setScenario('update');
        $model->load(Yii::$app->request->post());
        $post = Yii::$app->request->post('User', []);
        if (array_key_exists('isConfirmed', $post)) {
            $model->confirmed_at = (!empty($post['isConfirmed'])) ? time() : null;
        }
        if ($model->new_password !== '') {
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password);
        }
        if (!$model->validate()) {
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save(false)) {
                $tx->rollBack();
                return ['success' => false, 'errors' => ['general' => ['No se pudo guardar.']]];
            }
            if (!$profile->save(false)) {
                $tx->rollBack();
                return ['success' => false, 'errors' => $profile->getErrors()];
            }
            $this->syncProfileSedes($profile, $this->resolveEmpresaIdForProfile($profile), Yii::$app->request->post('Profile', [])['profile_sede_ids'] ?? []);
            $tx->commit();
        } catch (\Throwable $e) {
            $tx->rollBack();
            Yii::error($e->getMessage(), __METHOD__);

            return ['success' => false, 'errors' => ['general' => ['Error al guardar datos del perfil o sedes.']]];
        }

        $this->handleProfileAvatarUpload((int) $model->id, UploadedFile::getInstanceByName('Profile[photoFile]'));

        $roleNames = is_array($model->roleNames) ? $model->roleNames : [];
        foreach (array_keys($allRoles) as $name) {
            $role = $auth->getRole($name);
            if (!$role) {
                continue;
            }
            $has = in_array($name, $roleNames, true);
            $assigned = $auth->getAssignment($name, (string) $model->id);
            if ($has && !$assigned) {
                $auth->assign($role, (string) $model->id);
            } elseif (!$has && $assigned) {
                $auth->revoke($role, (string) $model->id);
            }
        }

        return ['success' => true];
    }

    /**
     * Empresa para listas (sedes, cargos, …) y validación de sedes: prioriza {@see Profile::empresas_id}.
     */
    private function resolveEmpresaIdForProfile(Profile $profile): int
    {
        if ($profile->empresas_id !== null && (int) $profile->empresas_id > 0) {
            return (int) $profile->empresas_id;
        }

        return TenantContext::requireEmpresaId();
    }

    /**
     * Editar usuario (página completa, se mantiene por compatibilidad).
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $auth = Yii::$app->authManager;
        $allRoles = $auth->getRoles();
        $assigned = $auth->getAssignments((string)$model->id);
        $assignedNames = array_keys($assigned);

        $profile = $model->profile;
        if ($profile === null) {
            throw new NotFoundHttpException('El usuario no tiene perfil.');
        }
        $profile->setScenario(Profile::SCENARIO_USER_MANAGEMENT);

        if (Yii::$app->request->isPost) {
            $empresaId = $this->resolveEmpresaIdForProfile($profile);
            $profile->photoFile = UploadedFile::getInstanceByName('Profile[photoFile]');
            $profile->load($this->normalizeProfilePost(Yii::$app->request->post('Profile', []), $empresaId), '');

            $model->setScenario('update');
            $model->load(Yii::$app->request->post());
            $post = Yii::$app->request->post('User', []);
            if (array_key_exists('isConfirmed', $post)) {
                $model->confirmed_at = (!empty($post['isConfirmed'])) ? time() : null;
            }
            if ($model->new_password !== '') {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password);
            }

            if ($profile->validate() && $model->validate()) {
                $saved = false;
                $tx = Yii::$app->db->beginTransaction();
                try {
                    if (!$model->save(false)) {
                        $tx->rollBack();
                        Yii::$app->session->setFlash('error', 'No se pudo guardar el usuario.');
                    } elseif (!$profile->save(false)) {
                        $tx->rollBack();
                        Yii::$app->session->setFlash('error', 'No se pudo guardar el perfil.');
                    } else {
                        $this->syncProfileSedes($profile, $this->resolveEmpresaIdForProfile($profile), Yii::$app->request->post('Profile', [])['profile_sede_ids'] ?? []);
                        $tx->commit();
                        $saved = true;
                    }
                } catch (\Throwable $e) {
                    if ($tx->isActive) {
                        $tx->rollBack();
                    }
                    Yii::error($e->getMessage(), __METHOD__);
                    Yii::$app->session->setFlash('error', 'Error al guardar.');
                    return $this->redirect(['update', 'id' => $model->id]);
                }
                if ($saved) {
                    $this->handleProfileAvatarUpload((int) $model->id, UploadedFile::getInstanceByName('Profile[photoFile]'));
                    $roleNames = is_array($model->roleNames) ? $model->roleNames : [];
                    foreach (array_keys($allRoles) as $name) {
                        $role = $auth->getRole($name);
                        if (!$role) {
                            continue;
                        }
                        $has = in_array($name, $roleNames, true);
                        $assigned = $auth->getAssignment($name, (string) $model->id);
                        if ($has && !$assigned) {
                            $auth->assign($role, (string) $model->id);
                        } elseif (!$has && $assigned) {
                            $auth->revoke($role, (string) $model->id);
                        }
                    }
                    Yii::$app->session->setFlash('success', 'Usuario actualizado correctamente.');
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->roleNames = $assignedNames;
        }

        $empresaIdForForm = $this->resolveEmpresaIdForProfile($profile);
        $profileOpts = ProfileFormOptionsProvider::forEmpresaId($empresaIdForForm);
        $profileOpts['empresaId'] = $empresaIdForForm;
        $profileSedeIds = ProfileSede::locationSedeIdsForProfileModel($profile);
        $sedesMap = $this->buildSedesMapForTenant($empresaIdForForm);

        return $this->render('update', [
            'model' => $model,
            'profile' => $profile,
            'profileFormOptions' => $profileOpts,
            'allRoles' => $allRoles,
            'profileSedeIds' => $profileSedeIds,
            'sedesMap' => $sedesMap,
        ]);
    }

    /**
     * Activar o inactivar usuario (toggle blocked_at). Retorna JSON si es Ajax.
     */
    public function actionBlock($id)
    {
        $model = $this->findModel($id);
        $model->blocked_at = $model->blocked_at ? null : time();
        $model->save(false);
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }
        Yii::$app->session->setFlash('success', $model->blocked_at ? 'Usuario inactivado.' : 'Usuario activado.');
        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @return User
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = $this->tenantUsersQuery()
            ->andWhere(['u.id' => $id])
            ->one();
        if ($model === null) {
            throw new NotFoundHttpException('Usuario no encontrado.');
        }
        return $model;
    }

    private function tenantUsersQuery()
    {
        $query = User::find()
            ->alias('u')
            ->innerJoinWith(['profile p']);
        TenantContext::applyFilter($query, 'p.empresas_id');

        return $query;
    }

    private function normalizeProfilePost(array $post, int $empresaId): array
    {
        $post['empresas_id'] = $empresaId;
        $intKeys = [
            'empresas_id',
            'sede_id',
            'location_sede_id',
            'cargo_id',
            'centro_costo_id',
            'centro_utilidad_id',
            'area_id',
        ];
        foreach ($intKeys as $k) {
            if (!array_key_exists($k, $post)) {
                continue;
            }
            $v = $post[$k];
            if ($v === '' || $v === null) {
                $post[$k] = null;
            } else {
                $post[$k] = (int) $v;
            }
        }

        return $post;
    }

    private function profileToPendingArray(Profile $profile): array
    {
        $out = [];
        foreach (Profile::persistableAttributeNames() as $attr) {
            $out[$attr] = $profile->getAttribute($attr);
        }

        return $out;
    }

    private function getProfileFormOptions(): array
    {
        $eid = TenantContext::currentEmpresaId();
        $opts = ProfileFormOptionsProvider::forEmpresaId($eid);
        $opts['empresaId'] = $eid;

        return $opts;
    }

    private function handleProfileAvatarUpload(int $userId, ?UploadedFile $file): void
    {
        if ($file === null || $file->error !== UPLOAD_ERR_OK) {
            return;
        }
        $profile = Profile::findOne(['user_id' => $userId]);
        if ($profile === null) {
            return;
        }
        $dir = Yii::getAlias('@webroot/uploads/profile');
        FileHelper::createDirectory($dir, 0755);
        $ext = strtolower((string) $file->extension);
        if ($ext === '') {
            $ext = 'jpg';
        }
        $rel = 'uploads/profile/profile_' . $userId . '_' . time() . '.' . $ext;
        $full = Yii::getAlias('@webroot/' . $rel);
        if ($file->saveAs($full, false)) {
            $profile->photo_ = $rel;
            $profile->save(false);
        }
    }

    /**
     * @return array<int, string> location_sede id => nombre
     */
    private function buildSedesMapForTenant(int $empresaId): array
    {
        $rows = LocationSedes::find()
            ->select(['id', 'nombre'])
            ->where(['empresa_id' => $empresaId, 'activo' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->asArray()
            ->all();
        $map = [];
        foreach ($rows as $row) {
            $map[(int) $row['id']] = (string) $row['nombre'];
        }

        return $map;
    }

    /**
     * Reemplaza las filas en profile_sedes para el perfil; solo acepta sedes activas de la empresa.
     * Usa {@see Profile::getPivotProfileId()} al insertar y borra filas con cualquier profile_id
     * candidato (id vs user_id) para evitar duplicados tras migraciones.
     *
     * @param int[]|string[]|null $rawIds
     */
    private function syncProfileSedes(Profile $profile, int $empresaId, $rawIds): void
    {
        $allowed = LocationSedes::find()
            ->select('id')
            ->where(['empresa_id' => $empresaId, 'activo' => 1])
            ->column();
        $allowedSet = array_flip(array_map('intval', $allowed));

        $ids = [];
        if (is_array($rawIds)) {
            foreach ($rawIds as $v) {
                if ($v === '' || $v === null) {
                    continue;
                }
                $sid = (int) $v;
                if (isset($allowedSet[$sid])) {
                    $ids[$sid] = true;
                }
            }
        }
        $ids = array_keys($ids);

        $pivotId = $profile->getPivotProfileId();
        $candidates = $profile->profileSedePivotProfileIdCandidates();
        if ($candidates !== []) {
            ProfileSede::deleteAll(['profile_id' => $candidates]);
        }

        foreach ($ids as $locationSedeId) {
            $link = new ProfileSede();
            $link->profile_id = $pivotId;
            $link->location_sede_id = $locationSedeId;
            if (!$link->save(false)) {
                throw new \RuntimeException('No se pudo guardar la asignación de sedes.');
            }
        }
    }
}
