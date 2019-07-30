<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RejeserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rejesers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rejeser-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a('Сбросить сортировку', Url::to('/rejeser/ ')); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'format' => 'html',
                'label' => 'Image',
                'value' => function($data){
                    return Html::img($data->getImage(),['width' => '75px',]);
                }
            ],
            ['attribute' => 'name',
                'value' => function($data){
                    return Html::a($data->name, Url::to("/rejeser/view?id=".$data->id));
                },
                'format' => 'raw',
            ],

            'id',
            'year',
            'place',
            'height',
            'reward',
            //'image',


        ],
    ]); ?>


</div>
