<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\database\Slider */
/* @var $form ActiveForm */
$data = [];
if($update){
    foreach (unserialize($model->image_id) as $item) {
        $data[] = (int)$item;
    }
}
$format = <<< SCRIPT
function format(state) {
    if (!state.id) return state.text;
    var stateId = $('<span><img src="' + state.text + '" class="previewSlide" /> ' + state.id + '</span>');
    return stateId;
}
SCRIPT;
$escape = new JsExpression("function(m) { return m; }");
$this->registerJs($format, View::POS_HEAD);
?>
<div>

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo Select2::widget([
            'name' => 'Slider[image_id]',
            'data' => $images,
            'value' => $data,
            'language' => 'ru',
            'options' => ['multiple' => true, 'placeholder' => 'Выберите картинку ...'],

            'pluginOptions' => [
                'templateResult' => new JsExpression('format'),
                'templateSelection' => new JsExpression('format'),
                'escapeMarkup' => $escape,
                'allowClear' => true
            ],
        ]);
    ?>
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
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>