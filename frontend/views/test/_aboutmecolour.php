<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?= $this->render('/_block/_header_payment'); ?>

<!-- Main Content -->
<div class="container">
    <section class="hero">
        <div class="hero-content">
            <h1 class="title"><?= $model->getAttribute('title') ?></h1>
            <div class="desc"><?= $model->getAttribute('subtitle')?$model->getAttribute('subtitle'):'' ?></div>
            <div class="breadcrumbs is-text-centered">
                <?php
                for ($i = 1; $i <= $questionsQuantity; $i++) {
                    echo "<a href='" . Url::toRoute(['test/test', 'number' => $i]) . "' class='button brd " . (($i <= $currentQuestion) ? "" : "is-disabled") . "'>" . $i . "</a>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php $form = ActiveForm::begin(['action' => ['test/test/*?number=' . ($currentQuestion + 1)], 'options' => ['method' => 'post', 'style' => 'display: inline-block']]); ?>
    <section>
        <?php $cnt = count($model->answers);
        if ($cnt): ?>
        <div class="columns">
            <?php foreach ($model->answers as $key => $answer):
                //print_r($answer);?>
            <div class="column is-6 is-flex">
                <div class="box">

                    <article class="media media-flex">
                        <div class="is-block is-text-centered">
                            <img src="<?= $answer ? ($answer->mainImage ? $answer->mainImage->getAttribute("src") : "") : "" ?>"
                                 alt="">
                        </div>
                        <div class="media-content is-unselectable pad">
                            <?=$answer ? $answer->getAttribute('description') : '' ?>
                        </div>
                    </article>
                    <div class="columns is-mobile media-flex">

                        <div class="column is-2 color1"></div>
                        <div class="column is-2 color2"></div>
                        <div class="column is-2 color3"></div>
                        <div class="column is-2 color4"></div>
                        <div class="column is-2 color5"></div>
                        <div class="column is-2 color6"></div>

                    </div>
                    <div class="is-block">
                        <div class="uppercase is-text-centered text_0"><?=$answer ? $answer->getAttribute('buttton_text') : '' ?>
                            <input type="radio" id="r<?= $key; ?>" name="answer"
                                   value="<?= $answer ? $answer->getAttribute('value') : '' ?>" name="style">
                            <label for="r<?= $key; ?>"><span></span></label>
                        </div>
                    </div>
                </div>
            </div>
     <?php endforeach;?>
        </div>
            <?php else: ?>
            <input type="hidden" name="answer" value="0">
        <?php endif; ?>
    </section>
    <section class="section is-text-centered">
        <button type="submit" class="button primary">Далее</button>
    </section>
    <?php ActiveForm::end(); ?>
</div>
