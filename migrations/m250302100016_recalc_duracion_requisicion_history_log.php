<?php

use yii\db\Migration;

/**
 * Recalcula duracion_minutos correctamente (tiempo entre transición anterior y esta).
 */
class m250302100016_recalc_duracion_requisicion_history_log extends Migration
{
    public function safeUp()
    {
        $rows = $this->db->createCommand(
            'SELECT id, requisicion_id, estado_anterior, created_at FROM requisicion_history_log ORDER BY requisicion_id, created_at'
        )->queryAll();

        foreach ($rows as $row) {
            $duracion = null;
            if ($row['estado_anterior']) {
                $prev = $this->db->createCommand(
                    'SELECT created_at FROM requisicion_history_log WHERE requisicion_id = :rid AND created_at < :created ORDER BY created_at DESC LIMIT 1',
                    [':rid' => $row['requisicion_id'], ':created' => $row['created_at']]
                )->queryScalar();
                if ($prev) {
                    $duracion = max(0, (int) floor((strtotime($row['created_at']) - strtotime($prev)) / 60));
                }
            }
            $this->db->createCommand()->update(
                'requisicion_history_log',
                ['duracion_minutos' => $duracion],
                ['id' => $row['id']]
            )->execute();
        }
    }

    public function safeDown()
    {
        // No revert - would lose corrected data
    }
}
