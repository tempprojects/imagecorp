<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\database\Question */
/* @var $id */
/* @var $all_types */

$this->title = 'Create Question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
        echo  $this->render('_form', [
            'model' => $model,
            'id' => $id,
            'all_types'=> $all_types
        ]); 
   ?> 
</div>
