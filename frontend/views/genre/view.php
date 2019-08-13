<?php


use yii\helpers\Html;
use common\widgets\GridForFilmsByIdWidget;


/* @var $model common\essence\Genre */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Genres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="genre-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridForFilmsByIdWidget::widget(['id' => $model->id, 'flag' => 1]) ?>


</div>
