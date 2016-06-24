<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\database\Question */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['test', 'id' => $model->getAttribute('test_id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
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
