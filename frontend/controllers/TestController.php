<?php
namespace frontend\controllers;

use common\models\database\TestValues;
use common\models\database\Test;
use common\models\database\Question;
use common\models\database\TestValuesMatrix;
use Yii;
use yii\web\Controller;
use yii\web\Session;
use yii\db\Query;
use yii\filters\VerbFilter;

/**
 * Site controller
*/
class TestController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js', ['depends' => 'yii\web\YiiAsset']);
        Yii::$app->view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/flexie/1.0.3/flexie.min.js', ['depends' => 'yii\web\YiiAsset']);
        Yii::$app->view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/bulma/0.0.16/css/bulma.min.css');
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');

        $model = Test::find()->where(['sort' => 1])->all();
            return $this->render('_textimage', [
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionInittest($id)
    {
        $testModel = Test::findOne($id);

        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

        $tests = $session->get('tests');
        
        $tests[$id]['type']= $testModel->getAttribute('result_type_id')==3?1:0;
        $tests[$id]['test_offset'] = 0;
        $tests[$id]['test_passed'] = 0;

        if($tests[$id]['type']){
            $tests[$id]['test_quantity']=count($testModel->testReferences);
            foreach ($testModel->testReferences as $key=> $test){
               $tests[$id]['tests'][$key]['test_id']=$test->getAttribute('test_child_id');
               $tests[$id]['tests'][$key]['passed_questions']=0;
               $tests[$id]['tests'][$key]['answewrs']=[];
               $tests[$id]['tests'][$key]['answewrsid']=[];
            }
        }
        else{
            $tests[$id]['test_quantity']=1;
            $tests[$id]['tests'][0]['test_id']=$id;
            $tests[$id]['tests'][0]['passed_questions']=0;
            $tests[$id]['tests'][0]['answewrs']=[];
            $tests[$id]['tests'][0]['answewrsid']=[];
        }

        $session->set('tests', $tests);
        $session->set('current_test', $id);
        //$session->remove('current_tests');
        $session->close();

        return $this->redirect(['test', 'number' => 1]);
    }

    /**
    * Displays homepage.
    *
    * @return mixed
    */
    public function actionTest($number)
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

        $currentTest = $session->get('current_test');
        $tests = $session->get('tests');
        //Check if not equal zero or empty
        if(!$number || !$tests || !$currentTest){
            $session->close();
            return $this->redirect(['site/list-test']);
        }

        $passedQuestions = $tests[$currentTest]['tests'][$tests[$currentTest]['test_offset']]['passed_questions'];
        
        
        //Check if $require number is more the
        if ($passedQuestions + 2 < $number) {
            $session->close();
            return $this->actionTest($passedQuestions + 1);
        }
        $questionsQuantity = count(Test::findOne( $tests[$currentTest]['tests'][$tests[$currentTest]['test_offset']]['test_id'])->question);
       
        
        //if isset post
        if (Yii::$app->request->post()) {
            $answewrs =  $tests[$currentTest]['tests'][$tests[$currentTest]['test_offset']]['answewrs'];
            $answewrsid= $tests[$currentTest]['tests'][$tests[$currentTest]['test_offset']]['answewrsid'];
            $answewrs[$number - 1] = Yii::$app->request->post('answer');
            $answewrsid[Yii::$app->request->post('answewrid')] = $number - 1;
            $tests[$currentTest]['tests'][$tests[$currentTest]['test_offset']]['answewrs']= $answewrs;
            $tests[$currentTest]['tests'][$tests[$currentTest]['test_offset']]['answewrsid']= $answewrsid;
            $tests[$currentTest]['tests'][$tests[$currentTest]['test_offset']]['passed_questions'] = $number - 1;
            $session->set('tests', $tests);           
        }

      
        //if test has been passed
        if ($number > $questionsQuantity) {
            if( $tests[$currentTest]['test_offset']+1<$tests[$currentTest]['test_quantity']){
                $tests[$currentTest]['test_offset']++;
                $tests[$currentTest]['test_passed']=1;
                $session->set('tests', $tests); 
                return $this->actionTest(1);
            }
            return $this->redirect(['/test/result', 'test' => $currentTest]);
        }

        $questionModel = Question::find()->where(['test_id' =>  $tests[$currentTest]['tests'][$tests[$currentTest]['test_offset']]['test_id']])->orderBy('priority')->offset($number - 1)->one();
        return $this->getQuestionSwith($questionModel, $number, $questionsQuantity);
    }

    /**
     * Switch form tampale when create new answers
     * @param object $model (model of Answer record)
     * @return mixed
     */
    protected function getQuestionSwith($model, $questionNumber, $questionsQuantity){
        Yii::$app->view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js', ['depends' => 'yii\web\YiiAsset']);
        Yii::$app->view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/flexie/1.0.3/flexie.min.js', ['depends' => 'yii\web\YiiAsset']);
        Yii::$app->view->registerJsFile('js/jquery.cropit.js', ['depends' => 'frontend\assets\AppAsset']);
        
        Yii::$app->view->registerJsFile('js/main.js', ['depends' => 'frontend\assets\AppAsset']);
        Yii::$app->view->registerJsFile('js/custom.js', ['depends' => 'frontend\assets\AppAsset']);
        Yii::$app->view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/bulma/0.0.16/css/bulma.min.css');
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
        //meta
        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $model->test->getAttribute('meta_description')]);
        Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $model->test->getAttribute('meta_title')]);
        Yii::$app->view->registerMetaTag(['name' => 'keys', 'content' => $model->test->getAttribute('meta_keys')]);

        switch ($model->questionType->getAttribute('slug')) {
            case 'sympleText':
                return $this->render('_sympletext', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity
                    ]);
                break;
            case 'sympleImage':
                return $this->render('_sympleimage', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity
                    ]);
                break;
            case 'textImage':
                return $this->render('_textimage', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity
                    ]);
                break;
            case 'skinColor':
                return $this->render('_skincolor', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity
                    ]);
                break;
            case 'aboutMeColour':
                return $this->render('_aboutmecolour', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity
                    ]);
                break;
            case 'aboutMeTwo':
                return $this->render('_aboutmetwo', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity
                    ]);
                break;
            case 'aboutMeOne':
                return $this->render('_aboutmeone', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity
                    ]);
                break;
            case 'coloring':
                return $this->render('_coloring', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity,
                    ]);
                break;
            case 'face':
                return $this->render('_face', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity,
                    ]);
                break;
            case 'hair':
                return $this->render('_hair', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity
                    ]);
                break;
            case 'eyes':
                return $this->render('_eyes', [ 
                        'model' => $model,
                        'currentQuestion' => $questionNumber,
                        'questionsQuantity'=>$questionsQuantity
                    ]);
                break;
            case 'user_foto':
                return $this->render('_user_foto', [
                    'model' => $model,
                    'currentQuestion' => $questionNumber,
                    'questionsQuantity'=>$questionsQuantity,
                ]);
                break;
            default:
                $model->delete();
                return $this->redirect(['index']);
                break;
        }
    }

     /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionResult($test)
    {        
        $session = Yii::$app->session;
        $tests = $session->get('tests');
        $current_test = $session->get('current_test');

        if($session->get('current_test')!=$test || !$current_test)
        {
            return $this->redirect(['test', 'number' => $session->get('passed_questions', 0)]);
        }
        
        $resultRender=[];
        
        foreach ($tests[$current_test]['tests'] as $testResult){
             $testModel=$this->findModel($testResult['test_id']);


            if($testModel->getAttribute('result_type_id')==1){
                $answewrs = $testResult['answewrs'];

                $result = 0;
                foreach ($answewrs as $answer) {
                    $result += $answer;
                }

                $query = new Query;
                $query->select('answer, query_values')->from('test_values')->where(['and', "`from`<=$result", "`to`>=$result"])->andWhere(['test_id' => $testResult['test_id']]);

                $resultQuery = $query->one();
                $resultRender[$testResult['test_id']]['result'] = $resultQuery;
                $resultRender[$testResult['test_id']]['title'] = $testModel->getAttribute('title');
            }
            else{

                $answewrs = $testResult['answewrs']; 

                $answewrsNumbersByid= $testResult['answewrsid'];

                $query = new Query;
                $query->select(' * ')->from('test_values_matrix')->where(['test_id' => $testResult['test_id']])->andWhere(['active_flag' => 1]);
                $result = $query->one();

                if(!$result){
                    return $this->redirect(['list-test']);
                }

                //get matrix
                $matrix = unserialize($result['serialize']);
                $testValueId=$matrix[$answewrs[$answewrsNumbersByid[$result['question_vertical_id']]]][$answewrs[$answewrsNumbersByid[$result['question_horizontal_id']]]];

                if(!$testValueId){
                    return $this->redirect(['list-test']);
                }

                $query = new Query;
                $query->select('answer, query_values')->from('test_values')->where(['id' => $testValueId]);
                $resultQuery = $query->one();

                $resultRender[$testResult['test_id']]['result'] = $resultQuery;
                $resultRender[$testResult['test_id']]['title'] = $testModel->getAttribute('title');
            }
        }
        
        return $this->render('result', [ 
                               'result' => $resultRender,
                        ]);
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
}

