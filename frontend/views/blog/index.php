<?php

use yii\helpers\Url;
use common\models\database\Gallery;
use common\models\database\Slider;

/* @var $this yii\web\View */
?>
<!-- head-banner-->
<!--<aside class="wrap-head-banner blog-container">-->
<!--    <a class="banner-link" href="#"><img src="img/head-banner.jpg" alt="#"></a>-->
<!--</aside>-->
<!-- end head-banner-->

<?= $this->render('/_block/_header_blog'); ?>

    <!-- blog-content -->
    <div class="blog-content blog-container">
        <!-- sub navigation (dynamic position) for .main-nav .img-link-->
        <ul class="category-list">
            <li>теория</li>
            <li>практика</li>
            <li>психология</li>
        </ul>
        <!-- end sub navigation-->
        <div class="main-content">
            <div class="posts-content">
                <div class="top-row">
                    <?php
                    if(2 < count($blog)) {
                        ?>
                        <aside class="widget-post">
                            <ul>
                                <?php
                                for ($d = 2; $d < 7; $d++) {
                                    if ($d < count($blog)) {
                                        echo '<li class="post-list">';
                                        echo '<div class="wrap-img">';
                                        $media = \common\models\database\BlogMedia::findOne(['id' => $blog[$d]->blog_media_id]);
                                        switch ($media->type_media){
                                            case 0:
                                                $img = Gallery::findOne(['id' => $media->img]);
                                                echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                                break;
                                            case 1:

                                                echo '<div id="myCarousel_'.$blog[$d]->id.'" class="carousel slide" data-ride="carousel">';
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
                                                echo '</div>';
                                                break;
                                            case 2:
                                                $img = Gallery::findOne(['id' => $media->img]);
                                                echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                                break;
                                        }
                                        //echo '<img class="blogIndexImg" src="/theme/img/minBlog.png" style="background-image: url(' . Gallery::findOne(['id' => $blog[$d]->blog_media_id])->src . ')" />';
                                        echo '</div>';
                                        echo '<a href="'.Url::toRoute(['/blog/view', 'element' => $blog[$d]->alias]).'" class="short-title hover-prime">' . $blog[$d]->title . '</a>';
                                        echo '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </aside>
                        <?php
                    }
                    ?>
                    <?php
                    if(0 < count($blog)) {
                        ?>
                        <ul class="top-row-posts">
                            <?php
                                for ($d = 0; $d < 2; $d++) {
                                    if ($d < count($blog)) {
                                        echo '<li>';
                                        echo '<article class="post-item">';
                                        echo '<header>';
                                        echo '<div class="post-category theory">теория</div>';
                                        echo '<time class="post-time">' . Yii::$app->formatter->asDate(date("Y-m-d", $blog[$d]->updated_at), 'php:d F, G:i') . '</time>';
                                        echo '</header>';
                                        echo '<div class="post-thumbnail">';
                                        $media = \common\models\database\BlogMedia::findOne(['id' => $blog[$d]->blog_media_id]);
                                        switch ($media->type_media){
                                            case 0:
                                                $img = Gallery::findOne(['id' => $media->img]);
                                                echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                                break;
                                            case 1:

                                                echo '<div id="myCarousel_'.$blog[$d]->id.'" class="carousel slide" data-ride="carousel">';
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
                                                echo '<a class="left carousel-control" href="#myCarousel_'.$blog[$d]->id.'" role="button" data-slide="prev">';
                                                echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
                                                echo '<span class="sr-only">Previous</span>';
                                                echo '</a>';
                                                echo '<a class="right carousel-control" href="#myCarousel_'.$blog[$d]->id.'" role="button" data-slide="next">';
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
                                        //echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url(' . Gallery::findOne(['id' => $blog[$d]->blog_media_id])->src . ')" alt="posts">';
                                        echo '<span class="reading-number">' . $blog[$d]->like . '</span>';
                                        echo '</div>';
                                        echo '<h3 class="post-title"><a href="'.Url::toRoute(['/blog/view', 'element' => $blog[$d]->alias]).'">' . $blog[$d]->title . '</a></h3>';
                                        echo '<p class="post-content">' . $blog[$d]->description . '</p>';
                                        echo '</article>';
                                        echo '</li>';
                                    }
                                }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div><!-- end top-row -->
                <?php
                if(7 < count($blog)) {
                    ?>
                    <ul class="middle-row">
                        <?php
                            for($d = 7; $d < 11; $d++){
                                if ($d < count($blog)) {
                                    echo '<li>';
                                    echo '<article class="post-item">';
                                    echo '<header>';
                                    echo '<div class="post-category practic">практика</div>';
                                    echo '<time class="post-time">' . Yii::$app->formatter->asDate(date("Y-m-d", $blog[$d]->updated_at), 'php:d F, G:i') . '</time>';
                                    echo '</header>';
                                    echo '<div class="post-thumbnail">';
                                    $media = \common\models\database\BlogMedia::findOne(['id' => $blog[$d]->blog_media_id]);
                                    switch ($media->type_media){
                                        case 0:
                                            $img = Gallery::findOne(['id' => $media->img]);
                                            echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                            break;
                                        case 1:

                                            echo '<div id="myCarousel_'.$blog[$d]->id.'" class="carousel slide" data-ride="carousel">';
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
                                            echo '<a class="left carousel-control" href="#myCarousel_'.$blog[$d]->id.'" role="button" data-slide="prev">';
                                            echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
                                            echo '<span class="sr-only">Previous</span>';
                                            echo '</a>';
                                            echo '<a class="right carousel-control" href="#myCarousel_'.$blog[$d]->id.'" role="button" data-slide="next">';
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
//                                    echo '<img  class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url(' . Gallery::findOne(['id' => $blog[$d]->blog_media_id])->src . ')" alt="posts">';
                                    echo '<span class="reading-number">' . $blog[$d]->like . '</span>';
                                    echo '</div>';
                                    echo '<h3 class="post-title"><a href="'.Url::toRoute(['/blog/view', 'element' => $blog[$d]->alias]).'">' . $blog[$d]->title . '</a></h3>';
                                    echo '<p class="post-content">' . $blog[$d]->description . '</p>';
                                    echo '</article>';
                                    echo '</li>';
                                }
                            }
                        ?>
                    </ul><!-- end middle-row -->
                    <?php
                }
                ?>
                <div class="bottom-row">
                    <?php
                    if(11 < count($blog)) {
                        ?>
                        <aside class="widget-post">
                            <ul>
                                <?php
                                for ($d = 11; $d < 14; $d++) {
                                    if ($d < count($blog)) {
                                        echo '<li class="post-list">';
                                        echo '<div class="wrap-img">';
                                        $media = \common\models\database\BlogMedia::findOne(['id' => $blog[$d]->blog_media_id]);
                                        switch ($media->type_media){
                                            case 0:
                                                $img = Gallery::findOne(['id' => $media->img]);
                                                echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                                break;
                                            case 1:

                                                echo '<div id="myCarousel_'.$blog[$d]->id.'" class="carousel slide" data-ride="carousel">';
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
                                                echo '</div>';
                                                break;
                                            case 2:
                                                $img = Gallery::findOne(['id' => $media->img]);
                                                echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                                break;
                                        }
                                        echo '</div>';
                                        echo '<a href="'.Url::toRoute(['/blog/view', 'element' => $blog[$d]->alias]).'" class="short-title hover-prime">' . $blog[$d]->title . '</a>';
                                        echo '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </aside>
                        <?php
                    }
                    ?>
                    <?php
                    if(14 < count($blog)) {
                        ?>
                        <div class="single-post">
                            <article class="post-item">
                                <header>
                                    <div class="post-category practic">Свадебный стиль</div>
                                    <time class="post-time"><?= Yii::$app->formatter->asDate(date("Y-m-d", $blog[14]->updated_at), 'php:d F, G:i'); ?></time>
                                </header>
                                <div class="post-thumbnail">
                                    <?php
                                    $media = \common\models\database\BlogMedia::findOne(['id' => $blog[14]->blog_media_id]);
                                    switch ($media->type_media){
                                        case 0:
                                            $img = Gallery::findOne(['id' => $media->img]);
                                            echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                            break;
                                        case 1:

                                            echo '<div id="myCarousel_'.$blog[14]->id.'" class="carousel slide" data-ride="carousel">';
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
                                            echo '<a class="left carousel-control" href="#myCarousel_'.$blog[14]->id.'" role="button" data-slide="prev">';
                                            echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
                                            echo '<span class="sr-only">Previous</span>';
                                            echo '</a>';
                                            echo '<a class="right carousel-control" href="#myCarousel_'.$blog[14]->id.'" role="button" data-slide="next">';
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
                                    <span class="reading-number"><?= $blog[14]->like; ?></span>
                                </div>
                                <h3 class="post-title"><a href="<?= Url::toRoute(['/blog/view', 'element' => $blog[$d]->alias]); ?>"><?= $blog[14]->title; ?></a></h3>

                                <p class="post-content"><?= $blog[14]->description; ?></p>
                            </article>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(15 < count($blog)) {
                        ?>
                        <aside class="widget-post">
                            <ul>
                                <?php
                                for ($d = 15; $d < 19; $d++) {
                                    if ($d < count($blog)) {
                                        echo '<li class="post-list">';
                                        echo '<div class="wrap-img">';
                                        $media = \common\models\database\BlogMedia::findOne(['id' => $blog[$d]->blog_media_id]);
                                        switch ($media->type_media){
                                            case 0:
                                                $img = Gallery::findOne(['id' => $media->img]);
                                                echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                                break;
                                            case 1:

                                                echo '<div id="myCarousel_'.$blog[$d]->id.'" class="carousel slide" data-ride="carousel">';
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
                                                echo '</div>';
                                                break;
                                            case 2:
                                                $img = Gallery::findOne(['id' => $media->img]);
                                                echo '<img class="blogIndexImg" src="/theme/img/nulled_index_blog.png" style="background-image: url('.$img->src.')" alt="'.$img->alt.'" title="'.$img->title.'">';
                                                break;
                                        }
                                        echo '</div>';
                                        echo '<a href="'.Url::toRoute(['/blog/view', 'element' => $blog[$d]->alias]).'" class="short-title hover-prime">' . $blog[$d]->title . '</a>';
                                        echo '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </aside>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <aside class="main-sidebar">
<!--                <div class="right-banner-1">-->
<!--                    <a href="#" class="banner-link"><img src="img/banner-1.jpg" alt="#"></a>-->
<!--                </div>-->
<!--                <div class="right-banner-2">-->
<!--                    <a href="#" class="banner-link"><img src="img/banner-2.png" alt="#"></a>-->
<!--                </div>-->
<!--                <div class="right-banner-3">-->
<!--                    <a href="#" class="banner-link"><img src="img/banner-3.jpg" alt="#"></a>-->
<!--                </div>-->
<!--                <div class="right-banner-4">-->
<!--                    <a href="#" class="banner-link"><img src="img/banner-4.jpg" alt="#"></a>-->
<!--                </div>-->
<!--                <div class="right-banner-5">-->
<!--                    <a href="#" class="banner-link"><img src="img/banner-4.jpg" alt="#"></a>-->
<!--                </div>-->
            </aside>
        </div>
<!--        <p class="load-more"><button type="button">ЗАГРУЗИТЬ ЕЩЕ</button></p>-->
    </div>
    <!--  end blog-content -->

    <!-- popular -->
    <div class="popular blog-container">
        <h3 class="section-title">ПОПУЛЯРНОЕ</h3>
        <ul class="popular-list">
            <?php
                foreach ($popular as $item) {
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
                    echo '<span class="reading-number">'.$item->like.'</span>';
                    echo '</div>';
                    echo '<h3 class="post-title"><a href="'.Url::toRoute(['/blog/view', 'element' => $item->alias]).'">'.$item->title.'</a></h3>';
                    echo '<p class="post-content">'.$item->description.'</p>';
                    echo '</article>';
                    echo '</li>';
                }
            ?>
        </ul>
    </div>
    <!-- end popular -->


<?= $this->render('/_block/_footer'); ?>