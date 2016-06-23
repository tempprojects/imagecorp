<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\database\Discount */
/* @var $form yii\widgets\ActiveForm */

$status = [
    1 => 'Активна',
    2 => 'Отключено',
];

?>
<div class="discount-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'id_test')->dropDownList($test, ['prompt' => 'Выберите тест...']); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'status')->dropDownList($status, ['prompt' => 'Выберите статус скидки...']); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'amount')->textInput(); ?>
            </div>
        </div>
    </div>
    <hr>
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