<?php

namespace app\controllers\user;

use app\components\TenantContext;
use app\models\Profile;
use app\models\User;
use Da\User\Event\UserEvent;
use Da\User\Factory\MailFactory;
use Da\User\Filter\AccessRuleFilter;
use Da\User\Query\UserQuery;
use Da\User\Search\UserSearch;
use Da\User\Service\UserCreateService;
use Da\User\Validator\AjaxRequestModelValidator;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Extiende el AdminController de 2amigos para soportar empresas_id, num_doc y perfil en un solo formulario.
 * Incluye acción create-ajax para guardar vía AJAX desde modal.
 */
class AdminController extends \Da\User\Controller\AdminController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs']['actions']['create-ajax'] = ['post'];
        return $behaviors;
    }

    /**
     * Crea usuario vía AJAX (para modal). Devuelve JSON.
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        /** @var User $user */
        $user = Yii::createObject(User::class, [['scenario' => 'create']]);

        $post = Yii::$app->request->post();
        $user->load($post, 'User');

        // Datos del perfil para afterSave
        $user->pendingProfileData = [
            'empresas_id' => TenantContext::requireEmpresaId(),
            'num_doc' => $post['Profile']['num_doc'] ?? '0000000',
            'name' => $post['Profile']['name'] ?? $user->username,
            'tipo_doc' => $post['Profile']['tipo_doc'] ?? Profile::TIPO_DOC_CC,
            'estado' => $post['Profile']['estado'] ?? Profile::ESTADO_ACTIVO,
            'telefono' => $post['Profile']['telefono'] ?? null,
            'position' => $post['Profile']['position'] ?? null,
        ];

        if (!$user->validate()) {
            return [
                'success' => false,
                'errors' => $user->getErrors(),
            ];
        }

        $event = Yii::createObject(UserEvent::class, [$user]);
        $this->trigger(UserEvent::EVENT_BEFORE_CREATE, $event);

        $mailService = null;
        try {
            $mailService = MailFactory::makeWelcomeMailerService($user);
        } catch (\Throwable $e) {
            Yii::warning('Welcome mail service skipped: ' . $e->getMessage(), 'usuario');
        }
        $service = Yii::createObject(UserCreateService::class, [$user, $mailService]);

        if ($service->run()) {
            $this->trigger(UserEvent::EVENT_AFTER_CREATE, $event);
            return [
                'success' => true,
                'message' => Yii::t('usuario', 'User has been created'),
                'id' => $user->id,
            ];
        }

        $errors = $user->getErrors();
        if (empty($errors)) {
            $errors = ['general' => [Yii::t('usuario', 'User account could not be created.')]];
        }
        return ['success' => false, 'errors' => $errors];
    }

    /**
     * {@inheritdoc}
     * Añade pendingProfileData antes de crear el usuario.
     */
    public function actionCreate()
    {
        /** @var User $user */
        $user = $this->make(User::class, [], ['scenario' => 'create']);

        $event = $this->make(UserEvent::class, [$user]);
        $this->make(AjaxRequestModelValidator::class, [$user])->validate();

        if ($user->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $user->pendingProfileData = [
                'empresas_id' => TenantContext::requireEmpresaId(),
                'num_doc' => $post['Profile']['num_doc'] ?? '0000000',
                'name' => $post['Profile']['name'] ?? $user->username,
                'tipo_doc' => $post['Profile']['tipo_doc'] ?? Profile::TIPO_DOC_CC,
                'estado' => $post['Profile']['estado'] ?? Profile::ESTADO_ACTIVO,
                'telefono' => $post['Profile']['telefono'] ?? null,
                'position' => $post['Profile']['position'] ?? null,
            ];

            if (!$user->validate()) {
                Yii::$app->session->setFlash('danger', Yii::t('usuario', 'Please fix the errors below.'));
            } else {
                $this->trigger(UserEvent::EVENT_BEFORE_CREATE, $event);
                $mailService = null;
                try {
                    $mailService = MailFactory::makeWelcomeMailerService($user);
                } catch (\Throwable $e) {
                    Yii::warning('Welcome mail service skipped: ' . $e->getMessage(), 'usuario');
                }

                if ($this->make(UserCreateService::class, [$user, $mailService])->run()) {
                    Yii::$app->getSession()->setFlash('success', Yii::t('usuario', 'User has been created'));
                    $this->trigger(UserEvent::EVENT_AFTER_CREATE, $event);
                    return $this->redirect(['update', 'id' => $user->id]);
                }
                $errs = $user->getErrors();
                $msg = !empty($errs)
                    ? implode(' ', array_map(fn ($e) => implode(', ', $e), $errs))
                    : Yii::t('usuario', 'User account could not be created.');
                Yii::$app->session->setFlash('danger', $msg);
            }
        }

        return $this->render('create', ['user' => $user]);
    }

    /**
     * {@inheritdoc}
     * Asegura que el Profile tenga empresas_id y num_doc al crear uno nuevo.
     */
    public function actionUpdateProfile($id)
    {
        /** @var User $user */
        $user = $this->userQuery->where(['id' => $id])->one();
        /** @var Profile $profile */
        $profile = $user->profile;
        if ($profile === null) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->empresas_id = TenantContext::requireEmpresaId();
            $profile->num_doc = '0000000';
            $profile->tipo_doc = Profile::TIPO_DOC_CC;
            $profile->estado = Profile::ESTADO_ACTIVO;
            $profile->save(false);
        }
        return parent::actionUpdateProfile($id);
    }

    /**
     * Devuelve el HTML del formulario para el modal (AJAX).
     */
    public function actionCreateForm()
    {
        /** @var User $user */
        $user = $this->make(User::class, [], ['scenario' => 'create']);
        $profile = new Profile();
        $profile->loadDefaultValues();
        $profile->empresas_id = TenantContext::requireEmpresaId();

        return $this->renderPartial('@app/views/user/admin/_create_modal_form', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }
}
