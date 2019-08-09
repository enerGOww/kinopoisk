<?php


namespace common\repositories;

use common\essence\Genre;
use yii\db\Expression;

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
}