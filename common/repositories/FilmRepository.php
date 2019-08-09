<?php


namespace common\repositories;

use common\essence\Film;
use yii\db\Expression;

class FilmRepository
{
    public function getFilmsLikeThisWithPriority ($arrFilmPriority)
    {
        return Film::find()->where(['id'=> $arrFilmPriority])
                           ->orderBy([new Expression('FIELD (id, ' . implode(',', $arrFilmPriority ) . ')')])
                           ->all();
    }
}