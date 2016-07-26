<?php 
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $answers_model */
?>

<?php 
    $local_answers_model = clone $answers_model;
    $local_answers_query = $local_answers_model->getModels();
?>

<div class = "row">
    <div class="col-sm-6">
        
        <?php
        $question_type_id = count($local_answers_query)? $local_answers_query[0]->question->getAttribute('question_type_id'):0; 
        ?>
       
        <?php if($question_type_id != 12){
            if($question_type_id==5 || $question_type_id==8 || $question_type_id==9 || $question_type_id==3){
                if(count($local_answers_query)<2 && ($question_type_id==5 || $question_type_id==8 || $question_type_id==9))
                {
                      echo Html::a('Добавить ответ к вопросу №' . $id , ['question/addanswer', 'id' => $id] , ['class' => 'btn btn-success']);
                }
            }
            
            else {

                echo Html::a('Добавить ответ к вопросу №' . $id, ['question/addanswer', 'id' => $id], ['class' => 'btn btn-success']);
            }

            }
        ?>
    </div>
    <div class="col-sm-6">
        <?php 
            echo ($local_answers_query) ? Html::a('Редактировать ответы ' . $id , ['question/updateanswers', 'id' => $id] , ['class' => 'btn btn-success']) : " ";
        ?>
    </div>
</div>

<?= 
    GridView::widget([
        'dataProvider' => $answers_model,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'description',
            'value',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'contentOptions' =>['class' => 'table_buttons'],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Yii::$app->getUrlManager()->getBaseUrl() . '/question/deleteanswer/*?id='. $model->getAttribute('id') , ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1', 'class'=>'modificator']);
                    },
                ],
            ],
        ],
    ]);
?>