<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\database\Test */

$this->title = 'Update Test: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

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
            'img' => $img,
            'update' => true
        ]) ?>
    </div>
</div>