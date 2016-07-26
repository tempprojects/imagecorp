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
   <div class="question-form">
        <?php $form = ActiveForm::begin(['action' => ['question/' . ($isNew?"save":"update") .'answers/*?id=' . $id],'options' => ['method' => 'post']]); ?>

        <?php 
            $cnt = 1;
            foreach($answers_models as $key => $value){
                 
                if($cnt==1){
                    echo '<div class="col-md-offset-4 col-md-4">';
                    echo $form->field($value, '[' . $key . ']title')->dropDownList([''=>'Default', 'colr-1'=>'Темный колорит','colr-2'=>'Холодный колорит', 'colr-3'=>'Теплый колорит' ,'colr-4'=>'Мягкий колорит'])->label("Color for frame");
                    echo "</div><br><br><br><br><br>";
                    echo '<div class="clearfix"></div>';
                }
               
                
                echo '<div class="col-md-4 col-md-offset-4">';
                    echo "Вариант # " . $cnt++; 
                    //For id of current record in db. In this case we lose the need to pass this parameter in get request!!!
                        echo (!$isNew)? $form->field($value, '[' . $key . ']id')->hiddenInput()->label(false):"";
                        echo $form->field($value, '[' . $key . ']question_id')->hiddenInput()->label(false);
                        echo $form->field($value, '[' . $key . ']value')->textInput([ 'required' => 'required']);
                        echo $form->field($value, '[' . $key . ']buttton_text')->textInput();
                       
                    echo "</div>";
                    echo '<div class="col-md-4">';
                        $img = is_object($value->mainImage)?$value->mainImage->getAttribute('src'): null;
                        echo Gallery::widget(['type' => 'tests', 'idInput' => 'answer-'.$key.'-main_image_id', 'img' => $img]);
                        echo $form->field($value, '[' . $key . ']main_image_id')->hiddenInput(['maxlength' => true])->label(false);
                    echo "</div>";
                    echo '<div class="clearfix"></div>';
            }
        ?>

        <div class='col-md-6'>
            <div class="form-group">
                <?= Html::submitButton( ($isNew?"Create":"Update"), ['class' => 'btn btn-success']) ?>
            </div>
         </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
