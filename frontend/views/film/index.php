<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FilmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Films';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a('Сбросить сортировку', Url::to('/film/ ')); ?>
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
            ['attribute' => 'title',
                'value' => function($data){
                    return Html::a($data->title, Url::to("/film/view?id=".$data->id));
                },
                'format' => 'raw',
            ],
            'rating',
            'country',
            'year',
//            'slogan',
//            'rejeser_id',
//            'world_rating_id',
//            'size',
//            'trailer_link',
//            'id',


        ],
    ]); ?>


</div>
