<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $requisicion_id
 * @property int $checklist_item_id
 * @property int $completado
 * @property int|null $completado_por
 * @property string|null $completado_at
 * @property string|null $observacion
 * @property int|null $archivo_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Requisicion $requisicion
 * @property ChecklistItem $checklistItem
 * @property User $completadoPor
 */
class ChecklistStatus extends ActiveRecord
{
    public static function tableName()
    {
        return 'checklist_status';
    }

    public function rules()
    {
        return [
            [['requisicion_id', 'checklist_item_id'], 'required'],
            [['requisicion_id', 'checklist_item_id', 'completado', 'completado_por', 'archivo_id'], 'integer'],
            [['completado_at', 'created_at', 'updated_at'], 'safe'],
            [['observacion'], 'string'],
            [['requisicion_id', 'checklist_item_id'], 'unique', 'targetAttribute' => ['requisicion_id', 'checklist_item_id']],
            [['requisicion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requisicion::class, 'targetAttribute' => ['requisicion_id' => 'id']],
            [['checklist_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChecklistItem::class, 'targetAttribute' => ['checklist_item_id' => 'id']],
        ];
    }

    public function getRequisicion()
    {
        return $this->hasOne(Requisicion::class, ['id' => 'requisicion_id']);
    }

    public function getChecklistItem()
    {
        return $this->hasOne(ChecklistItem::class, ['id' => 'checklist_item_id']);
    }

    public function getCompletadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'completado_por']);
    }

    /**
     * Inicializa checklist para una requisición (crea registros por cada item obligatorio)
     */
    public static function inicializarParaRequisicion($requisicionId)
    {
        $items = ChecklistItem::getObligatorios();
        foreach ($items as $item) {
            $existe = static::findOne(['requisicion_id' => $requisicionId, 'checklist_item_id' => $item->id]);
            if (!$existe) {
                $status = new static();
                $status->requisicion_id = $requisicionId;
                $status->checklist_item_id = $item->id;
                $status->completado = 0;
                $status->save(false);
            }
        }
    }
}
