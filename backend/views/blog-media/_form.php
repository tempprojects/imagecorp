<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use common\widgets\Gallery;

/* @var $this yii\web\View */
/* @var $model common\models\database\BlogMedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-media-form">

    <?php $form = ActiveForm::begin(); ?>

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

    <?= $form->field($model, 'type_media')->dropDownList($typeCategory, ['prompt' => 'Выберите тип медиа...']); ?>


    <?php
    echo Tabs::widget([
            'items' => [
                [
                    'label' => $typeCategory[0],
                    'content' => '<br>'.Gallery::widget(['type' => 'blog', 'idInput' => 'blogmedia-img', 'img' => $img]),
                    'active' => true
                ],
                [
                    'label' => $typeCategory[1],
                    'content' => $form->field($model, 'slider')->dropDownList($slider, ['prompt' => 'Выберите тип медиа...']),
                ],
                [
                    'label' => $typeCategory[2],
                    'content' => $form->field($model, 'video')->textarea(['rows' => 6]),
                ],
            ],
        ]);
    ?>

    <?= $form->field($model, 'img')->hiddenInput(['maxlength' => true])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
