<?php

use yii\helpers\Url;
use common\models\database\Gallery;
use common\models\search\Discount;

/**
 * Created by IntelliJ IDEA.
 * User: sandro
 * Date: 29.04.16
 * Time: 23:45
 */

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
    <!--[if IE]>
    <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<?= $this->render('/_block/_header'); ?>

<section class="pad-top-more head-marg">
    <h1 class="page-title">Вы - персональный имиджмейкер</h1>
    <div class="container">
        <div class="is-text-centered tests-btns">
            <button type="button" class="toggle-tab lips">Женщина</button>
            <button type="button" class="toggle-tab usi">Мужчина</button>
            <button type="button" class="toggle-tab wedd">Свадьба</button>
        </div>
        <div class="columns is-multiline pad-top-more test-box-more">
            <!-- female tests-->
            <div class="female-tests">
                <?php
                    foreach ($female as $item) {
                        echo '<div class="column is-8 is-offset-2 pad-top">';
                        echo '<div class="card wide">';
                        echo '<div class="card-image">';
                        echo '<figure class="relative image tests-img card-img-size">';
                        echo '<img src="'.Gallery::findOne(['id' => $item->img])->src.'" alt="'.Gallery::findOne(['id' => $item->img])->alt.'" title="'.Gallery::findOne(['id' => $item->img])->title.'">';
                        echo '<div class="is-overlay prices">';
                        if(Discount::findOne(['id_test' => $item->id, 'status' => 1])){
                            echo '<span class="old-price">'.$item->price.'</span>';
                            echo Discount::findOne(['id_test' => $item->id, 'status' => 1])->amount.'р</div>';
                        }
                        else{
                            echo $item->price.'р</div>';
                        }
                       // echo '<a class="is-overlay hover-gray" href="'.Url::toRoute(['/payment/index', 'test' => $item->id]).'">ПРОЙТИ ТЕСТ</a>';
                        
                        echo '<a class="is-overlay hover-gray" href="'.Url::toRoute(['test/inittest', 'id' => $item->id]).'">ПРОЙТИ ТЕСТ</a>';
                        echo '</figure>';
                        echo '</div>';
                        echo '<div class="card-content">';
                        echo '<div class="media">';
                        echo '<div class="media-left">';
                        echo '<span>'.$item->title.'</span>';
                        echo '</div>';
                        echo '<div class="media-content is-text-right">';
                        echo '<img src="/theme/img/like_pink.png" alt=""><span class="like pink">'.$item->like.'</span>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="text">';
                        echo $item->description;
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
            <!-- end female tests-->
            <!-- male tests-->
            <div class="male-tests hide-tab">
                <?php
                    foreach ($male as $item) {
                        echo '<div class="column is-8 is-offset-2 pad-top">';
                        echo '<div class="card wide">';
                        echo '<div class="card-image">';
                        echo '<figure class="relative image tests-img card-img-size">';
                        echo '<img src="'.Gallery::findOne(['id' => $item->img])->src.'" alt="'.Gallery::findOne(['id' => $item->img])->alt.'" title="'.Gallery::findOne(['id' => $item->img])->title.'">';
                        echo '<div class="is-overlay prices">';
                        if(Discount::findOne(['id_test' => $item->id, 'status' => 1])){
                            echo '<span class="old-price">'.$item->price.'</span>';
                            echo Discount::findOne(['id_test' => $item->id, 'status' => 1])->amount.'р</div>';
                        }
                        else{
                            echo $item->price.'р</div>';
                        }
                        echo '<a class="is-overlay hover-gray" href="'.Url::toRoute(['test/inittest', 'id' => $item->id]).'">ПРОЙТИ ТЕСТ</a>';
                        echo '</figure>';
                        echo '</div>';
                        echo '<div class="card-content">';
                        echo '<div class="media">';
                        echo '<div class="media-left">';
                        echo '<span>'.$item->title.'</span>';
                        echo '</div>';
                        echo '<div class="media-content is-text-right">';
                        echo '<img src="/theme/img/like_pink.png" alt=""><span class="like pink">'.$item->like.'</span>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="text">';
                        echo $item->description;
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
            <!-- end male tests-->
            <!-- wedd tests-->
            <div class="wedd-tests hide-tab">
                <?php
                    foreach ($wedd as $item) {
                        echo '<div class="column is-8 is-offset-2 pad-top">';
                        echo '<div class="card wide">';
                        echo '<div class="card-image">';
                        echo '<figure class="relative image tests-img card-img-size">';
                        echo '<img src="'.Gallery::findOne(['id' => $item->img])->src.'" alt="'.Gallery::findOne(['id' => $item->img])->alt.'" title="'.Gallery::findOne(['id' => $item->img])->title.'">';
                        echo '<div class="is-overlay prices">';
                        if(Discount::findOne(['id_test' => $item->id, 'status' => 1])){
                            echo '<span class="old-price">'.$item->price.'</span>';
                            echo Discount::findOne(['id_test' => $item->id, 'status' => 1])->amount.'р</div>';
                        }
                        else{
                            echo $item->price.'р</div>';
                        }
                        echo '<a class="is-overlay hover-gray" href="'.Url::toRoute(['test/inittest', 'id' => $item->id]).'">ПРОЙТИ ТЕСТ</a>';
                        echo '</figure>';
                        echo '</div>';
                        echo '<div class="card-content">';
                        echo '<div class="media">';
                        echo '<div class="media-left">';
                        echo '<span>'.$item->title.'</span>';
                        echo '</div>';
                        echo '<div class="media-content is-text-right">';
                        echo '<img src="/theme/img/like_pink.png" alt=""><span class="like pink">'.$item->like.'</span>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="text">';
                        echo $item->description;
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
            <!-- end wedd tests-->
        </div>
        <div class="is-text-centered"><a href="#" class="prima-btn btn-more">Загрузить еще</a></div>
    </div>
</section>


<?= $this->render('/_block/_footer'); ?>