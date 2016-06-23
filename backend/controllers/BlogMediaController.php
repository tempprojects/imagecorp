<?php

namespace backend\controllers;

use common\models\database\Gallery;
use common\models\database\Slider;
use Yii;
use common\models\database\BlogMedia;
use common\models\search\BlogMedia as BlogMediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogMediaController implements the CRUD actions for BlogMedia model.
 */
class BlogMediaController extends Controller
{

    public $typeCategory = [
        'Фотография',
        'Слайдер',
        'Видео'
    ];

    /**
     * @inheritdoc
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

    public function actions(){
        if(Yii::$app->user->isGuest){
            $this->redirect(['user/security/login']);
        }
    }

    /**
     * Lists all BlogMedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogMedia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlogMedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogMedia();
        $slider = [];
        foreach (Slider::find()->all() as $item) {
            $slider[$item->id] = $item->id;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'typeCategory' => $this->typeCategory,
                'img' => false,
                'slider' => $slider,
            ]);
        }
    }

    /**
     * Updates an existing BlogMedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $slider = [];
        foreach (Slider::find()->all() as $item) {
            $slider[$item->id] = $item->id;
        }
        $img = false;
        if($model->type_media == 0){
            $img = Gallery::findOne(['id' => $model->img])->src;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'typeCategory' => $this->typeCategory,
                'slider' => $slider,
                'img' => $img,
            ]);
        }
    }

    /**
     * Deletes an existing BlogMedia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BlogMedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogMedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogMedia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
