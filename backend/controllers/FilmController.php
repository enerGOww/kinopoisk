<?php

namespace backend\controllers;

use common\repositories\GenreRepository;
use common\repositories\RejeserRepository;
use common\repositories\WorldRatingRepository;
use Yii;
use common\essence\Film;
use backend\models\FilmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\essence\ImageUploader;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use common\repositories\ActorRepository;
/**
 * FilmController implements the CRUD actions for Film model.
 */
class FilmController extends Controller
{

    private $actorRepository;
    private $genreRepository;
    private $worldRatingRepository;
    private $rejeserRepository;

    public function __construct($id, $module,
        ActorRepository $actorRepository,
        GenreRepository $genreRepository,
        WorldRatingRepository $worldRatingRepository,
        RejeserRepository $rejeserRepository,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->actorRepository = $actorRepository;
        $this->genreRepository = $genreRepository;
        $this->worldRatingRepository = $worldRatingRepository;
        $this->rejeserRepository = $rejeserRepository;
    }

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
     * Lists all Film models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FilmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Film model.
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
     * Creates a new Film model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Film();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Film model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Film model.
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
     * Finds the Film model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Film the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Film::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id)
    {
        $model = new ImageUploader;
        if (Yii::$app->request->isPost){
            $film = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');
            if($film->saveImage($model->uploadFile($file, $film->image))){
                return $this->redirect(['view', 'id' => $film->id]);
            }
        }
        return $this->render('image', ['model' => $model]);
    }

    public function actionSetGenre($id)
    {
        $film = $this->findModel($id);
        $selectedGenre = $film->getSelectedGenre(); //
        $genre = ArrayHelper::map($this->genreRepository->getAllGenre(), 'id', 'description');
        if(Yii::$app->request->isPost)
        {
            $genre = Yii::$app->request->post('genre');
            $film->saveGenre($genre);
            return $this->redirect(['view', 'id'=>$film->id]);
        }

        return $this->render('genre', [
            'selectedGenre'=>$selectedGenre,
            'genre'=>$genre
        ]);
    }

    public function actionSetActor($id)
    {
        $film = $this->findModel($id);
        $selectedActor = $film->getSelectedActor(); //
        $actor = ArrayHelper::map($this->actorRepository->getAllActors(), 'id', 'name');
        if(Yii::$app->request->isPost)
        {
            $actor = Yii::$app->request->post('actor');
            $film->saveActor($actor);
            return $this->redirect(['view', 'id'=>$film->id]);
        }

        return $this->render('actor', [
            'selectedActor'=>$selectedActor,
            'actor'=>$actor
        ]);
    }

    public function actionSetRejeser($id)
    {
        $film = $this->findModel($id);
        $selectedRejeser = $film->rejeser_id;
        $rejesers = ArrayHelper::map($this->rejeserRepository->getAllRejesers(), 'id', 'name');
        if(Yii::$app->request->isPost){
            $rejeser = Yii::$app->request->post('rejeser');
            if($film->saveRejeser($rejeser)) {
                return $this->redirect(['view', 'id' => $film->id]);
            }
        }
        return $this->render('rejeser', [
            'film' => $film,
            'selectedRejeser' => $selectedRejeser,
            'rejesers' => $rejesers,
        ]);
    }

    public function actionSetWorldRating($id)
    {
        $film = $this->findModel($id);
        $selectedWorldRating = $film->world_rating_id;
        $worldRatings = ArrayHelper::map($this->worldRatingRepository->getAllWorldRatings(), 'id', 'name');
        if(Yii::$app->request->isPost){
            $worldRating = Yii::$app->request->post('rejeser');
            if($film->saveRejeser($worldRating)) {
                return $this->redirect(['view', 'id' => $film->id]);
            }
        }
        return $this->render('worldRating', [
            'film' => $film,
            'selectedWorldRating' => $selectedWorldRating,
            'worldRatings' => $worldRatings,
        ]);
    }
}
