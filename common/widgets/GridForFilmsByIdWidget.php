<?php


namespace common\widgets;

use common\repositories\GenreRepository;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\repositories\UserRepository;
class GridForFilmsByIdWidget extends Widget
{
    public $id;
    public $flag;

    public function run()
    {
        if($this->flag==1){
            $query = GenreRepository::getFilmsWithGenre($this->id);
            $films = new ActiveDataProvider(['query' => $query]);
        } elseif ($this->flag==2) {
            $query = UserRepository::getFavoriteFilms($this->id);
            $films = new ActiveDataProvider(['query' => $query]);
        }

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