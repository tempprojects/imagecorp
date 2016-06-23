<?php

namespace backend\controllers;

use Yii;
use common\models\database\Gallery;
use common\models\database\Slider;
use common\models\main\UploadForm;
use yii\web\UploadedFile;

class MediaController extends \yii\web\Controller
{

    public $type;
    
    public function actions(){
        if(Yii::$app->user->isGuest){
            $this->redirect(['user/security/login']);
        }
        $this->type = Yii::$app->params['typeImage']['name'];
    }

    public function actionIndex($type = 0)
    {

        if($type){
            $model = Gallery::find()->where(['type' => $type])->orderBy(['id' => SORT_DESC])->all();
        }
        else{
            $model = Gallery::find()->orderBy(['id' => SORT_DESC])->all();
        }
        return $this->render('index',[
            'model' => $model,
            'type'  => $this->type,
        ]);
    }

    public function actionGalleryLoad($id = 0)
    {
        $model = new Gallery();
        if($id){
            $model = Gallery::findOne(['id' => $id]);
        }
        $image = new UploadForm();
        if(Yii::$app->request->post()){
            if($model->load(Yii::$app->request->post())){
                $image->imageFile = UploadedFile::getInstance($image, 'imageFile');
                if($image->imageFile){
                    $data = $image->upload($model->type);
                    $model->name = $data['name'];
                    $model->extension = $data['extension'];
                    $model->src = $data['src'];
                }
                if(!$model->id){
                    $model->created_at = time();
                }
                $model->updated_at = time();
                $model->save();
                $this->redirect(['index']);
            }
        }
        return $this->render('gallery-load',[
            'model' => $model,
            'image' => $image,
            'type'  => $this->type,
        ]);
    }

    public function actionIndexSlide()
    {
        $model = Slider::find()->all();
        return $this->render('index-slide',[
            'model' => $model,
        ]);
    }

    public function actionCreateSlide()
    {
        $model = new Slider();
        $images = [];
        foreach (Gallery::find()->where(['type' => 3])->all() as $item) {
            $images[$item->id] = $item->src;
        }
        if(Yii::$app-> request->isPost){
            if($model->load(Yii::$app->request->post())){
                $model->image_id = serialize($model->image_id);
                $model->created_at = strtotime($model->created_at);
                $model->updated_at = strtotime($model->updated_at);
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'OK');
                    return $this->redirect(['index-slide']);
                }
                else{
                    Yii::$app->session->setFlash('warning', 'ERRORE');
                    return $this->redirect(['index-slide']);
                }
            }
        }
        return $this->render('create-slide',[
            'model' => $model,
            'images' => $images,
        ]);
    }

    public function actionUpdateSlide($id)
    {
        $model = Slider::findOne(['id' => $id]);
        $images = [];
        foreach (Gallery::find()->where(['type' => 3])->all() as $item) {
            $images[$item->id] = $item->src;
        }
        if(Yii::$app-> request->isPost){
            if($model->load(Yii::$app->request->post())){
                $model->image_id = serialize($model->image_id);
                $model->updated_at = strtotime($model->updated_at);
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'OK');
                    return $this->redirect(['index-slide']);
                }
                else{
                    Yii::$app->session->setFlash('warning', 'ERRORE');
                    return $this->redirect(['index-slide']);
                }
            }
        }
        return $this->render('update-slide',[
            'model' => $model,
            'images' => $images,
        ]);
    }

}
