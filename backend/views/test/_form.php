<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Gallery;
use common\models\database\ResultType;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model common\models\database\Test */
/* @var $form yii\widgets\ActiveForm */

$item = [
    1 => 'Женщина',
    2 => 'Мужчина',
    3 => 'Свадьба',
];

    $resultType= ArrayHelper::map(ResultType::find()->all(), 'id', 'title');
    if(!$model->isNewRecord){
        if($model->testReferences0){
            if(isset($resultType[3])){
               unset($resultType[3]);
            }
        }
    }
?>

<div class="test-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Gallery::widget(['type' => 'tests', 'idInput' => 'test-img', 'img' => $img]); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'price')->textInput(); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'sort')->textInput(); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'type')->dropDownList($item, ['prompt' => 'Выберите тип теста...']); ?>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'img')->hiddenInput(['maxlength' => true])->label(false); ?>

    <div class="row">
        <?php
        if (!$update) {
            ?>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'created_at')->widget(\yii\jui\DatePicker::classname(), ['language' => 'en-GB', 'dateFormat' => 'dd-MM-yyyy']); ?>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'updated_at')->widget(\yii\jui\DatePicker::classname(), ['language' => 'en-GB', 'dateFormat' => 'dd-MM-yyyy']); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'result_type_id')->dropDownList($resultType, ['prompt' => 'Выберите тип результата...']); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'like')->textInput(); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-offset-5">
            <h2>SEO</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'meta_description')->textInput(); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'meta_title')->textInput(); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'meta_keys')->textInput(); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <script>

    </script>
    
    
    <?php ActiveForm::end(); ?>
    <br><br><br>
    <?php if(!$model->isNewRecord && $model->getAttribute('result_type_id')==3): ?>

      <div class="row">
          <div class="col-md-4">
        <?php
        Pjax::begin();
        echo GridView::widget([
        'dataProvider' => $dataProviderReference,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
             [
                'header' => 'Дочерний тест',
                'value' => function ($model) {
                    $type =[
                        1 => 'Женщина',
                        2 => 'Мужчина',
                        3 => 'Свадьба',
                    ];
                        return $model->testChild->getAttribute('title') . ' (' . $type[$model->testChild->getAttribute('type')] . ')';
                },
                'format' => 'raw',
            ],
            'position',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'contentOptions' =>['class' => 'table_buttons'],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['deletechildtest', 'id' => $model->id], ['title' => 'Delete', 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1', 'class'=>'modificator']);
                    },
                ],
            ],
        ],
    ]); 
    Pjax::end();
?>
          </div>
            <div class="col-md-8">
            <?php $formMatrix = ActiveForm::begin(['action' => ['test/addreftest'],'options' => ['method' => 'post']]);  ?>
             <?= $formMatrix->field($referenceModel, 'test_parrent_id')->hiddenInput()->label(false);?>
              <div class="row">
                <div class="col-md-6">
                      <br>
                    <?= $formMatrix->field($referenceModel, 'test_child_id')->dropDownList($referenceModel->avilabletests, ['prompt' => 'Выберите тест...'])->label('Дочерний тест'); ?>
                </div>
                <div class="col-md-3">
                     <br>
                    <?= $formMatrix->field($referenceModel, 'position')->textInput(); ?>
                </div>
                <div class="col-md-2">
                    <br> <br>
                    <?= Html::submitButton('Add +' , ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php 
                ActiveForm::end();
            ?>
          </div>
      </div>
    <?php endif; ?>
</div>