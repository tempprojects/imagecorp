<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\database\Question */
/* @var $id */
/* @var $all_types */
/* @var $answers_model */

$this->title = 'Update Question: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['test', 'id' => $model->getAttribute('test_id')]];
$this->params['breadcrumbs'][] = 'Update';
$this->beginBlock('content-header');
echo $this->title;
$this->endBlock();
?>
<div class="question-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="question-update">
                <?= $this->render('_form', [
                    'model' => $model,
                    'id' => $id,
                    'all_types' => $all_types,
                    'answers_model' => $answers_model,
                ]) ?>
            </div>
        </div>
