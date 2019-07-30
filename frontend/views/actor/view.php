<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\SykaWidget\SykaWidget;
use frontend\widgets\blyatWidget\BlyatWidget;

/* @var $this yii\web\View */
/* @var $model common\essence\Actor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Actors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="actor-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'year',
            'place',
            'height',
            'reward',
            'image',
        ],
    ]) ?>

    <?php if (Yii::$app->session->hasFlash('commentUpdate')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('commentUpdate') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('commentCreate')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('commentCreate') ?>
        </div>
    <?php endif; ?>

    <?php if (!Yii::$app->user->isGuest){
    echo BlyatWidget::widget(['actorId' => $model->id,]);
    } ?>

    <?= SykaWidget::widget(['model' => $model, 'which' => 2]); ?>

</div>
