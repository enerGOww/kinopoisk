<?php

use frontend\widgets\BestFilms;
use frontend\widgets\blyatWidget\BlyatWidget;
use frontend\widgets\GetAllFilmsForRejeser;
use frontend\widgets\SykaWidget\SykaWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;
use \frontend\widgets\GetGeresForActorRejeser;

/* @var $this yii\web\View */
/* @var $model common\essence\Rejeser */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rejesers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rejeser-view">

    <div class="" style="display:flex;flex-direction: row;">
        <div style="margin-right: 40px">
            <?= Html::img($model->getImage(), ['height' => '400px', 'width' => '275px', 'alt' => 'bad connection']) ?>
        </div>
        <div style="width: 70%">

            <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'year' =>[
                'label' => 'Дата рождения',
                'value' => $model->year,
            ],
            'place'=>[
                'label' => 'Страна',
                'value' => $model->place,
            ],
            'height'=>[
                'label' => 'Рост',
                'value' => $model->height,
            ],
            [
                'label' => 'Жанры',
                'value' => GetGeresForActorRejeser::widget(['allFilms' => $model->films, 'flag' => 2]),
                'format' => 'raw',
            ],
            [
                'label' => 'Фильмы',
                'value' => GetAllFilmsForRejeser::widget(['allFilms' => $model->films]),
                'format' => 'raw',
            ],
            [
                'label' => 'Всего фильмов',
                'value' => count($model->films),
                'format' => 'raw',
            ],
            'reward'=>[
                'label' => 'Награды',
                'value' => $model->reward,
            ],
        ],
    ]) ?>
        </div>
    </div>
    <br>

    <div style="border: #0f0f0f solid 1px; background-color: lightgray">
        <h4 style="text-align: center;">Лучшие фильмы:</h4>
    </div>
    <p style="border: #0f0f0f solid 1px; background-color: gray; text-align: center">
        <?= BestFilms::widget(['allFilms' => $model->films, 'flag' => 2]) ?>
    </p>

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
        echo BlyatWidget::widget(['rejeserId' => $model->id,]);
    } ?>

    <?= SykaWidget::widget(['model' => $model, 'which' => 3]); ?>

</div>
