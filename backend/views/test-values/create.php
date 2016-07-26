<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\database\TestValues */
/* @var $matrixModel yii\base\DynamicModel */

$this->registerJsFile('js/createTestValues.js', ['depends' => 'backend\assets\AppAsset']);

$this->title = 'Test\'s values';
$this->params['breadcrumbs'][] = ['label' => 'All Tests', 'url' => ['test/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= 

        $this->render('_form', [
        'model' => $model,
        'matrixModel' => $matrixModel,
        'searchModelMatrix' => $searchModelMatrix,
        'dataProviderMatrix' =>$dataProviderMatrix
    ]) ?>

    </div>
</div>