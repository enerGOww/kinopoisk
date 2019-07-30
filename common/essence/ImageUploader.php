<?php


namespace common\essence;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
class ImageUploader extends Model
{
    /* @var $image UploadedFile*/

    /*
    for essence:

     public function saveImage($fileName)
    {
        $this->image= $fileName;
        return $this->save(false);
    }
    public function getImage()
    {
        return ($this->image) ? '/uploads/'. $this->image : '/uploads/no-image.png';
    }
    private function deleteImage()
    {
        $imageModel = new ImageUploader();
        $imageModel->deleteImage($this->image);
    }
    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }

    for controller:

     public function actionSetImage($id)
    {
        $model = new ImageUploader;
        if (Yii::$app->request->isPost){
            $article = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');
            if($article->saveImage($model->uploadFile($file, $article->image))){
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }
        return $this->render('image', ['model' => $model]);
    }

    for view:

    <?= Html::a('Set image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    <?= Html::img($model->getImage(), ['alt' => 'bad connection']) ?>

    for index:

     [
         'format' => 'html',
         'label' => 'Image',
         'value' => function($data){
            return Html::img($data->getImage(),['width' => '75px',]);
         }
     ],
    */
    public $image;
    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png'],
        ];
    }
    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;
        if($this->validate()) {
            $this->deleteImage($currentImage);
            return $this->saveFile();
        }
    }
    public function fileExists($currentImage)
    {
        if(!empty($currentImage) && $currentImage != null) {
            return file_exists($this->getFolder() . $currentImage);
        }
    }
    private function getFolder()
    {
        return str_replace('/','\\', Yii::getAlias('@frontend') . '/web/uploads/');
    }
    private function generateFileName()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }
    public function deleteImage($currentImage)
    {
        if ($this->fileExists($currentImage)) {
            unlink($this->getFolder() . $currentImage);
        }
    }
    public function saveFile()
    {
        $fileName = $this->generateFileName();
        $path = $this->getFolder() . $fileName;
        $this->image->saveAs($path);
        return $fileName;
    }
}


