<?php


namespace frontend\widgets;

use yii\base\Widget;
use common\essence\FilmGenre;
use common\essence\Genre;
use yii\helpers\ArrayHelper;
use \yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\Url;

class GetGeresForActorRejeser extends Widget
{
    public $allFilms;
    public $flag;

    public function run()
    {
        $filmsId = [];
        if($this->flag==1){
            for($i=0;$i<count($this->allFilms);$i++){
                array_push($filmsId, $this->allFilms[$i]->film_id);
            }
        }
        if($this->flag==2){
            for($i=0;$i<count($this->allFilms);$i++){
                array_push($filmsId, $this->allFilms[$i]->id);
            }
        }

        $genresFromDatabase = FilmGenre::find()->where(['film_id' => $filmsId])->all();
        $genrePriorety = array_count_values(ArrayHelper::getColumn($genresFromDatabase, 'genre_id'));
        $genres = Genre::find()->where(['id' => $genrePriorety])->orderBy([new Expression('FIELD (id, '. implode(',', $genrePriorety). ')')])->all();
        for($i=0;$i<count($genres) && $i<5;$i++){
            echo Html::a($genres[$i]->description, Url::to('/genre/view?id='.$genres[$i]->id)).' ';
        }

    }
}