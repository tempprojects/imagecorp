<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\database\TestValuesMatrix */

$this->title = 'Create Test Values Matrix';
$this->params['breadcrumbs'][] = ['label' => 'Test Values Matrices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-values-matrix-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
