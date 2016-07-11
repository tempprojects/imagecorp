<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Gallery;
use common\models\database\ResultType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\database\Test */
/* @var $form yii\widgets\ActiveForm */

$item = [
    1 => 'Женщина',
    2 => 'Мужчина',
    3 => 'Свадьба',
];

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

    <?= $form->field($model, 'result_type_id')->dropDownList(ArrayHelper::map(ResultType::find()->all(),'id','title'), ['prompt' => 'Выберите тип результата...']); ?>

    <div class="row">
        <?php
        if(!$update){
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

    <?php ActiveForm::end(); ?>

</div>
