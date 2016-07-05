<?php
namespace backend\controllers;

use Yii;
use common\models\database\Question;
use common\models\database\QuestionSearch;
use common\models\database\Answer;
use common\models\database\AnswerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use common\models\database\Gallery;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
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
                    'deleteanswer' => ['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
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
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $searchModel = new AnswerSearch();
            $searchModel->question_id=$id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('update', [
                'model' => $model,
                'all_types' =>$this->getQuestionTypes(),
                'id' => $model->getAttribute('test_id'), 
                'answers_model' =>$dataProvider,
            ]);
        }
    }
    
    /**
     * @param integer $id
     * @return mixed
     */
    public function actionTest($id)
    {
        $searchModel = new QuestionSearch();
        if(isset($id)){
            $searchModel->test_id=$id;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id'=> $id
        ]);
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
    */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $test_id = $model->getAttribute('test_id');
        $model->delete();
        return $this->redirect(['test', 'id'=>$test_id]);
    }

    /**
     * Deletes an existing Amswer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
    */
    public function actionDeleteanswer($id)
    {
        if (($model = Answer::findOne($id)) !== null) {
            $question_id= $model->getAttribute('question_id');
            $model->delete();
            return $this->redirect(['update', 'id'=>$question_id]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Save All answers
     * @return mixed
    */
    public function actionSaveanswers($id)
    {
        $allAnswers=[];
        if(Yii::$app->request->post('Answer')){
            $typeQuestion = Question::findOne(Yii::$app->request->post('Answer')[1]['question_id']);
            $validate_flag=true;
           foreach (Yii::$app->request->post('Answer') as $answer){
                $tempVar['Answer']=$answer;
                if($typeQuestion->getAttribute('question_type_id')==5){
                    $tempVar['Answer']['title'] = serialize($answer['title']);
                }
                $answerModel = new Answer();
                $answerModel ->load($tempVar);
                $validate_flag = $answerModel->validate() ? $validate_flag : false;
                array_push($allAnswers,   $answerModel);
            }
            //save all models
            if($validate_flag){
                foreach($allAnswers as $answer){
                    $answer->save();
                }
                return $this->actionTest($id);
            }
            return $this->actionTest($id);
        }
        return $this->actionTest($id);
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelAnswer($id)
    {
        if (($model = Answer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*
        Return array of the question type for dropdown
    */
    protected function getQuestionTypes()
    {
        $query = new Query;
        $query->select('id, description')->from('question_type');
        $types = $query->all();
       
        $all_types = array_column($types, 'description', 'id');
        return $all_types;
    }
    
    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Question();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //Select form view template according to selected form
            return $this->createAnswerSwitch($model);
        } else {
            return $this->render('create', [
                'model' => $model,
                'all_types' =>$this->getQuestionTypes(),
                'id' => $id
            ]);
        }
    }
    
    /**
     * Creates a new Answer.
     * If creation is successful, the browser will be redirected to the 'create' page.
     * @return mixed
     */
    public function actionAddanswer($id)
    {
        $model = $this->findModel($id);
        $model->answers_cnt=1;
        return $this->createAnswerSwitch($model);
        
    }
    
    /**
     * Switch form tampale when create new answers
     * @param object $model (model of Answer record)
     * @return mixed
     */
    protected function createAnswerSwitch($model){
        switch ($model->questionType->getAttribute('slug')) {
            case 'sympleText':
                return $this->renderingQuestionTypeCreate($model, '_sympletext');
                break;
            case 'sympleImage':
                return $this->renderingQuestionTypeCreate($model, '_sympleimage');
                break;
            case 'textImage':
                return $this->renderingQuestionTypeCreate($model, '_textimage');
                break;
            case 'skinColor':
                return $this->renderingQuestionTypeCreate($model, '_skincolor');
            case 'aboutMeColour':
                return $this->renderingQuestionTypeCreate($model, '_aboutmecolour');
                break;
            case 'aboutMeTwo':
                return $this->renderingQuestionTypeCreate($model, '_aboutmetwo');
                break;
            case 'aboutMeOne':
                return $this->renderingQuestionTypeCreate($model, '_aboutmeone');
                break;
            case 'coloring':
                return $this->renderingQuestionTypeCreate($model, '_coloring');
                break;
            case 'face':
                return $this->renderingQuestionTypeCreate($model, '_face');
                break;
            case 'hair':
                return $this->renderingQuestionTypeCreate($model, '_hair');
                break;
            case 'eyes':
                return $this->renderingQuestionTypeCreate($model, '_hair');
                break;
            case 'user_foto':
                return $this->renderingQuestionTypeUpdate($model, '_user_foto');
                break;
            default:
                $model->delete();
                return $this->redirect(['index']);
                break;
        }
    }

     /**
     * Updates an existing Answers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateanswers($id)
    {
        $model = $this->findModel($id);
        return $this->updateAnswerSwitch($model);
    }
    
    /**
     * Switch form tampale when create new answers
     * @param object $model (model of Answer record)
     * @return mixed
     */
    protected function updateAnswerSwitch($model){
        switch ($model->questionType->getAttribute('slug')){
            case 'sympleText':
                return $this->renderingQuestionTypeUpdate($model, '_sympletext');
                break;
            case 'sympleImage':
                return $this->renderingQuestionTypeUpdate($model, '_sympleimage');
                break;
            case 'textImage':
                return $this->renderingQuestionTypeUpdate($model, '_textimage');
                break;
            case 'skinColor':
                return $this->renderingQuestionTypeCreate($model, '_skincolor');
            case 'aboutMeColour':
                return $this->renderingQuestionTypeUpdate($model, '_aboutmecolour');
                break;
            case 'aboutMeTwo':
                return $this->renderingQuestionTypeUpdate($model, '_aboutmetwo');
                break;
            case 'aboutMeOne':
                return $this->renderingQuestionTypeUpdate($model, '_aboutmeone');
                break;
            case 'coloring':
                return $this->renderingQuestionTypeUpdate($model, '_coloring');
                break;
            case 'face':
                return $this->renderingQuestionTypeUpdate($model, '_face');
                break;
            case 'hair':
                return $this->renderingQuestionTypeUpdate($model, '_hair');
                break;
            case 'eyes':
                return $this->renderingQuestionTypeUpdate($model, '_hair');
                break;
            case 'user_foto':
                return $this->renderingQuestionTypeUpdate($model, '_user_foto');
                break;
            default:
                $model->delete();
                return $this->redirect(['index']);
                break;
        }
    }

    /*
    *    Creating models and rendering SympleText form template  
    */
    protected function renderingQuestionTypeUpdate($model, $template)
    {
        $allAnswers=[];
        if(Yii::$app->request->post('Answer')){
            $validate_flag=true;

            foreach (Yii::$app->request->post('Answer') as $answer){
                $tempVar['Answer']=$answer;
                if($template =='_aboutmecolour'){
                    $tempVar['Answer']['title'] = serialize($answer['title']);
                }
//                print_r($tempVar);die()
                $answerModel = $this->findModelAnswer($answer['id']);
                $answerModel ->load($tempVar);
//                $validate_flag->save();
                $validate_flag = $answerModel->validate() ? $validate_flag : false;
                array_push($allAnswers,   $answerModel);
            }
            //save all models
            if($validate_flag){

                foreach($allAnswers as $answer){
                    $answer->save();
                }
                return $this->actionTest($model->getAttribute('test_id'));
            }
            return $this->render('updateanswers', [
                'answers_models' => $allAnswers,
                'id' => $model->getAttribite('id'),
                'template' => $template,
            ]);
        }
        else{
            $allAnswers =  Answer::find()
            ->where(['=', 'question_id' , $model->getAttribute('id')])
            ->all();            

            return $this->render('updateanswers', [
                'answers_models' => $allAnswers,
                'id' => $model->getAttribute('id'),
                'template' => $template,
            ]);
        }
    }
    
    /*
    *    Creating models and rendering SympleText form template  
    */
    protected function renderingQuestionTypeCreate($model, $template)
    {
        $answers_models=[];
        if($template=='_skincolor'){
            $model->answers_cnt +=2;
        }
        if($template=="_hair" && $model->answers_cnt!=1){
            $model->answers_cnt*=4;
        }
        for($i=$model->answers_cnt; $i>0; $i--){
            $answer = new Answer();
            $answer->setAttribute('question_id', $model->id);
            $answers_models[$i]= $answer;
        }
        return $this->render('createanswers', [
            'answers_models' => $answers_models,
            'id' => $model->getAttribute('test_id'),
            'template' => $template,

        ]);
    }
}