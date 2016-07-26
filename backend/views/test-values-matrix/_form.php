<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\database\TestValuesMatrix */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-values-matrix-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'test_id')->textInput() ?>

    <?= $form->field($model, 'question_horizontal_id')->textInput() ?>

    <?= $form->field($model, 'question_vertical_id')->textInput() ?>

    <?= $form->field($model, 'test_values_id')->textInput() ?>

    <?= $form->field($model, 'serialize')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active_flag')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
