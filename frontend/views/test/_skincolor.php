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
    <?php $form = ActiveForm::begin(['action' => ['test/test/*?number=' . ($currentQuestion + 1)], 'options' => ['method' => 'post']]); ?>
    <section>
        <?php $cnt = count($model->answers);
        $cnt2 = 0; ?>
        <?php if ($cnt): ?>
        <div class="columns is-mobile is-multiline skin">
            <?php foreach ($model->answers as $key => $answer): ?>
            <?php if (($cnt - 2) >= ($key + 1)) : ?>
            <?php if (($key) % 8 == 0): ?>
        </div>
        <div class="columns is-mobile is-multiline skin">
            <?php endif; ?>
            <div class="column is-3-mobile is-flex">
                <div class="box">
                    <div class="is-block skin<?= '_' . $key; ?>">
                        <img
                            src="<?= $answer ? ($answer->mainImage ? $answer->mainImage->getAttribute("src") : "") : "" ?>"
                            alt="">
                    </div>
                    <div class="is-block">
                        <div class="is-text-centered pad-top">
                            <input type="radio" id="r<?= $key; ?>" name="answer"
                                   value="<?= $answer ? $answer->getAttribute('value') : '' ?>" name="style">
                            <label for="r<?= $key; ?>"><span></span></label>

                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <?php if (!$cnt2): ?>

    </section>
    <section class="section">
        <div class="is-text-centered pad-top columns is-mobile skins">
            <?php endif; ?>
            <div class="radio-block column is-text-<?= $cnt2 ? 'left' : 'right' ?>">
                <?= $answer->getAttribute('description') ?>
                <input type="radio" id="r_<?= $key ?>" name="skin1">
                <label for="r_<?= $key ?>"><span></span></label>
            </div>
            <?php $cnt2++;
            endif; ?>
            <?php endforeach; ?>
        </div>
    </section>
</div>
<?php else: ?>
    <input type="hidden" name="answer" value="0">
<?php endif; ?>

<section class="section is-text-centered">
    <button type="submit" class="button primary">Далее</button>
</section>
<?php ActiveForm::end(); ?>
</div>
<!-- /Main Content -->
<footer>
    <div class="container"></div>
</footer>
<!-- /End -->
