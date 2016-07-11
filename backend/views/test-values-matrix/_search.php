<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\TestValuesMatrixSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-values-matrix-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'test_id') ?>

    <?= $form->field($model, 'question_horizontal_id') ?>

    <?= $form->field($model, 'question_vertical_id') ?>

    <?= $form->field($model, 'test_values_id') ?>

    <?php // echo $form->field($model, 'serialize') ?>

    <?php // echo $form->field($model, 'active_flag') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
