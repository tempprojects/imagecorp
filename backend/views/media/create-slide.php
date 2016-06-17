<?php
/* @var $this yii\web\View */

$this->title = 'Создать слайдер';
$this->params['breadcrumbs'][] = ['label' => 'Слайдер', 'url' => ['/media/index-slide']];
$this->params['breadcrumbs'][] = $this->title;
$this->beginBlock('content-header');
echo $this->title;
$this->endBlock();
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title; ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <?= $this->render('_form-slide',['model' => $model, 'images' => $images, 'update' => false]); ?>
    </div>
</div>