<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\SykaWidget\SykaWidget;
use frontend\widgets\blyatWidget\BlyatWidget;
use common\essence\Rejeser;
use yii\helpers\Url;
use common\essence\WorldRating;
use frontend\widgets\getGenreWidget\GetGenreWidget;
use frontend\widgets\actorLinkList\ActorLinkList;
use frontend\widgets\likeThisFilmWidget\LikeThisFilmWidget;
/* @var $this yii\web\View */
/* @var $model common\essence\Film */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Films', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="film-view">
    <div class="" style="display:flex;flex-direction: row;">
        <div style="margin-right: 20px">
            <?= Html::img($model->getImage(), ['height' => '400px', 'alt' => 'bad connection']) ?>
            <h2><?= Html::a('Ссылка на трейлер', Url::to($model->trailer_link)) ?></h2>
        </div>
        <div style="width: 70%">
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
                [
                    'label' => 'Жанры',
                    'value' => GetGenreWidget::widget(['allGenres' => $model->filmGenres]),
                    'format' => 'raw',
                ],
                [
                    'label' => 'Актёры',
                    'value' => ActorLinkList::widget(['allActors' => $model->filmActors]),
                    'format' => 'raw',
                ],
                'size',
                'rating',
            ],
        ]) ?>

        </div>
    </div>
    <div style="border: #0f0f0f solid 1px; background-color: lightgray">
        <h4 style="text-align: center;">Похожие фильмы:</h4>
    </div>
    <p style="border: #0f0f0f solid 1px; background-color: gray; text-align: center">
        <?= LikeThisFilmWidget::widget(['allGenres' => $model->filmGenres, 'filmId' => $model->id]) ?>
    </p>

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
