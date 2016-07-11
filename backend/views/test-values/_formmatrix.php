<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $ownModel */
/* @var $questionH \common\models\database\Question; */
/* @var $questionV \common\models\database\Question;*/
/* @var $testValues */
?>
<style>
.verticalText {
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  transform: rotate(-90deg);
  filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=3);
}
</style>
  
<div class="table-responsive">
    <?php $form = ActiveForm::begin(['enableClientValidation'=>false]); ?>

    <?= Html::hiddenInput('TestValuesMatrix[question_vertical_id]',   $questionV->getAttribute('id')); ?>
    <?= Html::hiddenInput('TestValuesMatrix[question_horizontal_id]', $questionH->getAttribute('id')); ?>
    <?= Html::hiddenInput('TestValuesMatrix[test_id]', $questionV->getAttribute('test_id')); ?>

<table class="table">
    <tr>
        <th></th>
        <th style="text-align: center;" colspan="<?= count($ownModel["1.1"]) ?>" ><?= $questionH->getAttribute('subtitle')?></th>
    </tr>
    <tr>
        <th></th>
       <th></th>
        <?php
            foreach ($ownModel["1.1"] as $key => $value) {
                echo  "<th>{$key}</th>";
            }
        ?>
    </tr>

        <?php 
            $cnt= 0; 
            foreach ($ownModel as $key => $value) {

                if(!$cnt):?>
                <th class ="rotate" rowspan="<?= count($ownModel) + 1 ?>"><div class="verticalText"><?= $questionV->getAttribute('subtitle')?></div></th>
                <?php $cnt++;
                endif;

                echo "<tr><th>{$key}</th>";

                foreach ($value as $k => $v){
                    echo  "<td>".  Html::dropDownList('TestValuesMatrix[serialize][' .$key . '][' . $k . ']', $v, $testValues, ['class' => 'form-control']) . "</td>";
                }
                echo "</tr>";
            }
        ?>
</table>
    <?= Html::submitButton('Save' , ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
