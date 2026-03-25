<?php

declare(strict_types=1);

namespace app\services;

use app\models\Novedad;
use app\models\NovedadConcepto;
use app\models\NovedadConceptoFormCampo;
use app\models\NovedadConceptoFormCamposOpcion;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * Validación y ensamblado de datos del formulario dinámico por concepto (solicitudes).
 */
final class NovedadConceptoFormularioService
{
    /** Tamaño máximo adjunto PDF (5 MB). Ajustar si negocio define otro límite. */
    public const ADJUNTO_PDF_MAX_BYTES = 5 * 1024 * 1024;

    /**
     * @return NovedadConceptoFormCampo[]
     */
    public static function camposOrdenados(?NovedadConcepto $concepto): array
    {
        if ($concepto === null || $concepto->novedad_concepto_form_id === null) {
            return [];
        }

        return NovedadConceptoFormCampo::find()
            ->where(['novedad_concepto_form_id' => (int) $concepto->novedad_concepto_form_id])
            ->with(['opciones'])
            ->orderBy(['orden' => SORT_ASC])
            ->all();
    }

    /**
     * @param array<string, mixed> $postedDatos
     */
    public static function validarCampos(
        Novedad $model,
        NovedadConcepto $concepto,
        array $postedDatos,
        ?UploadedFile $adjuntoPdf
    ): bool {
        $campos = self::camposOrdenados($concepto);
        if ($campos === []) {
            return true;
        }

        $ok = true;
        foreach ($campos as $campo) {
            if (!self::validarUnCampo($model, $concepto, $campo, $postedDatos, $adjuntoPdf)) {
                $ok = false;
            }
        }

        return $ok;
    }

