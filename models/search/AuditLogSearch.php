<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\AuditLog;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AuditLogSearch extends AuditLog
{
    public ?string $created_from = null;

    public ?string $created_to = null;

    public function rules(): array
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['table_name', 'action', 'username', 'record_pk', 'request_route', 'created_from', 'created_to'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search(array $params, $formName = null): ActiveDataProvider
    {
        $query = AuditLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'table_name',
                    'action',
                    'user_id',
                    'username',
                    'created_at',
                ],
            ],
            'pagination' => ['pageSize' => 30],
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'action' => $this->action,
        ]);

        $query->andFilterWhere(['like', 'table_name', $this->table_name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'request_route', $this->request_route])
            ->andFilterWhere(['like', 'record_pk', $this->record_pk]);

        if ($this->created_from !== null && $this->created_from !== '') {
            $query->andWhere(['>=', 'created_at', $this->created_from . ' 00:00:00']);
        }
        if ($this->created_to !== null && $this->created_to !== '') {
            $query->andWhere(['<=', 'created_at', $this->created_to . ' 23:59:59']);
        }

        return $dataProvider;
    }
}
