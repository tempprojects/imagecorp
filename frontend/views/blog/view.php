<?php

use yii\helpers\Url;
use common\models\database\Gallery;
use common\models\database\Slider;
$this->title = 'Корпорация Имиджа | '. $model->title;
/* @var $this yii\web\View */

$media = \common\models\database\BlogMedia::findOne(['id' => $model->blog_media_id]);

?>
<!-- head-banner-->
<!--<aside class="wrap-head-banner">-->
<!--    <a class="banner-link" href="#"><img src="img/head-banner.jpg" alt="#"></a>-->
<!--</aside>-->
<!-- end head-banner-->

<?= $this->render('/_block/_header_blog'); ?>

<div class="blog-content blog-container-s ">

    <div class="main-content">
        <div class="posts-content">
            <article class="post-disk">
                <div class="wrap-meta">
                    <?php
                    switch ($media->type_media){
                        case 0:
                            $img = Gallery::findOne(['id' => $media->img]);
                            echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                            break;
                        case 1:
                            echo '<div id="myCarousel_popular_'.$model->id.'" class="carousel slide" data-ride="carousel">';
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
                            echo '<a class="left carousel-control" href="#myCarousel_popular_'.$model->id.'" role="button" data-slide="prev">';
                            echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
                            echo '<span class="sr-only">Previous</span>';
                            echo '</a>';
                            echo '<a class="right carousel-control" href="#myCarousel_popular_'.$model->id.'" role="button" data-slide="next">';
                            echo '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
                            echo '<span class="sr-only">Next</span>';
                            echo '</a>';
                            echo '</div>';
                            break;
                        case 2:
                            echo '<div class="embed-responsive embed-responsive-16by9">';
                            echo $media->video;
                            echo '</div>';
                            break;
                    }
                    ?>
                    <div class="wrap-main-info">
                        <p class="post-category-s">практика</p>
                        <h3 class="post-title"><?= $model->title?></h3>
                        <p class="post-meta">
                            <span class="author-s">Александа Богданова</span>
                            <time class="post-time-s"><?= Yii::$app->formatter->asDate(date("Y-m-d", $model->updated_at), 'php:d F, G:i'); ?></time>
                            <span class="reading-number-s"><?= ($model->views?$model->views:0) ?></span>
                        </p>
                    </div>
                </div>

                <ul class="share-links">
                    <li class="wrap-like-link">
                        <div class="wrap-share-img">
                            <i class="fa fa-facebook-official" aria-hidden="true"></i>
                            <span class="share-label">Like</span>
                        </div>
                        <div class="wrap-share-count">
                            <span class="count-share">326</span>
                            <span class="stile-border"></span>
                            <span class="stile-bg"></span>
                        </div>
                    </li>
                    <li class="wrap-share-link fb-share">
                        <div class="wrap-share-img">
                            <i class="fa fa-facebook-official" aria-hidden="true"></i>
                        </div>
                        <span class="share-label">Share</span>
                        <div class="wrap-share-count">
                            <span class="count-share">326</span>
                        </div>
                    </li>
                    <li class="wrap-share-link vk-share">
                        <div class="wrap-share-img">
                            <i class="fa fa-vk" aria-hidden="true"></i>
                        </div>
                        <span class="share-label">Share</span>
                        <div class="wrap-share-count">
                            <span class="count-share">326</span>
                        </div>
                    </li>
                    <li class="wrap-share-link tw-share">
                        <div class="wrap-share-img">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </div>
                        <span class="share-label">tweet</span>
                        <div class="wrap-share-count">
                            <span class="count-share">326</span>
                        </div>
                    </li>
                </ul>

                <?= $model->content; ?>

            </article>
        </div>
        <aside class="main-sidebar">
