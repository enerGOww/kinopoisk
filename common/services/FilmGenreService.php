<?php

namespace common\services;
use yii\helpers\ArrayHelper;

class FilmGenreService
{
    public static function uniteByFilmId($records)
    {
        return array_count_values(ArrayHelper::getColumn($records, 'film_id'));
    }

    public function uniteByGenreId($records)
    {
       return array_count_values(ArrayHelper::getColumn($records, 'genre_id'));
    }
}