    /**
     * @param array<string, mixed> $postedDatos
     */
    private static function validarUnCampo(
        Novedad $model,
        NovedadConcepto $concepto,
        NovedadConceptoFormCampo $campo,
        array $postedDatos,
        ?UploadedFile $adjuntoPdf
    ): bool {
        $id = (string) $campo->campo_id;
        $tipo = (string) $campo->tipo_dato;
        $label = (string) $campo->label;
        $req = (int) $campo->requerido === 1;

        if ($id === 'fecha_novedad') {
            $v = $model->fecha_novedad;
            if ($req && ($v === null || $v === '')) {
                $model->addError('fecha_novedad', Yii::t('app', '{label} es obligatorio.', ['label' => $label]));

                return false;
            }

            return true;
        }

        if ($id === 'observaciones') {
            $text = (string) ($model->descripcion ?? '');
            $max = (int) ($campo->max_length ?? 144);
            if ($max < 1) {
                $max = 144;
            }
            if ($req && trim($text) === '') {
                $model->addError('descripcion', Yii::t('app', '{label} es obligatorio.', ['label' => $label]));

                return false;
            }
            if (mb_strlen($text) > $max) {
                $model->addError('descripcion', Yii::t('app', '{label}: máximo {n} caracteres.', ['label' => $label, 'n' => $max]));

                return false;
            }

            return true;
        }

        if ($tipo === 'file_pdf') {
            if ($adjuntoPdf === null || $adjuntoPdf->error === UPLOAD_ERR_NO_FILE) {
                if ($req) {
                    $model->addError('datos', Yii::t('app', '{label}: debe adjuntar un PDF.', ['label' => $label]));

                    return false;
                }

                return true;
            }
            if ($adjuntoPdf->error !== UPLOAD_ERR_OK) {
                $model->addError('datos', Yii::t('app', '{label}: error al subir el archivo.', ['label' => $label]));

                return false;
            }
            $ext = strtolower((string) $adjuntoPdf->extension);
            if ($ext !== 'pdf') {
                $model->addError('datos', Yii::t('app', '{label}: solo se permiten archivos PDF.', ['label' => $label]));

                return false;
            }
            if ($adjuntoPdf->size > self::ADJUNTO_PDF_MAX_BYTES) {
                $model->addError('datos', Yii::t('app', '{label}: el archivo supera el tamaño máximo permitido ({mb} MB).', [
                    'label' => $label,
                    'mb' => (int) (self::ADJUNTO_PDF_MAX_BYTES / 1024 / 1024),
                ]));

                return false;
            }
            $mime = (string) $adjuntoPdf->type;
            if ($mime !== '' && stripos($mime, 'pdf') === false && $mime !== 'application/octet-stream') {
                $model->addError('datos', Yii::t('app', '{label}: el archivo no es un PDF válido.', ['label' => $label]));

                return false;
            }

            return true;
        }

        $raw = $postedDatos[$id] ?? null;
        $str = is_scalar($raw) ? trim((string) $raw) : '';

        if ($req && $str === '') {
            $model->addError('datos', Yii::t('app', '{label} es obligatorio.', ['label' => $label]));

            return false;
        }

        if ($str === '') {
            return true;
        }

        if ($tipo === 'number') {
            if (!is_numeric($str)) {
                $model->addError('datos', Yii::t('app', '{label}: debe ser un número.', ['label' => $label]));

                return false;
            }
            $num = (float) $str;
            if ($campo->val_min !== null && $campo->val_min !== '' && $num < (float) $campo->val_min) {
                $model->addError('datos', Yii::t('app', '{label}: valor mínimo {v}.', ['label' => $label, 'v' => $campo->val_min]));

                return false;
            }
            if ($campo->val_max !== null && $campo->val_max !== '' && $num > (float) $campo->val_max) {
                $model->addError('datos', Yii::t('app', '{label}: valor máximo {v}.', ['label' => $label, 'v' => $campo->val_max]));

                return false;
            }

            return true;
        }

        if ($tipo === 'select') {
            if ($campo->fuente_opciones === 'location_sedes') {
                return true;
            }

            $permitidos = [];
            foreach ($campo->opciones as $op) {
                /** @var NovedadConceptoFormCamposOpcion $op */
                $permitidos[(string) $op->valor] = true;
            }
            if ($permitidos !== [] && !isset($permitidos[$str])) {
                $model->addError('datos', Yii::t('app', '{label}: opción no válida.', ['label' => $label]));

                return false;
            }

            return true;
        }

        if ($tipo === 'date') {
            return true;
        }

        if ($tipo === 'text' && $campo->max_length !== null && $campo->max_length > 0) {
            if (mb_strlen($str) > (int) $campo->max_length) {
                $model->addError('datos', Yii::t('app', '{label}: máximo {n} caracteres.', ['label' => $label, 'n' => $campo->max_length]));

                return false;
            }
        }

        return true;
    }

    /**
     * @param array<string, mixed> $postedDatos
     * @return array<string, mixed>
     */
    public static function datosLimpiosParaJson(array $postedDatos, NovedadConcepto $concepto): array
    {
        $campos = self::camposOrdenados($concepto);
        $out = [];
        foreach ($campos as $campo) {
            $id = (string) $campo->campo_id;
            $tipo = (string) $campo->tipo_dato;
            if ($id === 'fecha_novedad' || $id === 'observaciones' || $tipo === 'file_pdf') {
                continue;
            }
            if (!array_key_exists($id, $postedDatos)) {
                continue;
            }
            $v = $postedDatos[$id];
            if (is_scalar($v)) {
                $out[$id] = trim((string) $v);
            }
        }

        return $out;
    }

    public static function guardarAdjuntoPdf(UploadedFile $file, int $empresaId): ?string
    {
        $base = Yii::getAlias('@webroot/uploads/novedad/' . $empresaId);
        FileHelper::createDirectory($base);
        $name = Yii::$app->security->generateRandomString(20) . '.pdf';
        $pathFs = $base . DIRECTORY_SEPARATOR . $name;
        if (!$file->saveAs($pathFs, false)) {
            return null;
        }

        return '/uploads/novedad/' . $empresaId . '/' . $name;
    }
}
