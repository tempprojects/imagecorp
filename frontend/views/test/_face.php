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
            <div class="desc"><?= $model->getAttribute('subtitle') ? $model->getAttribute('subtitle') : '' ?></div>
            <div class="breadcrumbs is-text-centered">
                <?php
                for ($i = 1; $i <= $questionsQuantity; $i++) {
                    echo "<a href='" . Url::toRoute(['test/test', 'number' => $i]) . "' class='button brd " . (($i <= $currentQuestion) ? "" : "is-disabled") . "'>" . $i . "</a>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php $form = ActiveForm::begin(['action' => ['test/test/*?number=' . ($currentQuestion + 1)], 'options' => ['method' => 'post', 'id' => 'foto_test']]); ?>
    <section class="section">
        <?php $cnt = count($model->answers);
        if ($cnt): ?>
            <div class="columns is-mobile face">
                <div class="column is-half">
                    <div class="cropper is-pulled-right">
                        <div id='image-cropper' class="image-editor">
                            <div
                                class="cropit-preview"><?php echo '<img class="cropit-preview-image" alt="" src="" style="">'; ?></div>
                            <div class="tools-box">
                                <span class="minus"></span>
                                <input type="range" class="cropit-image-zoom-input">
                                <span class="plus"></span>
                                <input type="file" name="file" class="cropit-image-input">
                                <label for="file" class="cam is-pulled-right">
                                    <img
                                        src="<?= (Yii::$app->controller->route == 'site/index') ?>/theme/img/ic/camera.png"
                                        alt="">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <?php foreach ($model->answers as $key => $answer):
                        if ($key && !($key % 2)) {
                            echo '</div> <div class="column">';
                        }
                        ?>

                        <div class="box is-block face_box">
                            <div
                                class="is-block is-text-centered"><?= $answer->mainImage ? '<img src="' . $answer->mainImage->getAttribute('src') . '" >' : "" ?>
                            </div>
                            <div class="is-block">
                                <div class="is-text-centered">
                                    <input type="radio" id="r<?= $key ?>" name="answer"
                                           value="<?= $answer->getAttribute('value') ?>">
                                    <label for="r<?= $key ?>"><span></span></label>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
                <?php
                $i = ceil(($key + 1) / 2);
                for ($i; $i < 4; $i++) {
                    echo '<div class="column empty"></div>';
                }
                ?>
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
<!-- /Main Content -->
<footer>
    <div class="container"></div>
</footer>
<!-- /End -->
