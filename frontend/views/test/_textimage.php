<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

echo Html::csrfMetaTags();
/* @var $this yii\web\View */
/* @var $model */
/* @var $currentQuestion */
/* $var $questionsQuantity */
?>
<?= $this->render('/_block/_header_payment'); ?>
<!-- Main Content -->
<div class="container">
    <section class="hero">
        <div class="hero-content">
            <h1 class="title"><?= $model->getAttribute('title') ?></h1>
            <div class="desc"><?= $model->getAttribute('subtitle') ?></div>
            <div class="breadcrumbs is-text-centered">
                <?php
                for ($i = 1; $i <= $questionsQuantity; $i++) {
                    echo "<a href='" . Url::toRoute(['test/test', 'number' => $i]) . "' class='button brd " . (($i <= $currentQuestion) ? "" : "is-disabled") . "'>" . $i . "</a>";
                }
                ?>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="columns is-mobile figure">
            <div class="column is-half is-offset-quarter">
                <div class="box">
                    <article class="media">
                        <div class="media-content is-text-centered is-unselectable">
                            <?= $model->answers ? $model->answers[0]->getAttribute('description') : "" ?>
                        </div>
                    </article>
                    <div class="is-block is-text-centered">
                        <img
                            src="<?= $model->answers ? ($model->answers[0]->mainImage ? $model->answers[0]->mainImage->getAttribute("src") : "") : "" ?>"
                            alt="">
                    </div>
            </section>
            <section class="section is-text-centered">
                <?php $form = ActiveForm::begin(['action' => ['test/test/*?number=' . ($currentQuestion+1)],'options' => ['method' => 'post', 'style'=>'display: inline-block']]); ?>
                <input type="hidden" name="answer" value="<?= $model->answers? $model->answers[0]->getAttribute('value'):"" ?>">
                <input type="hidden" name="answewrid" value="<?= $model->getAttribute('id')?>">
                <button type="submit" class="button primary1">Да</button>
                <?php ActiveForm::end(); ?>
                <?php $form = ActiveForm::begin(['action' => ['test/test/*?number=' . ($currentQuestion+1)],'options' => ['method' => 'post', 'style'=>'display: inline-block']]); ?>
                <input type="hidden" name="answer" value="0">
                <input type="hidden" name="answewrid" value="<?= $model->getAttribute('id')?>">
                <button type="submit" class="button primary1">Нет</button>
                <?php ActiveForm::end(); ?>
            </section>
	</div>
	<!-- /Main Content -->
	<footer>
		<div class="container"></div>
	</footer>
	<!-- /End -->
