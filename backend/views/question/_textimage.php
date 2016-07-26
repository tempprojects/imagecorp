<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Gallery;

/* @var $this yii\web\View */
/* @var $answers_models */
/* @var $id */
/* $var $isNew*/

?>
<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
<div class="question-form">
    
    <?php $form = ActiveForm::begin(['action' => ['question/' . ($isNew?"save":"update") .'answers/*?id=' . $id],'options' => ['method' => 'post']]); ?>

    <?php 
        $cnt = 1;
        foreach($answers_models as $key => $value){
            echo "Вариант № " . $cnt++;
            //For id of current record in db. In this case we lose the need to pass this parameter in get request!!!
            echo (!$isNew)? $form->field($value, '[' . $key . ']id')->hiddenInput()->label(false):"";
            
            echo $form->field($value, '[' . $key . ']question_id')->hiddenInput()->label(false);
            
            echo $form->field($value, '[' . $key . ']value')->textInput([ 'required' => 'required'])->label('Value(yes)');

            echo $form->field($value, '[' . $key . ']description')->textarea(['rows'=>3, 'required' => 'required']);

            $img = is_object($value->mainImage)?$value->mainImage->getAttribute('src'): null;
            echo Gallery::widget(['type' => 'tests', 'idInput' => 'answer-'.$key.'-main_image_id', 'img' => $img]);

            echo $form->field($value, '[' . $key . ']main_image_id')->hiddenInput(['maxlength' => true])->label(false);

            echo "<hr>";
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton( ($isNew?"Create":"Update"), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
