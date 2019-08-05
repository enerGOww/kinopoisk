<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\essence\Film */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Films', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="film-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Set image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Set Genre', ['set-genre', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Set Rejeser', ['set-rejeser', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Set Actors', ['set-actor', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= Html::img($model->getImage(), ['width' => '250px', 'height' => '250px', 'alt' => 'bad connection']) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'country',
            'slogan',
            'rejeser_id',
            'world_rating_id',
            'size',
            'rating',
            'image',
            'trailer_link',
        ],
    ]) ?>

</div>
