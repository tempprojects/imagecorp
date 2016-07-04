<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $resulrt array*/
?>

<?= $this->render('/_block/_header_payment'); ?>


<h2>
    Результат: <?= $result['answer'] ?>
</h2>
<h2>
   Запрос: <?= $result['query_values'] ?>
</h2>