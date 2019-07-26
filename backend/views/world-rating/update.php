<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\essence\WorldRating */

$this->title = 'Update World Rating: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'World Ratings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="world-rating-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
