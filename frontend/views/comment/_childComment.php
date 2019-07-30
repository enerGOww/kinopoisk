<?php
use common\essence\Comment;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin([
        'action' => '/comment/createchild'
    ]); ?>



    <?= $form->field($model, 'text')->textInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => $userId])->label(false); ?>

    <?= $form->field($model, 'rejeser_id')->hiddenInput(['value' => $rejeserId])->label(false) ?>

    <?= $form->field($model, 'film_id')->hiddenInput(['value' => $filmId])->label(false) ?>

    <?= $form->field($model, 'actor_id')->hiddenInput(['value' => $actorId])->label(false) ?>

    <?= $form->field($model, 'parent_id')->hiddenInput(['value' => $parentId])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
