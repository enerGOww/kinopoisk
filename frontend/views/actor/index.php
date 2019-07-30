<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ActorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a('Сбросить сортировку', Url::to('/actor/ ')); ?>

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
                    return Html::a($data->name, Url::to("/actor/view?id=".$data->id));
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
