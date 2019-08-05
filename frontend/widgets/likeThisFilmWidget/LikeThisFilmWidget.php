<?php

namespace frontend\widgets\likeThisFilmWidget;

use common\essence\Film;
use common\essence\FilmGenre;
use common\essence\Genre;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
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
                                      ->andWhere(["<>" ,'film_id', $this->filmId])
                                      ->all();


        $filmPriority = array_count_values(ArrayHelper::getColumn($looksLike, 'film_id'));
        arsort($filmPriority);
        $arrFilmPriority = array_keys($filmPriority);
        $films = Film::find()->where(['id'=> $arrFilmPriority])->orderBy([new Expression('FIELD (id, ' . implode(',', $arrFilmPriority ) . ')')])->all();
//        $images = array_column($films, 'image');
//        $titles = array_column($films, 'title');
//        $ids = array_column($films, 'id');
//        $arr = array_count_values(ArrayHelper::getColumn($films, 'id'));
        for($i=0;$i<count($films) && $i<5;$i++){
             $result[] = "<a href='/film/view?id={$films[$i]['id']}'><img src='/uploads/{$films[$i]['image']}' height='200' alt='{$films[$i]['title']}'></a>";
        }

//        print_r($films);die;
        return implode(' ', $result);
    }
}

