<?php


use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\GridForFilmsByGenreIdWidget;


/* @var $model common\essence\Genre */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Genres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="genre-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridForFilmsByGenreIdWidget::widget(['genreId' => $model->id]) ?>


</div>
