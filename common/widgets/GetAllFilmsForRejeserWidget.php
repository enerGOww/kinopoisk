<?php


namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Url;
use yii\helpers\Html;
class GetAllFilmsForRejeserWidget extends Widget
{
    public $allFilms;

    public function run()
    {
        for($i=0;$i<count($this->allFilms);$i++){
            echo Html::a($this->allFilms[$i]->title, Url::to('/film/view?id='.$this->allFilms[$i]->id)).' ';
        }
    }
}