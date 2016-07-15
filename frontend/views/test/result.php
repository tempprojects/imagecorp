<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $resulrt array*/
?>

<?= $this->render('/_block/_header_payment'); ?>


<?php 

foreach ($result as $res): ?>
<h2>
    Тест: <?= $res['title'] ?>
</h2>
<h2>
    Результат: <?= $res['result']['answer'] ?>
</h2>
<h2>
   Запрос: <?= $res['result']['query_values'] ?>
</h2>
<br><br><br>
<?php endforeach;?>