<?php

namespace frontend\widgets\likeThisFilmWidget;

use common\essence\FilmGenre;
use common\essence\Genre;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
class LikeThisFilmWidget extends Widget
{
    public $allGenres;
    public $filmId;

    public function run()
    {
        $genre = [];
        foreach ($this->allGenres as $genre_id) {
            array_push($genre, Genre::findOne($genre_id->genre_id)->id);
        }
//        var_dump($genre);die;
        $looksLike = FilmGenre::find()->where(['genre_id'=>$genre])
            ->andWhere(["<>" ,'film_id', $this->filmId])->all();


        $filmPriority = array_count_values(ArrayHelper::getColumn($looksLike, 'film_id'));
        $sorted = array_column($filmPriority, 'value');

        array_multisort($price, SORT_DESC, $sorted);
        var_dump($sorted);die;
    }
}

