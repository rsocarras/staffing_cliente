<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\Profile;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
        return $this->render('index', [
            'allRoles' => $allRoles,
            'modelAdd' => $modelAdd,
        ]);
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
                    ? '<span class="badge badge-success badge-xs"><i class="ti ti-check me-1"></i>Sí</span>'
                    : '<span class="badge badge-secondary badge-xs"><i class="ti ti-x me-1"></i>No</span>',
                $active
                    ? '<span class="badge badge-success badge-xs"><i class="ti ti-point-filled me-1"></i>Activo</span>'
                    : '<span class="badge badge-danger badge-xs"><i class="ti ti-point-filled me-1"></i>Inactivo</span>',
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
        return $this->renderPartial('_user_form_modal', [
            'model' => $model,
            'allRoles' => $allRoles,
        ]);
    }

    /**
     * Crear usuario por Ajax. Retorna JSON.
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new User();
        $model->setScenario('create');
        $auth = Yii::$app->authManager;
        $model->load(Yii::$app->request->post());
        $post = Yii::$app->request->post('User', []);
        $model->pendingProfileData = $this->buildPendingProfileData($model, $post);
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
        $this->syncProfileFromPost($model, $post);
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

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $post = Yii::$app->request->post('User', []);
            $model->pendingProfileData = $this->buildPendingProfileData($model, $post);
            if (array_key_exists('isConfirmed', $post)) {
                $model->confirmed_at = (!empty($post['isConfirmed'])) ? time() : null;
            }
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password ?: bin2hex(random_bytes(8)));
            $model->auth_key = Yii::$app->security->generateRandomString();
            if ($model->validate() && $model->save(false)) {
                $this->syncProfileFromPost($model, $post);
                $roleNames = is_array($model->roleNames) ? $model->roleNames : [];
                foreach ($roleNames as $name) {
                    $role = $auth->getRole($name);
                    if ($role) {
                        $auth->assign($role, (string)$model->id);
                    }
                }
                Yii::$app->session->setFlash('success', 'Usuario creado correctamente.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
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
        if (!$model->save(false)) {
            return ['success' => false, 'errors' => ['general' => ['No se pudo guardar.']]];
        }
        $this->syncProfileFromPost($model, $post);
        $roleNames = is_array($model->roleNames) ? $model->roleNames : [];
        foreach (array_keys($allRoles) as $name) {
            $role = $auth->getRole($name);
            if (!$role) continue;
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
     * Editar usuario (página completa, se mantiene por compatibilidad).
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $auth = Yii::$app->authManager;
        $allRoles = $auth->getRoles();
        $assigned = $auth->getAssignments((string)$model->id);
        $assignedNames = array_keys($assigned);

        if (Yii::$app->request->isPost) {
            $model->setScenario('update');
            $model->load(Yii::$app->request->post());
            $post = Yii::$app->request->post('User', []);
            if (array_key_exists('isConfirmed', $post)) {
                $model->confirmed_at = (!empty($post['isConfirmed'])) ? time() : null;
            }
            if ($model->new_password !== '') {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password);
            }

            if ($model->validate() && $model->save(false)) {
                $this->syncProfileFromPost($model, $post);
                $roleNames = is_array($model->roleNames) ? $model->roleNames : [];
                foreach (array_keys($allRoles) as $name) {
                    $role = $auth->getRole($name);
                    if (!$role) continue;
                    $has = in_array($name, $roleNames, true);
                    $assigned = $auth->getAssignment($name, (string)$model->id);
                    if ($has && !$assigned) {
                        $auth->assign($role, (string)$model->id);
                    } elseif (!$has && $assigned) {
                        $auth->revoke($role, (string)$model->id);
                    }
                }
                Yii::$app->session->setFlash('success', 'Usuario actualizado correctamente.');
                return $this->redirect(['index']);
            }
        } else {
            $model->roleNames = $assignedNames;
        }

        return $this->render('update', [
            'model' => $model,
            'allRoles' => $allRoles,
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

    private function buildPendingProfileData(User $user, array $post): array
    {
        $profile = $user->profile;

        return [
            'empresas_id' => TenantContext::requireEmpresaId(),
            'num_doc' => $profile ? ($profile->num_doc ?? '0000000') : '0000000',
            'name' => $profile ? ($profile->name ?? $user->username) : $user->username,
            'tipo_doc' => $profile ? ($profile->tipo_doc ?? Profile::TIPO_DOC_CC) : Profile::TIPO_DOC_CC,
            'estado' => $profile ? ($profile->estado ?? Profile::ESTADO_ACTIVO) : Profile::ESTADO_ACTIVO,
            'telefono' => $post['phone'] ?? ($profile ? ($profile->telefono ?? null) : null),
            'position' => $profile ? ($profile->position ?? null) : null,
        ];
    }

    private function syncProfileFromPost(User $user, array $post): void
    {
        $profile = $user->profile;
        if ($profile === null) {
            return;
        }

        $profile->empresas_id = TenantContext::requireEmpresaId();
        if (array_key_exists('phone', $post)) {
            $profile->telefono = $post['phone'] !== '' ? (string) $post['phone'] : null;
        }
        $profile->save(false);
    }
}
