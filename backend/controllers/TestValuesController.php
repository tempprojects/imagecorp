<?php

namespace backend\controllers;

use common\models\database\Test;
use Yii;
use common\models\database\TestValues;
use common\models\search\TestValuesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestValuesController implements the CRUD actions for TestValues model.
 */
class TestValuesController extends Controller
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

    /**
     * Lists all TestValues models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new TestValuesSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    /**
     * Displays a single TestValues model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**loadMultiple yii2
     * Creates a new TestValues model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
    */
    public function actionCreate($id)
    {
        $newModel = new TestValues();
        $newModel->setAttribute('test_id', $id);
        $model = TestValues::find()->where(['=', "test_id", $id])->all();

        if(Yii::$app->request->post()){
            $validate_flag = true;
            $allTempModels=[];
            foreach (Yii::$app->request->post('TestValues') as $testValues ){
                $tempVar['TestValues']=$testValues;
                if($testValues['id']){
                    $modelTestValues =  $this->findModel($testValues['id']);
                    $modelTestValues->load($tempVar);
                }
                else{
                     $modelTestValues =  clone $newModel;
                     $modelTestValues->load($tempVar);
                }

                $validate_flag = $modelTestValues->validate() ? $validate_flag : false;
                array_push($allTempModels,   $modelTestValues);
            }

           if($validate_flag){
                foreach($allTempModels as $tempModel){
                    $tempModel->save();
                }
            }

            return $this->render('create', [
                   'model' => $allTempModels,
               ]);
        } else {
            $model = $model ? $model : array($newModel);

            return $this->render('create', [
                'model' => $model,

            ]);
        }
    }

    /**
     * Updates an existing TestValues model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing TestValues model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return 1;
    }

    /**
     * Finds the TestValues model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestValues the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestValues::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
