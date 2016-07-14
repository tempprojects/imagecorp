<?php

use yii\helpers\Url;
use common\models\database\Discount;
use common\models\database\Gallery;
use common\models\database\Slider;

/* @var $this yii\web\View */

$this->title = 'Корпорация Имиджа - онлайн-сервис по подбору имиджа';
?>

<?= $this->render('/_block/_header'); ?>
<?= $this->render('/_block/_slider'); ?>

<section class="test-list">
    <div class="container-main">
        <h2 class="section-title">Тесты</h2>
        <ul class="list-of-tests">
            <?php
                $i = 0;
                foreach ($model as $item) {
                    echo '<li>';
                    echo '<div class="test-img list-item list-item-'.$i.'" style="background-image: url('.Gallery::findOne(['id' => $item->img])->src.');">';
                    echo '<div class="test-price">';
                    if(Discount::findOne(['id_test' => $item->id, 'status' => 1])){
                        echo '<span class="old-price">'.$item->price.'</span>';
                        echo '<span class="new-price">'.Discount::findOne(['id_test' => $item->id, 'status' => 1])->amount.'</span>';
                    }
                    else{
                        echo '<span class="new-price">'.$item->price.'</span>';
                    }
                    echo '<span class="currency-price">p</span>';
                    echo '</div>';
                    echo '<a href="'.Url::toRoute(['/payment/index/', 'test' => $item->id]).'" class="btn-go-test">ПРОЙТИ ТЕСТ</a>';
                    echo '</div>';
                    echo '<div class="disk-test">';
                    echo '<h3 class="list-title">'.$item->title.'</h3>';
                    echo '<p class="likes"><span class="likes-count">'.$item->like.'</span></p>';
                    echo '</div>';
                    echo '</li>';
                    $i++;
                }
            ?>
        </ul>
        <a href="<?= Url::toRoute(['/site/list-test']); ?>" class="btn-more-test">БОЛЬШЕ ТЕСТОВ</a>
    </div>
</section>

