<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\database\Gallery */
/* @var $form ActiveForm */

?>
<div>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'type')->dropDownList($type, ['prompt' => 'Выберите тип картинки...']); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($image, 'imageFile')->fileInput(); ?>
            </div>
        </div>
    </div>
    <?= $form->field($model, 'alt'); ?>
    <?= $form->field($model, 'title'); ?>
    <?= $form->field($model, 'data')->textarea(); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>