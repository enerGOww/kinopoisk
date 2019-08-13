<?php

use common\widgets\GridForFilmsByIdWidget;
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
    </p>
    <div class="" style="display:flex;flex-direction: row;">
        <div>
            <?= Html::img($model->getImage(), ['width' => '250px', 'height' => '250px',  'style' => 'border-radius:125px', 'alt' => 'bad connection']) ?>
        </div>
        <div style="width: 70%; margin-left: 40px">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    'email:email',
                    [
                        'attribute' =>'created_at',
                        'label' => 'Create date',
                        'value' => $model->getDate()
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>

<?= GridForFilmsByIdWidget::widget(['id' => $model->id, 'flag' => 2]) ?>
