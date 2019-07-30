<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\essence\Film;

/**
 * FilmSearch represents the model behind the search form of `common\essence\Film`.
 */
class FilmSearch extends Film
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rejeser_id', 'world_rating_id', 'size', 'rating'], 'integer'],
            [['title', 'country', 'slogan', 'image', 'trailer_link', 'year'], 'safe'],
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
        $query = Film::find();

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
            'rejeser_id' => $this->rejeser_id,
            'world_rating_id' => $this->world_rating_id,
            'size' => $this->size,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'slogan', $this->slogan])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'trailer_link', $this->trailer_link])
            ->andFilterWhere(['like', 'year', $this->year]);

        return $dataProvider;
    }
}
