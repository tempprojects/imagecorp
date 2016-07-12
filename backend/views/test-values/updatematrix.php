<?php

use yii\helpers\Html;

/* @var $ownModel */
/* @var $questionH \common\models\database\Question; */
/* @var $questionV \common\models\database\Question;*/
/* @var $testValues */
?>
<?php 
    $this->title = 'Create matrix';
    $this->params['breadcrumbs'][] = ['label' => 'All Tests', 'url' => ['test/index']];
    $this->params['breadcrumbs'][] = ['label' => 'Test\'s values', 'url' => ['test-values/create', 'id'=>$questionH->getAttribute('test_id')]];
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

    <?= $this->render('_formmatrix', [
        'ownModel' => $ownModel,
        'questionH' =>$questionH,
        'questionV' =>$questionV,
        'testValues' =>$testValues,
    ]) ?>

    </div>
</div>