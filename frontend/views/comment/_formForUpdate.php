<?php
use common\essence\Comment;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\essence\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin([
        'action' => '/comment/update?id='.$model->id,
    ]); ?>



    <?= $form->field($model, 'text')->textarea(['rows' => 2])->label(false) ?>

    <?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false); ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

