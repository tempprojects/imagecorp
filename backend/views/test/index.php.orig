<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\database\Gallery;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Test */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tests';
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
        <p>
            <?= Html::a('Create Test', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                'alias',
                [
                    'attribute' => 'image',
                    'format' => 'html',
                    'value' => function ($data) {
                        return Html::img(Gallery::findOne(['id' => $data['img']])->src,
                            ['height' => '70px']);
                    },
                ],
                 'like',
                 'sort',
                [
                    'attribute' => 'type',
                    'format' => 'html',
                    'value' => function ($data) {
                        $type =[
                            1 => 'Женщина',
                            2 => 'Мужчина',
                            3 => 'Свадьба',
                        ];
                        return $type[$data->type];
                    },
                ],
//                 'type',
                [
                    'attribute' => 'updated_at',
                    'format' =>  ['date', 'dd.MM.Y'],
                    'options' => ['width' => '200']
                ],
                [
                    'header' => Yii::t('user', 'Количество вопросов'),
                    'value' => function ($model) {
                        //return  "<a href='" . $model->id . "'> " . count($model->question) . " вопросов</a>";
                        return Html::a('Количество вопросов: ' . count($model->question), ['question/test', 'id' => $model->id], ['title' => Yii::t('app', 'Количество вопросов')]);
                    },
                    'format' => 'raw',
                ],
//                 'updated_at',
                // 'created_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>