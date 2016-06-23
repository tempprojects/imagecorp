<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Gallery;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\database\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Gallery::widget(['type' => 'images', 'idInput' => 'content-img', 'img' => $img]); ?>
    <?= $form->field($model, 'img')->hiddenInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            'toolbar1' => 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            'toolbar2' => 'print preview media | forecolor backcolor emoticons',
            'image_advtab' => true,
            'templates' => [
                [ 'title' => 'Test template 1', 'content' => 'Test 1' ],
                [ 'title' => 'Test template 2', 'content' => 'Test 2' ],
            ],
            'protect' => [
                '/<\?php.*?\?>/g'
            ]
            //'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]); ?>

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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
