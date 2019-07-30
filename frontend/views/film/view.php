<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\SykaWidget\SykaWidget;
use frontend\widgets\blyatWidget\BlyatWidget;
use common\essence\Rejeser;
use yii\helpers\Url;
use common\essence\WorldRating;

/* @var $this yii\web\View */
/* @var $model common\essence\Film */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Films', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="film-view">

    <div style="float: left;">
        <?= Html::img($model->getImage(), ['width' => '250px', 'height' => '250px', 'alt' => 'bad connection']) ?>
        <h2><?= Html::a('Ссылка на трейлер', [$model->trailer_link]) ?></h2>
    </div>
    <div style="float: right; width: 70%">
        <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'year' =>[
                'value' => $model->year,
                'label' => 'год',
            ],
            'country' => [
                'label' => 'Страна',
                'value' => $model->country,
            ],
            'slogan' => [
                'value' => $model->slogan,
                'label' => 'Слоган',
            ],
            ['attribute' => 'rejeser_id',
                'label' => 'Режисёр',
                'value' => function($data){
                    return Html::a(Rejeser::findOne($data->rejeser_id)->name, Url::to("../rejeser/view?id=".$data->rejeser_id));
                },
                'format' => 'raw',
            ],
            ['attribute' => 'world_rating_id',
                'label' => 'Рейтинг MPAA',
                'value' => Html::img(WorldRating::findOne($model->world_rating_id)->getImage(), ['width' => '20px', 'height' => '20px', 'alt' => 'bad connection']),
                'format' => 'raw',
            ],
            'size',
            'rating',
        ],
    ]) ?>

        </div>


    <div style="margin-top: 50px;width: 100%;overflow:hidden ">
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

    <?php
    if (!Yii::$app->user->isGuest){
       echo BlyatWidget::widget(['filmId' => $model->id,]);
    } ?>
    </div>

    <?= SykaWidget::widget(['model' => $model, 'which' => 1]); ?>

</div>
