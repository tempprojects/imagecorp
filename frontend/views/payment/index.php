<?php

use yii\helpers\Url;
use common\models\database\Gallery;

$img = Gallery::findOne(['id' => $model->img]);

/* @var $this yii\web\View */
?>

<?= $this->render('/_block/_header_payment'); ?>

<div class="container">
    <section class="hero">
        <div class="hero-content">
            <h1 class="title">CЛЕДУЮЩИЙ ТЕСТ</h1>
        </div>
    </section>
    <section>
        <div class="columns">
            <div class="is-third center-block">
                <div class="card">
                    <div class="card-image">
                        <figure class="relative image  card-img-size">
                            <img src="<?= $img->src; ?>" alt="<?= $img->alt; ?>" title="<?= $img->title; ?>">
                            <!-- <div class="is-overlay prices">
                                <del>399</del> 299р
                            </div> -->
                            <a class="is-overlay pink-hover" href="<?= Url::toRoute(['/payment/invoice', 'test' => $model->id]); ?>">
                                <!-- ПРОЙТИ ТЕСТ -->
                            </a>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <span class="card-prim"><?= $model->title; ?></span>
                            </div>
                            <div class="media-content is-text-right">
                                <img src="/theme/img/like_pink.png" alt=""><span class="like pink"><?= $model->like; ?></span>
                            </div>
                        </div>
                        <div class="is-text-centered">
                            <a href="<?= Url::toRoute(['/payment/invoice', 'test' => $model->id]); ?>" class="button primary primary_min">Начать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>