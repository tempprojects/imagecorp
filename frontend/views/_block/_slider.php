<?php

use common\models\database\Slider;
use common\models\database\Test;
use common\models\database\Gallery;

/* @var $this yii\web\View */

/**
 * Created by IntelliJ IDEA.
 * User: sandro
 * Date: 29.04.16
 * Time: 14:08
 */

?>
<div id="carousel_main" class="carousel slide main-slider" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        <?php
            $slides = [];
            $i = 0;
            foreach (unserialize(Slider::findOne(['id' => 1])->image_id) as $item) {
                $img = Gallery::findOne(['id' => (int)$item]);
                $data = Test::findOne(['id' => (int)$img->data]);
                if($data){
                    echo '<div style="background-image: url('.$img->src.')" class="item top-slide-'.$i.' top-slide';
                    if($i == 0){
                        echo ' active';
                    }
                    echo '">';
                    echo '<div class="flex-wrap">';
                    echo '<div class="tests">';
                    echo '<h2 class="slide-title">'.$data->title.'</h2>';
                    echo '<p class="slide-text">';
                    echo $data->description;
                    echo '</p>';
                    echo '<div class="btns-wrap">';
                    echo '<a href="#" class="btn-female">ЖЕНЩИНА</a>';
                    echo '<a href="#" class="btn-male">МУЖЧИНА</a>';
                    echo '</div>';
                    echo '<p class="likes"><span class="likes-count">'.$data->like.'</span></p>';
                    echo '<a class="left carousel-control" href="#carousel_main" role="button" data-slide="prev">';
                    echo '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>';
                    echo '<span class="sr-only">Previous</span>';
                    echo '</a>';
                    echo '<a class="right carousel-control" href="#carousel_main" role="button" data-slide="next">';
                    echo '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>';
                    echo '<span class="sr-only">Next</span>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    $i++;
                }
            }
        ?>
    </div>
</div>
