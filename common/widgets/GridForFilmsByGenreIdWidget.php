<?php


namespace common\widgets;

use common\repositories\GenreRepository;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

class GridForFilmsByGenreIdWidget extends Widget
{
    public $genreId;

    public function run()
    {
        $query = GenreRepository::getFilmsWithGenre($this->genreId);
        $films = new ActiveDataProvider(['query' => $query]);

        return
            GridView::widget([
                'dataProvider' => $films,
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
                ],
            ]);
    }
}