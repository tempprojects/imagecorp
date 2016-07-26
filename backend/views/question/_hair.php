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
        <?php $form = ActiveForm::begin(['action' => ['question/' . ($isNew?"save":"update") .'answers/*?id=' . $id],'options' => ['method' => 'post']]); ?>

        <?php 
            $cnt = 1;
            $switchTree=false;
            $cntRow=1;
            $cntThree=1;
            
            $offsetDown=0;
            $cntAnswers=count($answers_models);

            foreach($answers_models as $key => $value){
                if($switchTree){
                    echo '<div class="clearfix"></div>';
                    $switchTree=false;
                }


                if(($cntAnswers/4)>=($cnt))
                {
                    $childcnt = 1;
                    $parentcnt = 1;
                    echo "<div class='col-md-1'>";
                    echo "Вариант № " . $cnt++;
                    //For id of current record in db. In this case we lose the need to pass this parameter in get request!!!
                    echo (!$isNew)? $form->field($value, '[' . $key . ']id')->hiddenInput()->label(false):"";
                    echo $form->field($value, '[' . $key . ']question_id')->hiddenInput()->label(false);
                    echo $form->field($value, '[' . $key . ']value')->hiddenInput([ 'value'=>$cnt-1])->label(false);

                    $img = is_object($value->mainImage)?$value->mainImage->getAttribute('src'): null;
                    echo Gallery::widget(['type' => 'tests', 'idInput' => 'answer-'.$key.'-main_image_id', 'img' => $img]);
                    echo $form->field($value, '[' . $key . ']main_image_id')->hiddenInput(['maxlength' => true])->label(false);

                    echo "</div>";
                    if(($cntAnswers/4)<($cnt)){
                        $offsetDown++;
                        $switchTree=true;
                    }
                }
                else{
                    if($cntThree==1){
                        if(($offsetDown+3)>($cntAnswers/4)){
                            $offsetDownCorection =($cntAnswers/4)-2;
                        }
                        else{
                             $offsetDownCorection= $offsetDown;
                        }
                        for($i=$offsetDownCorection; $i>1; $i--){

                            echo "<div class='col-md-1'></div>";
                        }
                    }

                    if($cntThree<4){

                        $cntThree++;
                        echo "<div class='col-md-1'>";
                        echo "Вариант № ".$parentcnt.'.' . $childcnt++;
                        //For id of current record in db. In this case we lose the need to pass this parameter in get request!!!
                        echo (!$isNew)? $form->field($value, '[' . $key . ']id')->hiddenInput()->label(false):"";
                        echo $form->field($value, '[' . $key . ']question_id')->hiddenInput()->label(false);
                        echo $form->field($value, '[' . $key . ']value', [ 'options' => [ 'style' => 'display: none']])->textInput(['type' => 'number', 'value'=> $parentcnt.'.' . ($childcnt-1)])->label(false);
                        $img = is_object($value->mainImage)?$value->mainImage->getAttribute('src'): null;
                        echo Gallery::widget(['type' => 'tests', 'idInput' => 'answer-'.$key.'-main_image_id', 'img' => $img]);
                        echo $form->field($value, '[' . $key . ']main_image_id')->hiddenInput(['maxlength' => true])->label(false);

                        echo "</div>";
                    }

                    if($cntThree>3){
                        $parentcnt++;
                        $childcnt = 1;
                        $switchTree=true;
                        $offsetDown++;
                        $cntThree=1;
                    }
                }
            }
        ?>
    <div class="clearfix"></div>
    <div class='col-md-3'>
        <div class="form-group">
            <?= Html::submitButton( ($isNew?"Create":"Update"), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
        <?php ActiveForm::end(); ?>
</div>
<style>
    .btn-warning{
        font-size: 11px;
        padding-left: 6px;
    }
</style>
