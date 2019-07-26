<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\essence\Rejeser */

$this->title = 'Create Rejeser';
$this->params['breadcrumbs'][] = ['label' => 'Rejesers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rejeser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
