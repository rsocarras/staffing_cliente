<?php

use yii\db\Migration;

/**
 * Rellena duracion_minutos para el primer log de cada requisición usando fecha_creacion.
 */
class m250302100017_backfill_duracion_desde_creacion extends Migration
{
    public function safeUp()
    {
        $rows = $this->db->createCommand(
            'SELECT l.id, l.requisicion_id, l.estado_anterior, l.created_at, r.fecha_creacion
             FROM requisicion_history_log l
             JOIN requisicion r ON r.id = l.requisicion_id
             WHERE l.duracion_minutos IS NULL
               AND l.estado_anterior IS NOT NULL
               AND r.fecha_creacion IS NOT NULL'
        )->queryAll();

        foreach ($rows as $row) {
            $prevExists = $this->db->createCommand(
                'SELECT 1 FROM requisicion_history_log WHERE requisicion_id = :rid AND created_at < :created LIMIT 1',
                [':rid' => $row['requisicion_id'], ':created' => $row['created_at']]
            )->queryScalar();
            if ($prevExists) {
                continue;
            }
            $duracion = max(0, (int) floor((strtotime($row['created_at']) - strtotime($row['fecha_creacion'])) / 60));
            $this->db->createCommand()->update('requisicion_history_log', ['duracion_minutos' => $duracion], ['id' => $row['id']])->execute();
        }
    }

    public function safeDown()
    {
        // No revert
    }
}
