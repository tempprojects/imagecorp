<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Слайдеры';
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
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Слайды</th>
                <th>Изменить</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($model as $value) {
                    echo '<tr>';
                    echo '<td>'.$value->id.'</td>';
                    echo '<td>';
                    foreach (unserialize($value->image_id) as $item) {
                        echo '<img class="preview" src="'.\common\models\database\Gallery::findOne(['id' => $item])->src.'" />';
                    }
                    echo '</td>';
                    echo '<td><a href="'.Url::toRoute(['/media/update-slide', 'id' => $value->id]).'" class="btn btn-xs btn-default">Редактировать</a></td>';
                    echo '</tr>';
                    echo '';
                    echo '';
                }
            ?>
            </tbody>
        </table>
    </div>
</div>