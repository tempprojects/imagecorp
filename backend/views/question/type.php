<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model \yii\base\DynamicModel */
/* @var $all_types  */

$this->title = 'Тип вопроса';
?>
<div class="box box-success">
    <div class="box-body">
        <div class="question-form">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form">

                        <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'type')->dropDownList($all_types); ?>

                            <div class="form-group">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>

                    </div><!-- form -->
                 </div>
            </div>
        </div>
    </div>
</div>