<?php


namespace common\services;

use common\essence\FilmUser;
use common\repositories\FilmUserRepository;
use Yii;

class FilmUserService
{
    private $filmUser;
    public function __construct(FilmUserRepository $filmUser)
    {
        $this->filmUser = $filmUser;
    }
    public function saveFavoriteFilm($filmId, $userId)
    {
        $favorite = $this->filmUser->findByIDs($filmId, $userId);
        if (!$favorite) {
            $favorite = new FilmUser();
            $favorite->film_id = $filmId;
            $favorite->user_id = $userId;
            $favorite->save();
            Yii::$app->session->setFlash('comment', 'Добавленно в избранное');
        } else {
            $favorite->delete();
            Yii::$app->session->setFlash('comment', 'Удаленно из избранного');
        }
    }
}