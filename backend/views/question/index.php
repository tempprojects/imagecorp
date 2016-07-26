<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\database\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $id */

$this->title = 'Questions';
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
            <p>

                <?php if (isset($id) && $id) {
                    echo Html::a('Добавить вопрос к тесту №' . $id, ['question/create', 'id' => $id], ['class' => 'btn btn-success']);
                } ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'title:ntext',
                    ['attribute' => 'test_id',
                        'format' => 'raw',
                        'label' => 'Test',
                        'value' => function ($model) {
                            $result = '';
                            if (is_object($model->test)) {
                                $result = $model->test->getAttribute('title');
                            }
                            return $result;
                        }
                    ],
                    ['attribute' => 'question_type_id',
                        'format' => 'raw',
                        'label' => 'Question Type',
                        'value' => function ($model) {
                            $result = '';
                            if (is_object($model->questionType)) {
                                $result = $model->questionType->getAttribute('description');
                            }
                            return $result;
                        }
                    ],
                    //'subtitle:ntext',
                    'priority',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
