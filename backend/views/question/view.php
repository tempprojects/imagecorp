<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\database\Question */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['test', 'id' => $model->getAttribute('test_id')]];
$this->params['breadcrumbs'][] = $this->title;
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
<div class="question-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [   'attribute'=>'test_id',
                'format' => 'raw',
                'label' => 'Test',
                'value' =>  (is_object($model->test))?  $model->test->getAttribute('title') : ""
            ],
            [   'attribute'=>'question_type_id',
                'format' => 'raw',
                'label' => 'Question Type',
                'value' =>  (is_object($model->questionType))?  $model->questionType->getAttribute('description') : ""
            ],
            'title:ntext',
            'subtitle:ntext',
            'priority',
        ],
    ]) ?>

</div>
</div>