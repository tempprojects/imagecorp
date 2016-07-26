<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $answers_models */
/* @var $id */
/* @var $template */

$this->title = 'Update Answers';

$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['test', 'id' => $id]];
$this->params['breadcrumbs'][] = 'Update Answers';
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

<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php

        echo  $this->render($template, [
            'answers_models' => $answers_models,
            'id' => $id,
            'isNew'=>false,
        ]); 
   ?> 
</div>
        </div>
