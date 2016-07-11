<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\database\Test;
use mihaildev\ckeditor\CKEditor;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\database\TestValues */
/* @var $form yii\widgets\ActiveForm */
/* @var $matrixModel yii\base\DynamicModel */

$formCnt = 0;
$result_type = Test::findOne($_GET['id'])->getAttribute('result_type_id');
?>

<div class="test-values-form">

    <?php $form = ActiveForm::begin(['enableClientValidation'=>false]); 
        foreach($model as $key => $mod):
        $formCnt++;
    ?>
    
    <div class="form_section" data-testvalue="<?= $mod->getAttribute('id') ?>">
        <div class="row">

            <?= Html::hiddenInput('TestValues[' . $key . ']test_id', $mod->getAttribute('test_id')); ?>
            <div>
               <?= $form->field($mod, '[' . $key . ']id')->hiddenInput()->label(false) ?>
            </div>
            <?php if($result_type==1):?>
            <div class="col-md-2 col-lg-1">
                <?= $form->field($mod, '[' . $key . ']from')->textInput([ 'required' => 'required', 'type'=>'number', 'step'=>'0.01']) ?>
            </div>    
            <div class="col-md-2 col-lg-1">
                <?= $form->field($mod, '[' . $key . ']to')->textInput([ 'required' => 'required', 'type'=>'number', 'step'=>'0.01']) ?>
            </div>
            <?php endif; ?>
            <div class="col-md-<?= $result_type==1?3:5?> col-lg-<?= $result_type==1?4:5?>">
                <?= $form->field($mod, '[' . $key . ']answer')->textInput([ 'required' => 'required']) ?>
            </div>
            <div class="col-md-<?= $result_type==1?3:5?> col-lg-<?= $result_type==1?5:6?>">
                <?= $form->field($mod, '[' . $key . ']query_values')->textarea(['rows' => 1, 'required' => 'required']) ?>
            </div>
            <div class="col-md-2 col-lg-1">
                <br>
                 <?=
                    Html::a(Yii::t('user', 'Delete'), ['test-values/delete', 'id' => $mod->id], [
                         'class' => 'btn btn-xs btn-danger btn-block delete_button'
                   ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-lg-2 col-md-offset-5 col-lg-offset-5">
                <a data-toggle="collapse" class="btn btn-xs btn-success btn-block" data-target="#collapse<?=$key?>">Page</a>
           </div>
        </div>
         <div id="collapse<?=$key?>" class="collapse">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                   <?= $form->field($mod, '[' . $key . ']page_title')->textInput() ?>
                </div>
             </div>
             <div class="row">
                <div class="col-md-12 col-lg-12">
                    <?= 
                        $form->field($mod, '[' . $key . ']page_description')->widget(CKEditor::className(),[
                            'editorOptions' => [
                                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                'inline' => false, //по умолчанию false
                            ],
                        ]); ?>
                </div>
             </div>
        </div>
    </div>
    <?php endforeach; ?>

    <br>
    <div class="row" id="new_section">
         <div class="col-md-2 col-md-offset-5">
            <a id="add_new" class="btn btn-xs btn-success btn-block">Add new Test result</a>
        </div>
    </div>
    <div class="form-group"><br>
        <?= Html::submitButton('Save' , ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <br>
    <br>
</div>

    <?php  
        // && !$model[0]->isNewRecord 
    ?>
     <?php if($result_type==2):?>
<h2>Матрицы</h2>
        <?php
            // if questions quantity more than 2
            if(count($model[0]->test->question)>1):
                Pjax::begin();
            
                echo  GridView::widget([
                    'dataProvider' => $dataProviderMatrix,
                    'filterModel' => $searchModelMatrix,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        [
                            'label' => 'Vertical Question',
                            'format' => 'raw',
                            'value' => function($data){
                                $result="";
                                if ($data->questionHorizontal){
                                    $result = $data->questionVertical->getAttribute('subtitle');
                                }
                                return $result;
                            },
                        ],
                        [
                            'label' => 'Horizontal Question',
                            'format' => 'raw',
                            'value' => function($data){
                                $result="";
                                if ($data->questionHorizontal){
                                    $result = $data->questionHorizontal->getAttribute('subtitle');
                                }
                                return $result;
                            },
                        ],
                        'question_vertical_id',
                        // 'serialize:ntext',
                        // 'active_flag',
                        [
                            'header' => 'Active',
                            'format' => 'raw',
                            'value' => function ($model) {
                                if (!$model->active_flag) {
                                    return Html::a('Active', ['blockmatrix', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-success btn-block',
                                        'data-method' => 'post',
                                        'data-confirm' => 'Are you sure you want to active this matrix?',
                                    ]);
                                } else {
                                    return "<div class='btn btn-xs btn-danger btn-block'>Inactive</div>";
                                }
                            },
                            'format' => 'raw',
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update}{delete}',
                            'contentOptions' =>['class' => 'table_buttons'],
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['deletematrix', 'id' => $model->id], ['title' => 'Delete', 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1', 'class'=>'modificator']);
                                },
//                                'usersportfolio' => function ($url, $model) {
//                                    return Html::a('<span class="glyphicon glyphicon-book"></span>', Yii::$app->getUrlManager()->getBaseUrl() . '/portfolio/usersportfolio/'. $model->getAttribute('id'), ['title' => Yii::t('app', 'Portfolios')]);
//                                },
//                               'usershonours' => function ($url, $model) {
//                                    return Html::a('<span class="glyphicon glyphicon-list"></span>', ['user-honours/usershonours', 'id' => $model->id], ['title' => Yii::t('app', 'Honours')]);
//                                },
//                                'usersvideos' => function ($url, $model) {
//                                    return Html::a('<span class="glyphicon glyphicon-play"></span>', ['user-videos/usersvideos', 'id' => $model->id], ['title' => Yii::t('app', 'Videos')]);
//                                },
                            ],
                        ],
                    ],
                ]); 
                Pjax::end();

                $formMatrix = ActiveForm::begin(['action' => ['test-values/creatematrix'],'options' => ['method' => 'post']]); 
                ?>
         <div class="row">
             <div class="col-md-3 col-lg-3">
                <?= $formMatrix->field($matrixModel, 'question_horizontal_id')->dropDownList($model[0]->questions, ['prompt' => 'Выберите вопрос...']); ?>
             </div>
             <div class="col-md-3 col-lg-3">
                 <?= $formMatrix->field($matrixModel, 'question_vertical_id')->dropDownList($model[0]->questions, ['prompt' => 'Выберите вопрос...']); ?>
             </div>
             <div class="col-md-3 col-lg-3">
                 <br>
                 <?= Html::submitButton('Add +' , ['class' => 'btn btn-success']) ?>
             </div>
         </div>
        <?php 
            ActiveForm::end();
            endif;
        ?>
    <?php endif; ?>
<script>
    var formCnt= <?= $formCnt ?>
</script>