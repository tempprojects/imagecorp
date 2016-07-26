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

            <?php $form = ActiveForm::begin(['action' => ['test/test/*?number=' . ($currentQuestion + 1)], 'options' => ['method' => 'post']]); ?>
            <section class="section">
                    <?php 
                        $answers = $model->answers; 
                        $cnt = count($answers);
                        $firstSectionCnt = floor($cnt/4);
                    ?>
			<div class="columns is-mobile is-multiline">
                            <?php for($i=0; $i<$firstSectionCnt; $i++):?>
				<div class="column is-flex eye" id="h<?= ($i+1) ?>">
                                    <div class="box">
                                        <div class="is-block"><img src="<?= isset($answers[$i]) ? ($answers[$i]->mainImage ? $answers[$i]->mainImage->getAttribute("src") : "") : "" ?>" alt="">
                                        </div>
                                        <div class="is-block">
                                            <div class="is-text-centered">
                                                <input type="radio" id="r<?= ($i+1) ?>" name="hair1">
                                                <label for="r<?= ($i+1) ?>"><span></span></label>
                                            </div>
                                        </div>
                                    </div>
				</div>
                            <?php endfor; ?>
			</div>
                        <?php for($i=1; $i<=$firstSectionCnt; $i++):?>
                            <div class="columns eye eye<?=$i ?>-1 is-mobile" id="eye<?= $i ?>-1">
                                <?php $secondForCnt = 1; 
                                      $outputSectionsCnt = 0; ?>
                                <?php for($j=($i-1)*2 + $firstSectionCnt; $j<(($i-1)*2 + 2*$firstSectionCnt); $j++): ?>

                                    <?php if($secondForCnt<$i && ($secondForCnt+3)<=$firstSectionCnt): ?>
                                         <div class="column empty"></div>
                                    <?php elseif($outputSectionsCnt==3):?>
                                         <div class="column empty"></div>
                                    <?php else:?>
                                    <?php $outputSectionsCnt++?>
                                         <?php 
                                            $localIteration= (($firstSectionCnt-$i)<3)?($j+3-$firstSectionCnt+$i-1):$j;
                                         ?>
                                        <div class="column is-flex">
                                            <div class="box">
                                                <div class="is-block"><img src="<?= isset($answers[$localIteration]) ? ($answers[$localIteration]->mainImage ? $answers[$localIteration]->mainImage->getAttribute("src") : "") : "" ?>" alt="">
                                                </div>
                                                <div class="is-block">
                                                    <div class="is-text-centered pad-top">
                                                        <input type="radio" id="r<?= $localIteration+1 ?>" value="<?= $answers[$localIteration]->getAttribute('value')?>" name="answer">
                                                        <label for="r<?= $localIteration+1 ?>"><span></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     <?php endif;  ?>
                                     <?php $secondForCnt++ ?>
                                <?php endfor; ?>
                            </div>
                        <?php endfor; ?>
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