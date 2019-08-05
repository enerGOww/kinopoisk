<?php
namespace frontend\widgets;

use \yii\base\Widget;
use common\essence\Film;
use yii\helpers\Html;
use yii\helpers\Url;

class GetAllFilmsForActor extends Widget
{
    public $allFilms;

    public function run()
    {
        foreach ($this->allFilms as $film_id){
            $film = Film::findOne($film_id->film_id);
            echo Html::a($film->title, Url::to('/film/view?id='.$film->id)).' ';
        }

    }
}