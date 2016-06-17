<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\database\BlogMedia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Blog Media', 'url' => ['index']];
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
                'type_media',
                'img',
                'slider',
                'video:ntext',
                'updated_at',
                'created_at',
            ],
        ]) ?>
    </div>
</div>