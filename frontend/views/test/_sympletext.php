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
        <?php
        $cnt = count($model->answers);
        $styleClass = false; 
        $firsRow = ceil($cnt/2);
                       if($cnt): 
                            foreach ($model->answers as $key => $answer){
                                if(mb_strlen(trim($answer->getAttribute('description')))>45){
                                   $styleClass=true;
                                }
                           }
                    ?>
			<div class="columns is-mobile is-multiline content-center">
                        <?php foreach ($model->answers as $key => $answer): 
                                if(($key)%$firsRow == 0 && $key):
                        ?>
                            </div>
                            <div class="columns is-mobile is-multiline content-center">
                        <?php endif; ?>
                            <div class="column is-flex is-3">
                                <div class="box style<?= !$styleClass? "1": ""?>">
                                    <div class="is-block media-content is-text-centered">
                                        <?= $answer->getAttribute('description') ?>
                                    </div>
                                    <div class="is-block">
                                        <div class="is-text-centered pad-top hero-footer">
                                            <input type="radio" id="r<?= $key ?>" name="answer" value="<?= $answer->getAttribute('value') ?>">
                                            <label for="r<?= $key ?>"><span></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                          </div>
                    <?php else:?>
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
