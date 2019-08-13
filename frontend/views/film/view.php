<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\CommentWidget;
use common\widgets\CommentFormWidget;
use yii\helpers\Url;
use common\widgets\GetGenreWidget;
use common\widgets\ActorLinkListWidget;
use common\widgets\LikeThisFilmWidget;
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
            <?= Html::a('Добавить в избранное', ['add-to-favorites', 'id' => $model->id], [
                'class' => 'btn btn-primary',
                'data' => [
                    'confirm' => 'Добавить в избранное?',
                    'method' => 'post',
                ],
            ]) ?>
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
                    'value' =>
                        Html::a(($model->rejeser->name), Url::to("../rejeser/view?id=".$model->rejeser_id)),

                    'format' => 'raw',
                ],
                ['attribute' => 'world_rating_id',
                    'label' => 'Рейтинг MPAA',
                    'value' => Html::img(($model->worldRating->getImage()), ['width' => '20px', 'height' => '20px', 'alt' => 'bad connection']),
                    'format' => 'raw',
                ],
                [
                    'label' => 'Жанры',
                    'value' => GetGenreWidget::widget(['allGenres' => $model->filmGenres]),
                    'format' => 'raw',
                ],
                [
                    'label' => 'Актёры',
                    'value' => ActorLinkListWidget::widget(['allActors' => $model->filmActors]),
                    'format' => 'raw',
                ],
                'size',
                'rating',
            ],
        ]) ?>

        </div>
    </div>
    <?php if (Yii::$app->session->hasFlash('comment')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('comment') ?>
        </div>
    <?php endif; ?>
    <div style="border: #0f0f0f solid 1px; background-color: lightgray">
        <h4 style="text-align: center;">Похожие фильмы:</h4>
    </div>
    <p style="border: #0f0f0f solid 1px; background-color: gray; text-align: center">
        <?= LikeThisFilmWidget::widget(['allGenres' => $model->filmGenres, 'filmId' => $model->id]) ?>
    </p>

    <div style="margin-top: 50px;width: 100%;overflow:hidden ">


    <?php
    if (!Yii::$app->user->isGuest){
       echo CommentFormWidget::widget(['filmId' => $model->id,]);
    } ?>
    </div>

    <?= CommentWidget::widget(['model' => $model, 'which' => 1]); ?>

</div>
