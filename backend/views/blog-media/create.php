<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\database\BlogMedia */

$this->title = 'Create Blog Media';
$this->params['breadcrumbs'][] = ['label' => 'Blog Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->beginBlock('content-header');
echo $this->title;
$this->endBlock();
?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
            'update' => false,
            'img' => $img,
            'typeCategory' => $typeCategory,
            'slider' => $slider
        ]) ?>
    </div>
</div>