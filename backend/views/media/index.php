<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Картинки';

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
        <?php
        foreach ($type as $key => $item) {
            echo '<a href="' . Url::toRoute(['/media/index', 'type' => $key]) . '" class="btn btn-default typeGallery">'.$item.'</a>';
        }
        ?>

        <hr>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Картинка</th>
                <th>Тип</th>
                <th>Путь</th>
                <th>Изменить</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($model as $value) {
                echo '<tr>';
                echo '<td>'.$value->id.'</td>';
                echo '<td>'.$value->data.'</td>';
                echo '<td><img class="preview" src="'.$value->src.'" /></td>';
                echo '<td>'.$type[$value->type].'</td>';
                echo '<td>'.$value->src.'</td>';
                echo '<td><a href="'.Url::toRoute(['/media/gallery-load', 'id' => $value->id]).'" class="btn btn-xs btn-default">Редактировать</a></td>';
                echo '</tr>';
                echo '';
                echo '';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>