<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LocationCountry;

/**
 * LocationCountrySearch represents the model behind the search form of `app\models\LocationCountry`.
 */
class LocationCountrySearch extends LocationCountry
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_active'], 'integer'],
            [['name', 'official_name', 'common_name', 'iso_alpha2', 'iso_alpha3', 'iso_numeric', 'calling_code_primary', 'calling_codes', 'flag_emoji', 'flag_svg_url', 'flag_png_url', 'capital', 'region', 'subregion', 'currencies', 'languages', 'tld', 'timezones', 'created_at', 'updated_at'], 'safe'],
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
        $query = LocationCountry::find();

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
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'official_name', $this->official_name])
            ->andFilterWhere(['like', 'common_name', $this->common_name])
            ->andFilterWhere(['like', 'iso_alpha2', $this->iso_alpha2])
            ->andFilterWhere(['like', 'iso_alpha3', $this->iso_alpha3])
            ->andFilterWhere(['like', 'iso_numeric', $this->iso_numeric])
            ->andFilterWhere(['like', 'calling_code_primary', $this->calling_code_primary])
            ->andFilterWhere(['like', 'calling_codes', $this->calling_codes])
            ->andFilterWhere(['like', 'flag_emoji', $this->flag_emoji])
            ->andFilterWhere(['like', 'flag_svg_url', $this->flag_svg_url])
            ->andFilterWhere(['like', 'flag_png_url', $this->flag_png_url])
            ->andFilterWhere(['like', 'capital', $this->capital])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'subregion', $this->subregion])
            ->andFilterWhere(['like', 'currencies', $this->currencies])
            ->andFilterWhere(['like', 'languages', $this->languages])
            ->andFilterWhere(['like', 'tld', $this->tld])
            ->andFilterWhere(['like', 'timezones', $this->timezones]);

        return $dataProvider;
    }
}
