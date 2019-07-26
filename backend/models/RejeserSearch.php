<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\essence\Rejeser;

/**
 * RejeserSearch represents the model behind the search form of `common\essence\Rejeser`.
 */
class RejeserSearch extends Rejeser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'height'], 'integer'],
            [['year', 'place', 'reward', 'image'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Rejeser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
            'height' => $this->height,
        ]);

        $query->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'reward', $this->reward])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
