<?php

namespace backend\controllers;

use common\models\database\Test;
use Yii;
use common\models\database\TestValues;
use common\models\database\TestValuesSearch;
use common\models\database\TestValuesMatrix;
use common\models\database\TestValuesMatrixSearch;
use common\models\database\Question;
use yii\base\DynamicModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

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
                    'delete'        => ['POST'],
                    'blockmatrix'   => ['POST'],
                    'deletematrix'  => ['POST']
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
        $newModel = new TestValuesMatrix();
        $newModel->setAttribute('test_id', $id);
        $model = TestValues::find()->where(['=', "test_id", $id])->all();

        //matrix model
        $searchModelMatrix = new TestValuesMatrixSearch();
        $dataProviderMatrix = $searchModelMatrix->search(Yii::$app->request->queryParams);

        
        
        //creating dinamic model for creatin matrix
        $matrixModel = DynamicModel::validateData(array('question_horizontal_id', 'question_vertical_id'), [
                             [['question_horizontal_id', 'question_vertical_id'], 'required', 'skipOnEmpty'=>true],
                             [['question_horizontal_id', 'question_vertical_id'], 'integer'],
                             [['question_horizontal_id'], 'compare', 'compareAttribute'=>'question_vertical_id', 'operator'=>'!='],
                             [['question_vertical_id'], 'compare', 'compareAttribute'=>'question_horizontal_id', 'operator'=>'!=']
                        ]);

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
                   'matrixModel' => $matrixModel,
                   'searchModelMatrix' => $searchModelMatrix,
                   'dataProviderMatrix' =>$dataProviderMatrix
               ]);
        } else {
            $model = $model ? $model : array($newModel);

            return $this->render('create', [
                'model' => $model,
                'matrixModel' => $matrixModel,
                'searchModelMatrix' => $searchModelMatrix,
                'dataProviderMatrix' =>$dataProviderMatrix
            ]);
        }
    }

    /**Create matrix for test result
     * Creates a new TestValues model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
    */
    public function actionCreatematrix(){        
        if(Yii::$app->request->post('DynamicModel')){
            $questionH = Question::findOne(Yii::$app->request->post('DynamicModel')['question_horizontal_id']);
            $questionV = Question::findOne(Yii::$app->request->post('DynamicModel')['question_vertical_id']);

            $cntAnswersH  = count($questionH->answers);
            $cntAnswersOffsetH = (int)($cntAnswersH/4);
            $cntAnswersV  = count($questionV->answers);
            $cntAnswersOffsetV = (int)($cntAnswersV/4);

            for($i=$cntAnswersOffsetV; $i<$cntAnswersV; $i++){
                for($j=$cntAnswersOffsetH; $j<$cntAnswersH; $j++){
                   $ownModel["{$questionV->answers[$i]->getAttribute('value')}"]["{$questionH->answers[$j]->getAttribute('value')}"]=0;
                }
            }

            return $this->render('creatematrix', [
                'ownModel' => $ownModel,
                'questionH' => $questionH,
                'questionV' => $questionV,
                'testValues' => TestValues::getTestValues($questionH->getAttribute('test_id')),
            ]);
        }

        //creating and save matrix
        if(Yii::$app->request->post('TestValuesMatrix')){
            $testValuesMatrix = new TestValuesMatrix();

            //var_dump(Yii::$app->request->post('TestValuesMatrix'));
            $myPost['TestValuesMatrix'] = Yii::$app->request->post('TestValuesMatrix');
            $myPost['TestValuesMatrix']['serialize'] = serialize($myPost['TestValuesMatrix']['serialize']);
            
            //check if it's a first matrix for test
            $Allmatrixes = TestValuesMatrix::find()->where(['and', "test_id=" . $myPost['TestValuesMatrix']['test_id']])->all();
            
            $model = new TestValuesMatrix();
            
            if(!$Allmatrixes){
                $model->setAttribute('active_flag', 1);
            }
            
            if ($model->load($myPost) && $model->save()) {
                return $this->redirect(['create', 'id' => $model->test_id]);
            } else {
                $questionH = Question::findOne(Yii::$app->request->post('TestValuesMatrix')['question_horizontal_id']);
                $questionV = Question::findOne(Yii::$app->request->post('TestValuesMatrix')['question_vertical_id']);
                return $this->render('creatematrix', [
                    'ownModel' => Yii::$app->request->post('TestValuesMatrix')['serialize'],
                    'questionH' => $questionH,
                    'questionV' => $questionV,
                    'testValues' => TestValues::getTestValues($questionH->getAttribute('test_id')),
                ]);
            }
        }
    }

    /**
     * Updates an existing TestValuesMatrix model.
     * If update is successful, the browser will be redirected to the 'create' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModelMatrix($id);
        if (Yii::$app->request->post()) {
            //if ($model->load(Yii::$app->request->post()) && $model->save()) 
            $myPost['TestValuesMatrix'] = Yii::$app->request->post('TestValuesMatrix');
            $myPost['TestValuesMatrix']['serialize'] = serialize($myPost['TestValuesMatrix']['serialize']);
            
            if ($model->load($myPost) && $model->save()) {
                return $this->redirect(['create', 'id' => $model->test_id]);
            } else {
                return $this->render('updatematrix', [
                    'ownModel' => Yii::$app->request->post('TestValuesMatrix')['serialize'],
                    'questionH' => $model->questionHorizontal,
                    'questionV' => $model->questionVertical,
                    'testValues' => TestValues::getTestValues($questionH->getAttribute('test_id')),
                ]);
            }

        } else {
            return $this->render('updatematrix', [
                 'ownModel' => unserialize($model->getAttribute('serialize')),
                 'questionH' => $model->questionHorizontal,
                 'questionV' => $model->questionVertical,
                 'testValues' => TestValues::getTestValues($model->getAttribute('test_id')),
            ]);
        }
    }

     /**
     * Change matrix active flag
     * If update is successful, the browser will be redirected to the 'create' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBlockmatrix($id){

        $matrix  = $this->findModelMatrix($id);
        if ($matrix->getAttribute('active_flag')) {
            $matrix->setAttribute('active_flag', 0);
            $matrix->save();
            Yii::$app->getSession()->setFlash('success','Matrix has been inactivated');
        } else {
            $Allmatrixes = TestValuesMatrix::find()->where(['and', "test_id=" . $matrix->getAttribute('test_id'), "id<>" . $matrix->getAttribute('id')])->all();

            foreach($Allmatrixes as $model){
                if($model->getAttribute('active_flag')){
                    $model->setAttribute('active_flag', 0);
                    $model->save();
                }
            }

            $matrix->setAttribute('active_flag', 1);
            $matrix->save();
            Yii::$app->getSession()->setFlash('success', 'Matrix has been activated');
        }
        return $this->redirect(['create', 'id' => $matrix->test_id]);
    }

     /**
     * Deletes an existing TestValuesMatrix model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeletematrix($id)
    {
        $model = $this->findModelMatrix($id);
        $test_id = $model->getAttribute('test_id');
        $model->delete();
        return $this->redirect(['create', 'id' => $test_id]);
    }
    

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

     /**
     * Finds the TestValuesMatrix model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestValues the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelMatrix($id)
    {
        if (($model = TestValuesMatrix::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}