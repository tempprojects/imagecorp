<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\database\Question */
/* @var $form yii\widgets\ActiveForm */
/* @var $id */
/* @var $all_types */
/* @var $answers_model */

?>
<div class="row">
    <div class="col-md-4 <?= $model->isNewRecord ? "col-md-offset-4" : ""?>">
        <div class="question-form"> 
            <?php $form = ActiveForm::begin(); ?>

            <?php 
                echo $form->field($model, 'test_id' 
                )->hiddenInput(['value'=> $id])->label(false);
            ?>

            <?= $model->isNewRecord ? $form->field($model, 'question_type_id')->dropDownList($all_types) : $form->field($model, 'question_type_id')->hiddenInput()->label(false); ?>

            <?= $model->isNewRecord ?  $form->field($model, 'answers_cnt')->dropDownList([2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10]) : $form->field($model, 'answers_cnt')->hiddenInput()->label(false); ?>

            <?= $form->field($model, 'title')->textarea(['rows' => 3]) ?>

            <?= $form->field($model, 'subtitle')->textarea(['rows' => 3]) ?>

            <?= $form->field($model, 'priority')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
        <?php if(!$model->isNewRecord): ?>
            <div class="col-md-8">
                <?php 
                    echo $this->render('allanswers', [
                        'answers_model' => $answers_model,
                        'id' => $model->getAttribute('id'),
                    ]); 
                ?>
            </div>
        <?php endif; ?>
</div>
