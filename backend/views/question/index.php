<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\database\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $id */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
        <?php if(isset($id) && $id){
            echo Html::a('Добавить вопрос к тесту №' . $id , ['question/create', 'id' => $id] , ['class' => 'btn btn-success']);
        }?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title:ntext',
            [   'attribute'=>'test_id',
                'format' => 'raw',
                'label' => 'Test',
                'value' => function($model) {
                    $result='';
                    if(is_object($model->test)){
                        $result = $model->test->getAttribute('title');
                    }
                    return $result;
                }
            ],
            [   'attribute'=>'question_type_id',
                'format' => 'raw',
                'label' => 'Question Type',
                'value' => function($model) {
                    $result='';
                    if(is_object($model->questionType)){
                        $result = $model->questionType->getAttribute('description');
                    }
                    return $result;
                }
            ],
            //'subtitle:ntext',
            'priority',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
