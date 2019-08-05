<?php


namespace frontend\widgets;

use yii\base\Widget;
use common\essence\Rejeser;
use yii\helpers\Url;
use yii\helpers\Html;
class GetAllFilmsForRejeser extends Widget
{
    public $allFilms;

    public function run()
    {
//        print_r($this->allFilms);die;
        for($i=0;$i<count($this->allFilms);$i++){
            echo Html::a($this->allFilms[$i]->title, Url::to('/film/view?id='.$this->allFilms[$i]->id)).' ';
        }
    }
}