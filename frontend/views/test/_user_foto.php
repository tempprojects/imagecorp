<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\Session;
use yii\helpers\Html;
//$session = Yii::$app->session;
//if (!$session->isActive){
//    $session->open();
//}
echo Html::csrfMetaTags()
?>
<?= $this->render('/_block/_header_payment'); ?>
<!-- Main Content -->
<div class="container">
    <?php $form = ActiveForm::begin(['action' => ['test/test/*?number=' . ($currentQuestion+1)],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data','id'=>'foto_test']]); ?>
    <section class="hero">
        <div class="hero-content">
            <h1 class="title"><?= $model->getAttribute('title')?></h1>
            <div class="desc"><?= $model->getAttribute('subtitle')?></div>
            <div class="breadcrumbs is-text-centered">
                <?php
                for($i=1; $i<=$questionsQuantity; $i++){
                    echo "<a href='" . Url::toRoute(['test/test', 'number' => $i]) . "' class='button brd " . (($i<=$currentQuestion)?"":"is-disabled") . "'>" . $i . "</a>";
                }
                ?>
            </div>
        </div>
    </section>
    <section>
        <div class="columns">
            <div class="column is-half is-offset-quarter">
                <div class="cropper">
                    <div id='image-cropper' class="image-editor abc123123">
                        <div class="cropit-preview"><?php  echo '<img class="cropit-preview-image" alt="" src="'.$photo.'" style="">'; ?></div>
                        <!-- <div class="image-size-label">
                        </div> -->
                        <div class="tools-box">
                            <span class="minus"></span>
                            <input type="range" class="cropit-image-zoom-input">
                            <span class="plus"></span>

                            <input type="file" name="file" class="cropit-image-input" value="">
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

                            <label for="file" class="cam is-pulled-right">
                                <img src="<?= (Yii::$app->controller->route == 'site/index')?>/theme/img/ic/camera.png" alt="">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section is-text-centered">
        <a  class="subm" href="#">Далее</a>
        <button type="submit" class="button primary submit_image">Далее</button>
    </section>
    <?php ActiveForm::end(); ?>
</div>
<!-- /Main Content -->
<footer>
    <div class="container"></div>
</footer>
<?php

$this->registerJs("
//var csrfToken = $('meta[name=\"csrf-token\"]').attr(\"content\");
//$('#foto_test').submit(function(e) {
//    e.preventDefault();
//    var imageData = $('#image-cropper').cropit('export');
//    //console.log(imageData);
//    $.ajax({
//        data : {_csrf : csrfToken, image: imageData},
//        url: '/test/test/*?number=1',
//        type: 'post',
//    }).done(function() {
//    $(this).submit();
//    });
//});");

?>