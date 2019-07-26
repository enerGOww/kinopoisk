<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\essence\WorldRating */

$this->title = 'Create World Rating';
$this->params['breadcrumbs'][] = ['label' => 'World Ratings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="world-rating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
