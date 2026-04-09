<?php

declare(strict_types=1);

namespace app\services;

use app\models\forms\NovedadSolicitudContextForm;
use app\models\Novedad;
use app\models\NovedadCentroCosto;
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

    /** Documentos genéricos (PDF, Office, imágenes) en solicitudes. */
    public const ADJUNTO_DOCUMENTO_MAX_BYTES = 10 * 1024 * 1024;

    /** @var list<string> */
    private const EXT_DOCUMENTO_PERMITIDAS = ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg'];

    /**
     * Tipo de input archivo para UI y validación: corrige catálogos con `text` pero etiqueta/campo PDF o documento.
     *
     * @return 'file_pdf'|'file'|null
     */
    public static function tipoDatoFormularioArchivo(NovedadConceptoFormCampo $campo): ?string
    {
        $t = strtolower(trim((string) $campo->tipo_dato));
        if ($t === 'file') {
            return 'file';
        }
        if (in_array($t, ['file_pdf', 'pdf', 'archivo_pdf', 'adjunto_pdf'], true)) {
            return 'file_pdf';
        }
        $label = (string) $campo->label;
        $cid = strtolower((string) $campo->campo_id);
        $fuente = trim((string) ($campo->fuente_opciones ?? ''));
        // Ej.: «Documentos soporte (PDF)» quedó como text/textarea en BD
        if (in_array($t, ['text', 'textarea', 'longtext'], true)) {
            if (stripos($label, 'pdf') !== false || stripos($cid, 'pdf') !== false) {
                return 'file_pdf';
            }
            if (
                (stripos($label, 'documento') !== false || str_contains($cid, 'documento'))
                && (stripos($label, 'adjunto') !== false || str_contains($cid, 'adjunto') || stripos($label, 'soporte') !== false)
            ) {
                return 'file_pdf';
            }
        }
        // Select mal configurado con filas en `opciones` pero la etiqueta indica adjunto PDF
        if (
            $t === 'select'
            && !in_array($fuente, ['novedad_centro_costo', 'location_sedes'], true)
            && (stripos($label, 'pdf') !== false || stripos($cid, 'pdf') !== false)
        ) {
            return 'file_pdf';
        }

        return null;
    }

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
    ): bool {
        $campos = self::camposOrdenados($concepto);
        if ($campos === []) {
            return true;
        }

        $ok = true;
        foreach ($campos as $campo) {
            $adjunto = null;
            if (self::tipoDatoFormularioArchivo($campo) !== null) {
                $adjunto = UploadedFile::getInstanceByName('datos[' . $campo->campo_id . ']');
            }
            if (!self::validarUnCampo($model, $concepto, $campo, $postedDatos, $adjunto)) {
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
        $archivoTipo = self::tipoDatoFormularioArchivo($campo);

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

        if ($archivoTipo === 'file_pdf') {
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

        if ($archivoTipo === 'file') {
            if ($adjuntoPdf === null || $adjuntoPdf->error === UPLOAD_ERR_NO_FILE) {
                if ($req) {
                    $model->addError('datos', Yii::t('app', '{label}: debe adjuntar un documento.', ['label' => $label]));

                    return false;
                }

                return true;
            }
            if ($adjuntoPdf->error !== UPLOAD_ERR_OK) {
                $model->addError('datos', Yii::t('app', '{label}: error al subir el archivo.', ['label' => $label]));

                return false;
            }
            $ext = strtolower((string) $adjuntoPdf->extension);
            if (!in_array($ext, self::EXT_DOCUMENTO_PERMITIDAS, true)) {
                $model->addError('datos', Yii::t('app', '{label}: tipo de archivo no permitido.', ['label' => $label]));

                return false;
            }
            if ($adjuntoPdf->size > self::ADJUNTO_DOCUMENTO_MAX_BYTES) {
                $model->addError('datos', Yii::t('app', '{label}: el archivo supera el tamaño máximo permitido ({mb} MB).', [
                    'label' => $label,
                    'mb' => (int) (self::ADJUNTO_DOCUMENTO_MAX_BYTES / 1024 / 1024),
                ]));

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

            if ($campo->fuente_opciones === 'novedad_centro_costo') {
                if ($req && $str === '') {
                    $model->addError('datos', Yii::t('app', '{label} es obligatorio.', ['label' => $label]));

                    return false;
                }
                if ($str === '') {
                    return true;
                }
                $exists = NovedadCentroCosto::find()
                    ->where(['id' => (int) $str, 'activo' => 1])
                    ->exists();
                if (!$exists) {
                    $model->addError('datos', Yii::t('app', '{label}: centro de costo no válido.', ['label' => $label]));

                    return false;
                }

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
            if ($id === 'fecha_novedad' || $id === 'observaciones' || self::tipoDatoFormularioArchivo($campo) !== null) {
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

    /**
     * Copia al registro {@see Novedad} los campos del formulario que tienen columna propia (no solo JSON).
     *
     * @param array<string, mixed> $postedDatos Típicamente `campos_dinamicos` del POST.
     */
    public static function sincronizarAtributosNovedadDesdeCampos(
        Novedad $model,
        NovedadConcepto $concepto,
        array $postedDatos,
    ): void {
        foreach (self::camposOrdenados($concepto) as $campo) {
            $id = (string) $campo->campo_id;
            $tipo = (string) $campo->tipo_dato;

            if ($id === 'fecha_novedad' || self::tipoDatoFormularioArchivo($campo) !== null) {
                continue;
            }

            if ($id === 'observaciones') {
                $raw = $postedDatos[$id] ?? null;
                $t = is_scalar($raw) ? trim((string) $raw) : '';
                $model->descripcion = $t !== '' ? $t : null;

                continue;
            }

            if ($tipo === 'select' && $campo->fuente_opciones === 'novedad_centro_costo') {
                $raw = $postedDatos[$id] ?? '';
                $s = is_scalar($raw) ? trim((string) $raw) : '';
                $model->novedad_centro_costo_id = ($s !== '' && is_numeric($s)) ? (int) $s : null;

                continue;
            }

            if ($id === 'valor') {
                $raw = $postedDatos[$id] ?? null;
                $s = is_scalar($raw) ? trim((string) $raw) : '';
                if ($s !== '') {
                    $norm = str_replace(',', '.', str_replace([' ', "\u{00A0}"], '', $s));
                    if (is_numeric($norm)) {
                        $model->importe = round((float) $norm, 2);
                    }
                }

                continue;
            }

            if (
                $tipo === 'number'
                && ($id === 'cantidad' || str_contains(strtolower($id), 'cantidad'))
            ) {
                $raw = $postedDatos[$id] ?? null;
                $s = is_scalar($raw) ? trim((string) $raw) : '';
                if ($s !== '' && is_numeric(str_replace(',', '.', $s))) {
                    $model->cantidad = (string) (float) str_replace(',', '.', $s);
                }

                continue;
            }

            if ($id === 'hora_inicio' || $id === 'hora_fin') {
                $raw = $postedDatos[$id] ?? null;
                $s = is_scalar($raw) ? trim((string) $raw) : '';
                if ($id === 'hora_inicio') {
                    $model->hora_inicio = $s !== '' ? $s : null;
                } else {
                    $model->hora_fin = $s !== '' ? $s : null;
                }

                continue;
            }

            if ($tipo === 'time' && (stripos($id, 'inicio') !== false || $id === 'hora_inicio')) {
                $raw = $postedDatos[$id] ?? null;
                $s = is_scalar($raw) ? trim((string) $raw) : '';
                $model->hora_inicio = $s !== '' ? $s : null;

                continue;
            }
            if ($tipo === 'time' && (stripos($id, 'fin') !== false || $id === 'hora_fin')) {
                $raw = $postedDatos[$id] ?? null;
                $s = is_scalar($raw) ? trim((string) $raw) : '';
                $model->hora_fin = $s !== '' ? $s : null;

                continue;
            }

            if ($id === 'unidad' && $tipo === 'text') {
                $raw = $postedDatos[$id] ?? null;
                $s = is_scalar($raw) ? trim((string) $raw) : '';
                $model->unidad = $s !== '' ? $s : null;
            }
        }
    }

    /**
     * @param array<string, mixed> $camposDinamicos
     * @return array{solicitud: array<string, string|null>, campos_dinamicos: array<string, mixed>}
     */
    public static function empaquetarDatosJsonSolicitud(array $camposDinamicos, ?NovedadSolicitudContextForm $ctx): array
    {
        $solicitud = [];
        if ($ctx !== null) {
            $solicitud['empresa_cliente_id'] = $ctx->empresa_cliente_id !== null ? (string) $ctx->empresa_cliente_id : null;
            $solicitud['ciudad_id'] = $ctx->ciudad_id !== null ? (string) $ctx->ciudad_id : null;
            $solicitud['sede_id'] = $ctx->sede_id !== null ? (string) $ctx->sede_id : null;
        }

        return [
            'solicitud' => $solicitud,
            'campos_dinamicos' => $camposDinamicos,
        ];
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

    public static function guardarAdjuntoDocumento(UploadedFile $file, int $empresaId): ?string
    {
        $ext = strtolower((string) $file->extension);
        if (!in_array($ext, self::EXT_DOCUMENTO_PERMITIDAS, true)) {
            return null;
        }
        $base = Yii::getAlias('@webroot/uploads/novedad/' . $empresaId);
        FileHelper::createDirectory($base);
        $name = Yii::$app->security->generateRandomString(20) . '.' . $ext;
        $pathFs = $base . DIRECTORY_SEPARATOR . $name;
        if (!$file->saveAs($pathFs, false)) {
            return null;
        }

        return '/uploads/novedad/' . $empresaId . '/' . $name;
    }
}
