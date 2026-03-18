<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Mi perfil';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$viewAjaxUrl = Url::to(['profile/view-ajax']);
$formAjaxUrl = Url::to(['profile/form-ajax']);
$updateAjaxUrl = Url::to(['profile/update-ajax']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;
?>

<div class="page-wrapper">
    <div class="card mb-0">
        <div class="card-body">
            <!-- start row -->
            <div class="row">
                <div class="col-xl-12">
                    <!-- Page Header -->
                    <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                        <div class="flex-grow-1">
                            <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <div class="card flex-fill mb-0 border shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-end mb-3">
                                <button type="button" class="btn btn-primary" id="btn-edit-profile">
                                    <i class="ti ti-edit me-1"></i>Editar perfil
                                </button>
                            </div>

                            <!-- Contenedor del perfil (cargado por AJAX) -->
                            <div id="profile-content">
                                <div class="text-center py-5">
                                    <span class="spinner-border text-primary" role="status"></span>
                                    <p class="mt-2 mb-0 text-muted">Cargando perfil...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Perfil -->
<div class="modal fade" id="modal-edit-profile">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-edit-profile-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-save-profile">
                    <span class="btn-text">Guardar</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).ready(function() {
    function loadProfile() {
        $('#profile-content').html('<div class="text-center py-5"><span class="spinner-border text-primary"></span><p class="mt-2 mb-0 text-muted">Cargando perfil...</p></div>');
        $.get('{$viewAjaxUrl}', function(html) {
            $('#profile-content').html(html);
        }).fail(function() {
            $('#profile-content').html('<div class="alert alert-danger">Error al cargar el perfil. <a href="javascript:void(0);" onclick="location.reload()">Reintentar</a></div>');
        });
    }

    loadProfile();

    $('#btn-edit-profile').on('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-profile'));
        $('#modal-edit-profile-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        modal.show();
        $.get('{$formAjaxUrl}', function(html) {
            $('#modal-edit-profile-body').html(html);
        }).fail(function() {
            $('#modal-edit-profile-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $(document).on('click', '#btn-save-profile', function() {
        var \$form = $('#form-edit-profile-modal');
        var \$btn = $(this);
        var \$errors = $('#profile-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        $.ajax({
            url: '{$updateAjaxUrl}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal-edit-profile'));
                    modal.hide();
                    loadProfile();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ title: 'Guardado', text: res.message || 'Perfil actualizado correctamente.', icon: 'success', timer: 2000, showConfirmButton: false });
                    } else {
                        alert(res.message || 'Perfil actualizado correctamente.');
                    }
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            var arr = res.errors[k];
                            errors.push(Array.isArray(arr) ? arr.join(' ') : arr);
                        }
                    }
                    \$errors.html(errors.join('<br>')).removeClass('d-none');
                }
            },
            error: function() {
                \$errors.html('Error al guardar. Intente nuevamente.').removeClass('d-none');
            },
            complete: function() {
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>