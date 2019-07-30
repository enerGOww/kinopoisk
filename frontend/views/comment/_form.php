<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\essence\Comment */
/* @var $form yii\widgets\ActiveForm */
/* @var $userId Yii::$app->user->id*/
?>

<div class="comment-form"   >

    <?php $form = ActiveForm::begin([
        'action' => '/comment/create'
    ]); ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6])->label(false) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => $userId])->label(false); ?>

    <?= $form->field($model, 'rejeser_id')->hiddenInput(['value' => $rejeserId])->label(false) ?>

    <?= $form->field($model, 'film_id')->hiddenInput(['value' => $filmId])->label(false) ?>

    <?= $form->field($model, 'actor_id')->hiddenInput(['value' => $actorId])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
