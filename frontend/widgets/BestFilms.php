<?php


namespace frontend\widgets;

use yii\base\Widget;
use common\essence\Film;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
class BestFilms extends Widget
{
    public $allFilms;
    public $flag;

    public function run()
    {
        if($this->flag==1) {
            $films = [];
            foreach ($this->allFilms as $film_id) {
                array_push($films, Film::findOne($film_id->film_id));
            }
        }
        if($this->flag==2){
            $films = $this->allFilms;
        }
        $filmsRating = ArrayHelper::map($films, 'id', 'rating');
        arsort($filmsRating);

        for($i=0;$i<count($filmsRating) && $i<5;$i++){
            $result[] = "<a href='/film/view?id={$films[$i]['id']}'><img src='/uploads/{$films[$i]['image']}' height='200' alt='{$films[$i]['title']}'></a>";
        }


        return implode(' ', $result);

    }
}