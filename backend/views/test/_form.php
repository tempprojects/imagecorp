<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Gallery;

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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
