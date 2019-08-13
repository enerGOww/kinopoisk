<?php

namespace frontend\controllers;

use Yii;
use common\essence\Comment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Displays a single Comment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('comment', 'Вы добавили комментарий');

            if($model->actor_id ==null && $model->rejeser_id ==null) {
                return $this->redirect(['../film/view?id=' . $model->film_id]);
            }
            if($model->film_id ==null && $model->rejeser_id ==null) {
                return $this->redirect(['../actor/view?id=' . $model->actor_id]);
            }
            if($model->actor_id ==null && $model->film_id ==null) {
                return $this->redirect(['../rejeser/view?id=' . $model->rejeser_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateChild()
    {
        $model = new Comment();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('comment', 'Вы добавили комментарий');
            if($model->actor_id ==null && $model->rejeser_id ==null) {
                return $this->redirect(['../film/view?id=' . $model->film_id]);
            }
            if($model->film_id ==null && $model->rejeser_id ==null) {
                return $this->redirect(['../actor/view?id=' . $model->actor_id]);
            }
            if($model->actor_id ==null && $model->film_id ==null) {
                return $this->redirect(['../rejeser/view?id=' . $model->rejeser_id]);
            }
        }
        return $this->render('_childComment', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('comment', 'Вы отредактировали комментарий');
            if($model->actor_id ==null && $model->rejeser_id ==null) {
                return $this->redirect(['../film/view?id=' . $model->film_id]);
            }
            if($model->film_id ==null && $model->rejeser_id ==null) {
                return $this->redirect(['../actor/view?id=' . $model->actor_id]);
            }
            if($model->actor_id ==null && $model->film_id ==null) {
                return $this->redirect(['../rejeser/view?id=' . $model->rejeser_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
