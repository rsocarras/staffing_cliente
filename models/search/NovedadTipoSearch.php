<?php

namespace app\models\search;

use app\components\TenantContext;
use app\models\NovedadTipo;
use app\models\Profile;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NovedadTipoSearch represents the model behind the search form of `app\models\NovedadTipo`.
 */
class NovedadTipoSearch extends NovedadTipo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'orden', 'activo', 'created_at', 'updated_at'], 'integer'],
            [['nombre', 'descripcion', 'icono'], 'safe'],
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
        $query = NovedadTipo::find();
        $empresaId = TenantContext::currentEmpresaId();
        $empresaId = (is_numeric($empresaId) && (int) $empresaId > 0) ? (int) $empresaId : null;
        if ($empresaId === null && (Yii::$app->user->id ?? null) !== null) {
            $profile = Profile::findOne(['user_id' => (int) Yii::$app->user->id]);
            if ($profile !== null && (int) $profile->empresas_id > 0) {
                $empresaId = (int) $profile->empresas_id;
            }
        }

        $empresaColumn = $this->hasAttribute('empresa_id')
            ? 'empresa_id'
            : ($this->hasAttribute('empresas_id') ? 'empresas_id' : null);

        if ($empresaId === null || $empresaColumn === null) {
            $query->where('0=1');
        } else {
            $query->andWhere([$empresaColumn => $empresaId]);
        }

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
            'orden' => $this->orden,
            'activo' => $this->activo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'icono', $this->icono]);

        return $dataProvider;
    }
}
