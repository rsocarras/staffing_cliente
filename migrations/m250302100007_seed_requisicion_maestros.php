<?php

use yii\db\Migration;

/**
 * Seeds básicos para maestros del módulo requisición
 */
class m250302100007_seed_requisicion_maestros extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('motivo_vinculacion', ['nombre', 'descripcion', 'is_active'], [
            ['Reemplazo', 'Reemplazo de personal', 1],
            ['Nueva vacante', 'Nueva posición creada', 1],
            ['Expansión', 'Expansión de operaciones', 1],
        ]);

        $this->batchInsert('empresa_cliente', ['nit', 'nombre', 'is_active'], [
            ['900123456-1', 'Empresa Demo S.A.S', 1],
            ['900234567-2', 'MyBodytech Colombia', 1],
            ['900345678-3', 'Cliente Ejemplo Ltda', 1],
        ]);

        $this->batchInsert('esquema_variable', ['nombre', 'descripcion', 'is_active'], [
            ['Comisiones ventas', 'Esquema basado en comisiones por ventas', 1],
            ['Bonos por desempeño', 'Bonos variables por metas', 1],
            ['Sin variable', 'Solo salario fijo', 1],
        ]);

        $this->batchInsert('checklist_item', ['codigo', 'nombre', 'descripcion', 'es_obligatorio', 'orden', 'is_active'], [
            ['DOC_ID', 'Documento de identidad', 'Copia cédula o documento', 1, 1, 1],
            ['CONTRATO', 'Contrato firmado', 'Contrato de trabajo firmado', 1, 2, 1],
            ['EPS', 'Afiliación EPS', 'Comprobante afiliación EPS', 1, 3, 1],
        ]);
    }

    public function safeDown()
    {
        $this->delete('checklist_item');
        $this->delete('esquema_variable');
        $this->delete('empresa_cliente');
        $this->delete('motivo_vinculacion');
    }
}
