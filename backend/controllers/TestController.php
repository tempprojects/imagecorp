<?php

namespace backend\controllers;

use Yii;
use common\models\database\Test;
use common\models\database\TestReferences;
use common\models\database\TestReferencesSearch;
use common\models\search\Test as TestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\database\Gallery;
use common\models\main\StringModel;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{
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
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
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
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Test();

        if ($model->load(Yii::$app->request->post())) {
            $model->alias = StringModel::str2url($model->title);
            $model->updated_at = strtotime($model->updated_at);
            $model->created_at = strtotime($model->created_at);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'img'   => null,
            ]);
        }
    }
    
    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddreftest()
    {
        $model = new TestReferences();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['update', 'id' => Yii::$app->request->post('TestReferences')['test_parrent_id']]);
        } else {
             return $this->redirect(['update', 'id' => Yii::$app->request->post('TestReferences')['test_parrent_id']]);
        }
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchModel = new TestReferencesSearch();
        $searchModel->test_parrent_id=$id;
        $dataProvider = $searchModel->search(['sort'=>'position']);
        $referenceModel = new TestReferences();
        $referenceModel->setAttribute('test_parrent_id', $id);

        if ($model->load(Yii::$app->request->post())) {
            $model->alias = StringModel::str2url($model->title);
            $model->updated_at = strtotime($model->updated_at);
            $model->created_at = strtotime($model->created_at);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'img' => Gallery::findOne(['id' => $model->img])->src,
                'dataProviderReference' => $dataProvider,
                'referenceModel' => $referenceModel
            ]);
        }
    }

    /**
     * Deletes an existing Test model.
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
     * Deletes an existing TestReferences model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
    */
    public function actionDeletechildtest($id)
    {
        $model = $this->findModelReference($id);
        $test_parrent_id = $model->getAttribute('test_parrent_id');
        $model->delete();
        return $this->redirect(['update', 'id' => $test_parrent_id]);
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     /**
     * Finds the TestReferences model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestReferences the loaded model
     * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModelReference($id)
    {
        if (($model = TestReferences::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
