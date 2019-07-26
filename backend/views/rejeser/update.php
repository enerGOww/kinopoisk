<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\essence\Rejeser */

$this->title = 'Update Rejeser: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rejesers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rejeser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
