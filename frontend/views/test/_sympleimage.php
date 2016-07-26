<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

echo Html::csrfMetaTags();
?>

<?= $this->render('/_block/_header_payment'); ?>

<!-- Main Content -->
<div class="container">
    <section class="hero">
        <div class="hero-content">
            <h1 class="title"><?= $model->getAttribute('title') ?></h1>
            <!-- <div class="desc">Ваш идеальный день?</div> -->
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
        if($cnt): 
            $firsRow = ceil($cnt/2);?>
            <div class="columns is-mobile is-multiline content-center">
            <?php foreach ($model->answers as $key => $answer):
                if (($key) % $firsRow == 0): ?>
                    </div>
                    <div class="columns is-mobile is-multiline content-center">
                <?php endif; ?>
                <div class="column is-flex is-3">
                    <div class="box style3">
                        <div class="is-block media-content is-text-centered">
                            <img
                                src="<?= $answer ? ($answer->mainImage ? $answer->mainImage->getAttribute("src") : "") : "" ?>"
                                alt="">
                        </div>
                        <div class="is-block">
                            <div class="is-text-centered pad-top hero-footer">
                                <input type="radio" id="r<?= $key; ?>" name="answer"
                                       value="<?= $answer ? $answer->getAttribute('value') : '' ?>" name="style">
                                <label for="r<?= $key; ?>"><span></span></label>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
            </div>
        <?php else: ?>
            <input type="hidden" name="answer" value="0">
        <?php endif; ?>
    </section>
    <input type="hidden" name="answewrid" value="<?= $model->getAttribute('id')?>">
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