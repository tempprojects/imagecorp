<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\database\BlogCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'category_alias')->textInput() ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'sort')->textInput() ?>
            </div>
        </div>
    </div>

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
