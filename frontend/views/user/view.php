<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\essence\User */



?>
<div class="user-view">

    <h1><?= Html::encode($model->username) ?></h1>

    <p>
        <?= Html::a('Set image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Change password', ['password-change', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div style="float: left">
        <?= Html::img($model->getImage(), ['width' => '250px', 'height' => '250px',  'style' => 'border-radius:125px', 'alt' => 'bad connection']) ?>
    </div>
    <div style="float: right; width: 70%">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
    //            'id',
                'username',
    //            'auth_key',
    //            'password_hash',
    //            'password_reset_token',
                'email:email',
    //            'status',
                [
                    'attribute' =>'created_at',
                    'label' => 'Create date',
                    'value' => $model->getDate()
                ],
    //            'updated_at',
    //            'verification_token',
    //            'image',
            ],
        ]) ?>
    </div>

</div>
