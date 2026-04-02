<?php

namespace app\models\search;

use app\components\TenantContext;
use app\models\SupportTicket;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SupportTicketSearch extends Model
{
    public $q;
    public $status;
    public $priority;

    public function rules(): array
    {
        return [
            [['q', 'status', 'priority'], 'trim'],
            [['q', 'status', 'priority'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = SupportTicket::find()
            ->alias('t')
            ->with(['empresaCliente', 'createdBy.profile', 'assignedTo.profile'])
            ->orderBy(['updated_at' => SORT_DESC, 'id' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        $tenantId = TenantContext::currentEmpresaId();
        if ($tenantId === null) {
            $query->andWhere('0=1');
            return $provider;
        }

        $query->andWhere(['t.empresas_id' => $tenantId]);

        $this->load($params, '');
        if (!$this->validate()) {
            return $provider;
        }

        if ($this->status !== null && $this->status !== '') {
            $query->andWhere(['t.status' => $this->status]);
        }
        if ($this->priority !== null && $this->priority !== '') {
            $query->andWhere(['t.priority' => $this->priority]);
        }
        if ($this->q !== null && $this->q !== '') {
            $query->andWhere([
                'or',
                ['like', 't.ticket_number', $this->q],
                ['like', 't.subject', $this->q],
                ['like', 't.description', $this->q],
            ]);
        }

        return $provider;
    }
}
