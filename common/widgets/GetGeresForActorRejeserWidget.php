<?php


namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use common\repositories\FilmGenreRepository;
use common\services\FilmGenreService;
use common\repositories\GenreRepository;
class GetGeresForActorRejeserWidget extends Widget
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

        $genresFromDatabase = FilmGenreRepository::getRecordsForThisFilms($filmsId); //берём все записи фильмов из таблице связей
        $genrePriorety = FilmGenreService::uniteByGenreId($genresFromDatabase); // ассоциативный массив genre_id => кол-во повторений
        $genres = GenreRepository::getGenresForActorRejeserFromFilms($genrePriorety); //модели жанров отсортированные
        for($i=0;$i<count($genres) && $i<5;$i++){
            echo Html::a($genres[$i]->description, Url::to('/genre/view?id='.$genres[$i]->id)).' ';
        }

    }
}