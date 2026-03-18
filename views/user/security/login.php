<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View            $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module         $module
 */

$this->title = 'Iniciar sesión';
?>
<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="container-fuild">
    <!-- Start Content -->
    <div class="w-100 overflow-hidden position-relative flex-wrap d-block vh-100">

        <!-- start row -->
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="d-lg-block align-items-center justify-content-center d-none flex-wrap p-4 position-relative h-100 z-0 bg-primary">
                    <div class="mx-auto mb-4 text-center">
                        <a href="<?= Url::to(['/']) ?>">
                            <img src="<?= Url::to('@web/assets/img/logo.svg') ?>" class="img-fluid" alt="Logo" style="height: 120px;">
                        </a>
                    </div>

                    <div class="mb-3">
                        <h4 class="login-line position-relative pb-2 text-white fw-bold text-center mb-2">Tu trabajo de hoy impulsa tu futuro</h4>
                        <p class="text-light fw-normal text-center mb-3">Cada jornada cuenta. Hazlo con constancia, enfoque y orgullo <br> y verás resultados.</p>
                    </div>

                    <div class="position-absolute bottom-0 start-50 translate-middle-x z-1 login-laptop">
                        <img src="/assets/img/bg/alarm-clock.svg" class="img-fluid" alt="Img">
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-6 col-md-12 col-sm-12">
                <!-- start row -->
                <div class="row justify-content-center align-items-center overflow-auto flex-wrap vh-100">
                    <div class="col-md-10 col-sm-10 mx-auto">
                        <div class="d-flex flex-column justify-content-between p-3">
                            <div class="login-item">
                                <div class="text-center mb-3">
                                    <h3 class="mb-2"><?= Html::encode($this->title) ?></h3>
                                    <p class="mb-0">Por favor, ingresa tus datos para iniciar sesión</p>
                                </div>

                                <?php $form = ActiveForm::begin([
                                    'id' => $model->formName(),
                                    'enableAjaxValidation' => true,
                                    'enableClientValidation' => false,
                                    'validateOnBlur' => false,
                                    'validateOnType' => false,
                                    'validateOnChange' => false,
                                    'fieldConfig' => [
                                        'template' => "{label}\n{input}\n{error}",
                                        'labelOptions' => ['class' => 'form-label'],
                                        'inputOptions' => ['class' => 'form-control'],
                                        'errorOptions' => ['class' => 'invalid-feedback d-block'],
                                    ],
                                ]); ?>

                                <div class="mb-3">
                                    <?= $form->field($model, 'login', [
                                        'inputOptions' => [
                                            'autofocus' => true,
                                            'placeholder' => 'Usuario o email',
                                            'tabindex' => '1',
                                            'value' => 'seed.admin',
                                        ],
                                    ])->label('Email') ?>
                                </div>

                                <div class="mb-3">
                                    <?= $form->field($model, 'password', [
                                        'inputOptions' => [
                                            'placeholder' => 'Contraseña',
                                            'tabindex' => '2',
                                            'value' => 'Admin123!',
                                        ],
                                    ])->passwordInput()->label('Contraseña') ?>
                                </div>

                                <div>
                                    <?= Html::submitButton('Iniciar sesión', [
                                        'class' => 'btn btn-primary w-100',
                                        'name' => 'login-button',
                                        'tabindex' => '3',
                                    ]) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- End Content -->
</div>