<?php


namespace common\repositories;

use common\essence\Genre;
use yii\db\Expression;
use common\essence\Film;
use common\essence\FilmGenre;
use yii\helpers\ArrayHelper;

class GenreRepository
{
    public function getDescriptionById ($id)
    {
        return Genre::findOne($id)->description;
    }

    public function getGenresForActorRejeserFromFilms($genre)
    {
        return Genre::find()->where(['id' => $genre])
                            ->orderBy([new Expression('FIELD (id, '. implode(',', $genre). ')')])
                            ->all();
    }

    public function getAllGenre()
    {
        return Genre::find()->all();
    }

    public function getFilmsWithGenre($id)
    {
        $arr = FilmGenre::find()->where(['genre_id' => $id])->all();
        $arr1 = ArrayHelper::getColumn($arr, 'film_id');
        return Film::find()->where(['id' => $arr1]);
    }
}