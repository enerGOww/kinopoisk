<?php
namespace frontend\widgets\getGenreWidget;

use common\essence\Genre;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
class GetGenreWidget extends Widget
{
    public $allGenres;

    public function run()
    {
        foreach ($this->allGenres as $genre_id){
            $genre = Genre::findOne($genre_id->genre_id);
            echo Html::a($genre->description, Url::to('/genre/view?id='.$genre->id)).' ';
        }

    }
}