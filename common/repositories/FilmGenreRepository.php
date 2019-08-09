<?php

namespace common\repositories;

use common\essence\FilmGenre;

class FilmGenreRepository
{
    public function getRecordsForThisGenres($genres, $filmId)
    {
        return FilmGenre::find()->where(['genre_id'=>$genres])
                                ->andWhere(["<>" ,'film_id', $filmId])
                                ->all();
    }

    public function getRecordsForThisFilms($filmsId)
    {
        return FilmGenre::find()->where(['film_id' => $filmsId])->all();
    }
}