<section class="about">
    <div class="container-main">
        <div class="text-content">

            <h2 class="section-title"><?= $content[0]->title; ?></h2>
            <div class="text-content_wrapper" style="transition:.6s">
                <?= $content[0]->description; ?>
            </div>
            <span class="read-more">Читать далее></span>

        </div>
        <div class="about-slider">
            <div id="carousel-about" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <?php
                    for($i = 0, $iMax = count($slider); $i<$iMax; $i++ ){
                        if($i == 0){
                            echo '<li data-target="#carousel-about" data-slide-to="'.$i.'" class="active"></li>';
                        }
                        else{
                            echo '<li data-target="#carousel-about" data-slide-to="'.$i.'"></li>';
                        }
                    }
                ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php
                        for($i = 0, $iMax = count($slider); $i<$iMax; $i++ ){
                            if($i == 0){
                                echo '<div class="item about-item about-item-'.$i.' active" style="background-image: url('.$slider[$i].');"></div>';
                            }
                            else{
                                echo '<div class="item about-item about-item-'.$i.'" style="background-image: url('.$slider[$i].');"></div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end about-->

<!-- start posts-->
<section class="posts">
    <div class="container-main">
        <ul class="popular-posts">
            <?php
                foreach ($blog as $item) {
                    echo '<li>';
                    echo '<article class="post-item">';
                    echo '<header>';
                    echo '<div class="post-category">ПСИХОЛОГИЯ</div>';
                    echo '<time class="post-time">'.Yii::$app->formatter->asDate(date("Y-m-d", $item->updated_at), 'php:d F, G:i').'</time>';
                    echo '</header>';
                    echo '<div class="post-thumbnail">';
                    $media = \common\models\database\BlogMedia::findOne(['id' => $item->blog_media_id]);
                    switch ($media->type_media){
                        case 0:
                            $img = Gallery::findOne(['id' => $media->img]);
                            echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                            break;
                        case 1:

                            echo '<div id="myCarousel_'.$item->id.'" class="carousel slide" data-ride="carousel">';
                            echo '<div class="carousel-inner" role="listbox">';
                            $k = 0;
                            foreach (unserialize(Slider::findOne(['id' => $media->slider])->image_id) as $slide) {
                                if($k){
                                    echo '<div class="item">';
                                }
                                else{
                                    echo '<div class="item active">';
                                }
                                $img = Gallery::findOne(['id' => $slide]);
                                echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                echo '</div>';
                                $k++;
                            }
                            echo '</div>';
                            echo '<a class="left carousel-control" href="#myCarousel_'.$item->id.'" role="button" data-slide="prev">';
                            echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
                            echo '<span class="sr-only">Previous</span>';
                            echo '</a>';
                            echo '<a class="right carousel-control" href="#myCarousel_'.$item->id.'" role="button" data-slide="next">';
                            echo '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
                            echo '<span class="sr-only">Next</span>';
                            echo '</a>';
                            echo '</div>';
                            break;
                        case 2:
                            echo $media->video;
                            break;
                    }
                    echo '<span class="reading-number">'.$item->like.'</span>';
                    echo '</div>';
                    echo '<h3 class="post-title"><a href="'.Url::toRoute(['/blog/view/', 'element' => $item->alias]).'">'.$item->title.'</a></h3>';
                    echo '<p class="post-content">'.$item->description.'</p>';
                    echo '</article>';
                    echo '</li>';
                }
            ?>
        </ul>
    </div>
</section>
<!-- end posts-->

<!-- start comment-slider-->
<div class="comment-slider">
    <div id="comment-slider" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="top-raw"></div>
                <div class="comment-item">
                    <img src="/theme/img/ava.png" class="comment-avatar" alt="avatar">
                    <p class="author">Александра Богданова</p>
                    <p class="author-meta">Должность </p>
                    <p class="comment">Если вы хотите выглядеть на все сто, то стоит подбирать цвета,  которые гармонируют с вашим естественным колоритом, а для этого нужно определить, какому  цветотипу  вы относитесь.</p>
                </div>
            </div><!-- end item-->
            <div class="item">
                <div class="top-raw"></div>
                <div class="comment-item">
                    <img src="/theme/img/ava.png" class="comment-avatar" alt="avatar">
                    <p class="author">Александра Богданова1111</p>
                    <p class="author-meta">Должность </p>
                    <p class="comment">Если вы хотите выглядеть на все сто, то стоит подбирать цвета,  которые гармонируют с вашим естественным колоритом, а для этого нужно определить, какому  цветотипу  вы относитесь.</p>
                </div>
            </div>
        </div><!-- end item-->

        <!-- Controls -->
        <a class="left carousel-control" href="#comment-slider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#comment-slider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<!-- end comment-slider-->

<!-- start contact-us-->
<section class="contact">
    <div class="container-main">
        <div class="top-row">
            <div class="col empty"></div>
            <div class="col with-title">
                <h3 class="section-title">Партнеры</h3>
            </div>
        </div>
        <div class="main-row">
            <div class="col contact-info">
                <p class="contact-text">
                    <span>Есть идеи о сотрудничестве?</span>
                    <span>Пишите нам на <a href="mailto:info@imagecorp.ru">info@imagecorp.ru</a></span>
                </p>
            </div>
            <div class="col partner-slider">
                <div id="partner-slider" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <div class="flex-wrap">
                                <img src="/theme/img/partner-lamoda.jpg" alt="partner">
                                <img src="/theme/img/partner-quelle.jpg" alt="partner">
                                <img src="/theme/img/partner-otto.jpg" alt="partner">
                            </div>
                        </div><!-- end item-->
                        <div class="item">
                            <div class="flex-wrap">
                                <img src="/theme/img/partner-sapato.jpg" alt="partner">
                                <img src="/theme/img/partner-ibody.jpg" alt="partner">
                                <img src="/theme/img/partner-wildberries.jpg" alt="partner">
                            </div>
                        </div>
                    </div><!-- end item-->

                    <!-- Controls -->
                    <a class="left carousel-control" href="#partner-slider" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#partner-slider" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-row">
            <div class="col">
                <ul>
                    <li>
                        <p class="faq-item">
                            <span class="glyphicon glyphicon-plus"></span>
                            Насколько правдивы ответы?
                        </p>
                        <p class="faq-answer">Алгоритм просчитан до самых точных моментов. Некоторые ответы, по мнению имиджмейкера, имеют большую значимость, которую мы задали при ответах. Убедитесь сами:) </p>
                    </li>
                    <li>
                        <p class="faq-item">
                            <span class="glyphicon glyphicon-plus"></span>
                            Бонусы за рекомендации?
                        </p>
                        <p class="faq-answer">С каждой оплаты 15% уходит Вам за рекомендации. Средства можно потратить на тесты, написав на
                            <a href="mailto:info@imagecorp.ru">info@imagecorp.ru</a>,  либо же вывести с кабинета. </p>
                    </li>
                    <li>
                        <p class="faq-item">
                            <span class="glyphicon glyphicon-plus"></span>
                            Присутствует ли "выезд Имиджмейкера"?
                        </p>
                        <p class="faq-answer">Да, конечно же. Мы всегда стремимся поддержать нашу аудиторию, создав персональные условия для комфорта</p>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li>
                        <p class="faq-item">
                            <span class="glyphicon glyphicon-plus"></span>
                            Можно ли тест проходить несколько раз?
                        </p>
                        <p class="faq-answer">Нет, тест можно пройти единожды. Здесь просим Вас быть внимательными и отнестись со всей серьезность. </p>
                    </li>
                    <li>
                        <p class="faq-item">
                            <span class="glyphicon glyphicon-plus"></span>
                            Я нашел баг (ошибку)
                        </p>
                        <p class="faq-answer">Напишите нам на <a href="mailto:info@imagecorp.ru">info@imagecorp.ru</a> и получите тест "Цветотип" в подарок.</p>
                    </li>
                    <li>
                        <p class="faq-item">
                            <span class="glyphicon glyphicon-plus"></span>
                            Чем отличается "Комплекс" от выбора "По одному"?
                        </p>
                        <p class="faq-answer">Вопросы одинаковые, результаты ответов в "Комплекс" получите сразу на все, разложенные по полочкам, также стоимость ниже на 10%, и целесообразней наш робот оденет вас от "А до Я"</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end contact-us-->

<?= $this->render('/_block/_footer'); ?>
<?php $this->registerJs("
jQuery(document).ready(function($){
var curHeight = $('.text-content_wrapper').height();
$('.text-content_wrapper').css({'height':'357px','overflow':'hidden'});
console.log(curHeight);
 $('span.read-more').click(function(){
     if($('.text-content_wrapper').height() <= 357){
        $(this).parent('.text-content').find('.text-content_wrapper').css({'height':curHeight+'px' , 'overflow':'visible'});
        $(this).text('<Читать далее');
     } else {
        $(this).parent('.text-content').find('.text-content_wrapper').css({'height':'357px','overflow':'hidden'});
        $(this).text('Читать далее>');
     }

 });
});
"); ?>
