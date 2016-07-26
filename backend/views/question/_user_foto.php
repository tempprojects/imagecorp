<?php
use yii\helpers\Html;

echo Html::a('К вопросам' , ['question/test', 'id' => $_GET['id']] , ['class' => 'btn btn-success']);