<?php


namespace common\repositories;

use common\essence\FilmUser;
use common\essence\Film;
use yii\helpers\ArrayHelper;

class UserRepository
{
    public function getFavoriteFilms($id)
    {
        $arr = FilmUser::find()->where(['user_id' => $id])->all();
        $arr1 = ArrayHelper::getColumn($arr, 'film_id');
        return Film::find()->where(['id' => $arr1]);
    }
}