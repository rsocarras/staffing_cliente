<?php

namespace app\controllers;

use app\models\Profile;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
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

        if (!$model->load(Yii::$app->request->post())) {
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        $model->photoFile = UploadedFile::getInstance($model, 'photoFile');
        $oldPhoto = $model->getOldAttribute('photo_');
        $newStoredPath = null;

        if ($model->photoFile !== null) {
            if (!$model->validate(['photoFile'])) {
                return ['success' => false, 'errors' => $model->getErrors()];
            }
            $saved = $this->storeProfilePhoto($model, $model->photoFile);
            if ($saved === null) {
                return [
                    'success' => false,
                    'errors' => ['photoFile' => [Yii::t('app', 'No se pudo guardar la imagen.')]],
                ];
            }
            $model->photo_ = $saved;
            $newStoredPath = $saved;
            // saveAs() borra el temporal; si no limpiamos, save() vuelve a validar photoFile y finfo_file falla.
            $model->photoFile = null;
        }

        if (!$model->save()) {
            if ($newStoredPath !== null) {
                $this->removePreviousLocalProfilePhoto($newStoredPath);
                $model->photo_ = $oldPhoto;
            }

            return ['success' => false, 'errors' => $model->getErrors()];
        }

        if ($newStoredPath !== null) {
            $this->removePreviousLocalProfilePhoto($oldPhoto);
        }

        return [
            'success' => true,
            'message' => Yii::t('app', 'Perfil actualizado correctamente.'),
        ];
    }

    /**
     * Guarda la imagen en web/uploads/profile y devuelve la ruta web (/uploads/...).
     */
    private function storeProfilePhoto(Profile $model, UploadedFile $file): ?string
    {
        $dir = Yii::getAlias('@webroot/uploads/profile');
        FileHelper::createDirectory($dir);

        $safeExt = strtolower((string) $file->extension);
        if ($safeExt === '') {
            return null;
        }
        $fileName = 'u' . (int) $model->user_id . '_' . time() . '.' . $safeExt;
        $relative = 'uploads/profile/' . $fileName;
        $fullPath = Yii::getAlias('@webroot/' . $relative);
        if ($file->saveAs($fullPath)) {
            return '/' . $relative;
        }

        return null;
    }

    /**
     * Elimina un archivo previo solo si está bajo uploads/profile (no borra URLs externas).
     */
    private function removePreviousLocalProfilePhoto(?string $oldPath): void
    {
        if ($oldPath === null || $oldPath === '') {
            return;
        }
        if (preg_match('#^https?://#i', $oldPath)) {
            return;
        }
        $normalized = ltrim($oldPath, '/');
        if (!str_starts_with($normalized, 'uploads/profile/')) {
            return;
        }
        $full = Yii::getAlias('@webroot/' . $normalized);
        if (is_file($full)) {
            @unlink($full);
        }
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
