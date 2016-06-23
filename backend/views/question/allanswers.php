<?php 
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $answers_model */
?>

<div class = "row">
    <div class="col-sm-6">
        <?php 
            echo Html::a('Добавить ответ к вопросу #' . $id , ['question/addanswer', 'id' => $id] , ['class' => 'btn btn-success']);
        ?>
    </div>
    <div class="col-sm-6">
        <?php 
            echo Html::a('Редактировать ответи' . $id , ['question/updateanswers', 'id' => $id] , ['class' => 'btn btn-success']);
        ?>
    </div>
</div>

<?= 
    GridView::widget([
        'dataProvider' => $answers_model,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'description',
            'value',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'contentOptions' =>['class' => 'table_buttons'],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Yii::$app->getUrlManager()->getBaseUrl() . '/question/deleteanswer/*?id='. $model->getAttribute('id') , ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1', 'class'=>'modificator']);
                    },
                ],
            ],
        ],
    ]);
?>