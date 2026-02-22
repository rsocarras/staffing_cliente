<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Archivos;

/**
 * ArchivosSearch represents the model behind the search form of `app\models\Archivos`.
 */
class ArchivosSearch extends Archivos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'size_bytes', 'uploaded_by'], 'integer'],
            [['storage', 'path', 'filename', 'mime', 'sha256', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Archivos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'empresa_id' => $this->empresa_id,
            'size_bytes' => $this->size_bytes,
            'uploaded_by' => $this->uploaded_by,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'storage', $this->storage])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'mime', $this->mime])
            ->andFilterWhere(['like', 'sha256', $this->sha256]);

        return $dataProvider;
    }
}
