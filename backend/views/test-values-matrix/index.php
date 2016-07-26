<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TestValuesMatrixSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Values Matrices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-values-matrix-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test Values Matrix', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'test_id',
            'question_horizontal_id',
            'question_vertical_id',
            'test_values_id',
            // 'serialize:ntext',
            // 'active_flag',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
