<?php

namespace common\widgets;

use common\repositories\FilmRepository;
use common\essence\Genre;
use yii\base\Widget;
use common\repositories\FilmGenreRepository;
use common\services\FilmGenreService;
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
        $looksLike = FilmGenreRepository::getRecordsForThisGenres($genre, $this->filmId); //получаем совпадения записей по жанрам
        $filmPriority = FilmGenreService::uniteByFilmId($looksLike); //ассоциативный массив film_id => кол-во совпадений жанров
        arsort($filmPriority);
        $arrFilmPriority = array_keys($filmPriority); //берём массив id фильмов с отсортированных по приорететом фильмов на вывод
        $films = FilmRepository::getFilmsLikeThisWithPriority ($arrFilmPriority);
        for($i=0;$i<count($films) && $i<5;$i++){
             $result[] = "<a href='/film/view?id={$films[$i]['id']}'><img src='/uploads/{$films[$i]['image']}' height='200' alt='{$films[$i]['title']}'></a>";
        }
        return implode(' ', $result);
    }
}

