<?php

namespace frontend\widgets\blyatWidget;

use yii\base\Widget;
use Yii;
use common\essence\Comment;

class BlyatWidget extends Widget
{
    public $filmId = null;
    public $actorId = null;
    public $rejeserId = null;
    public $folder;

    public function run()
    {
        $newComment = new Comment();
        $userId =  Yii::$app->user->id;
        return $this->render('/comment/create',[
            'userId' => $userId,
            'model' => $newComment,
            'filmId' => $this->filmId,
            'actorId' => $this->actorId,
            'rejeserId' => $this->rejeserId,
                ]);

    }
}