<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\database\TestValues */
/* @var $form yii\widgets\ActiveForm */
$formCnt = 0;
?>

<div class="test-values-form">

    <?php $form = ActiveForm::begin(['enableClientValidation'=>false]); 
        foreach($model as $key => $mod):
        $formCnt++;
    ?>
    
    <div class="form_section" data-testvalue="<?= $mod->getAttribute('id') ?>">
        <div class="row">
         

            <?= Html::hiddenInput('TestValues[' . $key . ']test_id', $mod->getAttribute('test_id')); ?>
            <div>
               <?= $form->field($mod, '[' . $key . ']id')->hiddenInput()->label(false) ?>
            </div>    
            <div class="col-md-2 col-lg-1">
                <?= $form->field($mod, '[' . $key . ']from')->textInput([ 'required' => 'required', 'type'=>'number', 'step'=>'0.01']) ?>
            </div>    
            <div class="col-md-2 col-lg-1">
                <?= $form->field($mod, '[' . $key . ']to')->textInput([ 'required' => 'required', 'type'=>'number', 'step'=>'0.01']) ?>
            </div> 
            <div class="col-md-3 col-lg-4">
                <?= $form->field($mod, '[' . $key . ']answer')->textInput([ 'required' => 'required']) ?>
            </div>
            <div class="col-md-3 col-lg-5">
                <?= $form->field($mod, '[' . $key . ']query_values')->textarea(['rows' => 1, 'required' => 'required']) ?>
            </div>
            
            <div class="col-md-2 col-lg-1">
                <br>
                <?=
                    Html::a(Yii::t('user', 'Delete'), ['test-values/delete', 'id' => $mod->id], [
                         'class' => 'btn btn-xs btn-danger btn-block delete_button'
                   ]);
                ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="row" id="new_section">
         <div class="col-md-2 col-md-offset-5">
            <a id="add_new" class="btn btn-xs btn-success btn-block">Add new Test result</a>
        </div>
    </div>
    <div class="form-group"><br>
        <?= Html::submitButton('Save' , ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    var formCnt= <?= $formCnt ?>
</script>