<?php
use common\essence\Comment;
use yii\helpers\Html;
use common\essence\User;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use \yii\widgets\ActiveForm;
/* @var $model common\essence\Comment */
/* @var $userId*/
?>

<div style="margin: 10px; background-color: lightgray; padding: 10px;">
    <div style="float: left; margin-right: 20px;"><?= Html::img(User::findOne($model->created_by)->getImage(), [
            'height' => '50px',
            'alt' => 'bad connection',
            'width' => '50px',
            'style' => [
                    'border-radius' => '25px',
            ],
        ]) ?></div>
    <b><?php
        print_r  (User::findOne($model->created_by)->username);
        ?></b>
    <br>
    <?= $model->text ?>
    <br>
    <?php
    $newComment = new Comment();
    $parentId = $model->id;
    $filmId = $model->film_id;
    $actorId = $model->actor_id;
    $rejeserId = $model->rejeser_id;
    ?>
    <div style="text-align: right">
    <?php
        if(!Yii::$app->user->isGuest){
            Modal::begin([
                'header' => '<h2 style="text-align: left">Оставьте комментарий</h2>',
                'toggleButton' => [
                    'label' => 'Комментировать',
                    'tag' => 'a',
                ],
            ]);
            echo $this->render('..\comment\_childComment', [
                'model' => $newComment,
                'parentId' => $parentId,
                'userId' => $userId,
                'filmId' => $filmId,
                'actorId' => $actorId,
                'rejeserId' => $rejeserId,
            ]);
            Modal::end();
        }
        $userModel = Yii::$app->user->identity;
        if(!Yii::$app->user->isGuest && $userModel->getId()==$model->created_by){
            Modal::begin([
                'header' => '<h2 style="text-align: left">Отредактируйте комментарий</h2>',
                'toggleButton' => [
                    'label' => 'Редактировать',
                    'tag' => 'a',
                ],
            ]);
            echo $this->render('..\comment\_formForUpdate', [
                'model' => $model,
            ]);
            Modal::end();
        }
    ?>
        <br>
    </div>
</div>

<br>
