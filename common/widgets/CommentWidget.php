<?php
namespace common\widgets;

use yii\base\Widget;
use Yii;
use common\essence\Comment;

class CommentWidget extends Widget
{
    public $model;
    public $which;

    public function run()
    {
        $userId = Yii::$app->user->id;

        if($this->which==1) {
            foreach (Comment::findAll(['film_id'=>$this->model->id, 'parent_id' => null]) as $item){
                echo $this->render('/comment\comentsview', ['model'=>$item, 'userId' => $userId]);
                echo $this->render('/comment\commentTree', ['model'=>$item, 'userId' => $userId]);
            }
        }
        if($this->which==2) {
            foreach (Comment::findAll(['actor_id'=>$this->model->id, 'parent_id' => null]) as $item){
                echo $this->render('/comment\comentsview', ['model'=>$item, 'userId' => $userId]);
                echo $this->render('/comment\commentTree', ['model'=>$item, 'userId' => $userId]);
            }
        }
        if($this->which==3) {
            foreach (Comment::findAll(['rejeser_id'=>$this->model->id, 'parent_id' => null]) as $item){
                echo $this->render('/comment\comentsview', ['model'=>$item, 'userId' => $userId]);
                echo $this->render('/comment\commentTree', ['model'=>$item, 'userId' => $userId]);
            }
        }

    }
}