<!--            <div class="right-banner-1">-->
<!--                <a href="#" class="banner-link"><img src="img/banner-1.jpg" alt="#"></a>-->
<!--            </div>-->
<!--            <div class="right-banner-2">-->
<!--                <a href="#" class="banner-link"><img src="img/banner-2.png" alt="#"></a>-->
<!--            </div>-->
<!--            <div class="right-banner-3">-->
<!--                <a href="#" class="banner-link"><img src="img/banner-3.jpg" alt="#"></a>-->
<!--            </div>-->
<!--            <div class="right-banner-4">-->
<!--                <a href="#" class="banner-link"><img src="img/banner-4.jpg" alt="#"></a>-->
<!--            </div>-->
<!--            <div class="right-banner-5">-->
<!--                <a href="#" class="banner-link"><img src="img/banner-4.jpg" alt="#"></a>-->
<!--            </div>-->
        </aside>
    </div><!--end main-content -->

    <div class="more-content">
        <div class="share-friends short-width">
            <h4 class="local-title">Рассказать друзьям</h4>

            <ul class="share-links">
                <li class="wrap-like-link">
                    <div class="wrap-share-img">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                        <span class="share-label">Like</span>
                    </div>
                    <div class="wrap-share-count">
                        <span class="count-share">326</span>
                        <span class="stile-border"></span>
                        <span class="stile-bg"></span>
                    </div>
                </li>
                <li class="wrap-share-link fb-share">
                    <div class="wrap-share-img">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    </div>
                    <span class="share-label">Share</span>
                    <div class="wrap-share-count">
                        <span class="count-share">326</span>
                    </div>
                </li>
                <li class="wrap-share-link vk-share">
                    <div class="wrap-share-img">
                        <i class="fa fa-vk" aria-hidden="true"></i>
                    </div>
                    <span class="share-label">Share</span>
                    <div class="wrap-share-count">
                        <span class="count-share">326</span>
                    </div>
                </li>
                <li class="wrap-share-link tw-share">
                    <div class="wrap-share-img">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </div>
                    <span class="share-label">Share</span>
                    <div class="wrap-share-count">
                        <span class="count-share">326</span>
                    </div>
                </li>
            </ul>

            <form action="#" class="share-form">
                <label for="email">Подписаться на еженедельную рассылку</label>
                <input type="email" id="email" placeholder="Ваш E-mail">
                <button type="submit">Подписаться</button>
            </form>
        </div><!-- end share-friends-->
        <div class="more-posts posts">
            <h4 class="local-title">Читать также</h4>
            <ul class="popular-posts">

                <?php
                foreach ($also as $item) {
                    echo '<li>';
                    echo '<article class="post-item">';
                    echo '<header>';
                    echo '<div class="post-category practic">практика</div>';
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
                            echo '<div id="myCarousel_popular_'.$item->id.'" class="carousel slide" data-ride="carousel">';
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
                            echo '<a class="left carousel-control" href="#myCarousel_popular_'.$item->id.'" role="button" data-slide="prev">';
                            echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
                            echo '<span class="sr-only">Previous</span>';
                            echo '</a>';
                            echo '<a class="right carousel-control" href="#myCarousel_popular_'.$item->id.'" role="button" data-slide="next">';
                            echo '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
                            echo '<span class="sr-only">Next</span>';
                            echo '</a>';
                            echo '</div>';
                            break;
                        case 2:
                            echo '<div class="embed-responsive embed-responsive-16by9">';
                            echo $media->video;
                            echo '</div>';
//                                            echo $media->video;
                            break;
                    }
                    echo '<span class="reading-number">'.($item->views?$item->views:0).'</span>';
                    echo '</div>';
                    echo '<h3 class="post-title"><a href="'.Url::toRoute(['/blog/view', 'element' => $item->alias]).'">'.$item->title.'</a></h3>';
                    echo '<p class="post-content">'.$item->description.'</p>';
                    echo '</article>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div><!-- end more-posts -->
    </div><!-- end more-content -->

<!--    <div class="else-post-list">-->
<!--        <h4 class="local-title">Другие статьи по темам</h4>-->
<!--        <div class="flex-wrap">-->
<!--            <ul class="vert-list">-->
<!--                <li><a href="#">имидж</a></li>-->
<!--                <li><a href="#">красота</a></li>-->
<!--                <li><a href="#">здоровье</a></li>-->
<!--                <li><a href="#">свальба</a></li>-->
<!--            </ul>-->
<!--            <ul class="flex-list">-->
<!--                <li class="tag-item psiho"><a href="#">психология</a></li>-->
<!--                <li class="tag-item practic"><a href="#">практика</a></li>-->
<!--                <li class="tag-item theory"><a href="#">теория</a></li>-->
<!--                <li class="tag-item psiho"><a href="#">психология</a></li>-->
<!--                <li class="tag-item theory"><a href="#">теория</a></li>-->
<!--                <li class="tag-item theory"><a href="#">теория</a></li>-->
<!--                <li class="tag-item theory"><a href="#">теория</a></li>-->
<!--                <li class="tag-item practic"><a href="#">практика</a></li>-->
<!--                <li class="tag-item psiho"><a href="#">психология</a></li>-->
<!--                <li class="tag-item practic"><a href="#">практика</a></li>-->
<!--                <li class="tag-item theory"><a href="#">теория</a></li>-->
<!--                <li class="tag-item practic"><a href="#">практика</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->

</div>

<?= $this->render('/_block/_footer'); ?>
