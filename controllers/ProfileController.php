<?php

namespace app\controllers;

use app\models\Profile;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * ProfileController - Permite ver y editar únicamente el perfil del usuario logeado.
 * Ruta principal: /profile. Todas las acciones se ejecutan por AJAX.
 */
class ProfileController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'update-ajax' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Página principal del perfil. Carga el contenido vía AJAX.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Retorna HTML del perfil para cargar por AJAX (ver).
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionViewAjax()
    {
        return $this->renderPartial('_view_modal', [
            'model' => $this->getCurrentUserProfile(),
        ]);
    }

    /**
     * Retorna HTML del formulario de edición para cargar por AJAX.
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionFormAjax()
    {
        return $this->renderPartial('_form_modal', [
            'model' => $this->getCurrentUserProfile(),
        ]);
    }

    /**
     * Actualiza el perfil vía AJAX. Retorna JSON.
     *
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionUpdateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->getCurrentUserProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'message' => Yii::t('app', 'Perfil actualizado correctamente.'),
            ];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Obtiene el perfil del usuario actualmente logeado.
     *
     * @return Profile
     * @throws ForbiddenHttpException si no hay usuario logeado
     * @throws NotFoundHttpException si no existe perfil para el usuario
     */
    protected function getCurrentUserProfile()
    {
        $userId = Yii::$app->user->id;
        if (!$userId) {
            throw new ForbiddenHttpException('Debe iniciar sesión para acceder a su perfil.');
        }

        $model = Profile::findOne(['user_id' => $userId]);
        if ($model === null) {
            throw new NotFoundHttpException('No se encontró el perfil.');
        }

        return $model;
    }
}
