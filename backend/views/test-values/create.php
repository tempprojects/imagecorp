<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\database\TestValues */
$this->registerJsFile('js/createTestValues.js', ['depends' => 'backend\assets\AppAsset']);

$this->title = 'Create Test Values';
$this->params['breadcrumbs'][] = ['label' => 'Test Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
