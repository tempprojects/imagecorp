<?php

use yii\helpers\Url;
use common\models\database\Gallery;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use  yii\widgets\Pjax;

$img = Gallery::findOne(['id' => $model->img]);

/* @var $this yii\web\View */
?>

<?= $this->render('/_block/_header_payment'); ?>


<div class="container">
    <section class="hero">
        <div class="hero-content">
            <!-- <h1 class="title">CЛЕДУЮЩИЙ ТЕСТ</h1> -->
            <div class="breadcrumbs is-text-centered">

                <div class="is-ib">
                    <a href="<?= Url::toRoute(['/payment/index', 'test' => $model->id]); ?>" class="button brd">
                        1
                    </a>
                    <p>ТЕСТ</p>
                </div>
                <div class="is-ib">
                    <a href="#" class="is-disabled button brd">
                        2
                    </a>
                    <p>СПОСОБЫ ОПЛАТЫ</p>
                </div>
            </div>
        </div>
    </section>
    <section>


        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'action' => '/user/registration/register',
            'options' => [
                'class' => 'signup-form',
                'data-pjax' => true,
                'enctype' => 'multipart/form-data',
            ],
        ]); ?>

        <div class="columns">
            <div class="column is-half is-text-right">
                <div class="box box_min is-pulled-right">
                    <?= $this->render('/_block/_register'); ?>
                    <div class="pad-top is-text-centered">С помощью аккаунта в соц. сетях</div>
                    <div class="pad-top is-text-centered">
                        <span class="pink-icon icon is-medium"><a href="#!"><i class="fa fa-twitter"></i></a></span>
                        <span class="pink-icon icon is-medium"><a href="#!"><i class="fa fa-facebook"></i></a></span>
                        <span class="pink-icon icon is-medium"><a href="#!"><i class="fa fa-vk"></i></a></span>
                    </div>
                    <div class="pad-top is-text-centered">
                        Есть аккаунт? <a href="#">Войти</a><br>
                        <input style="display: inline-block" name="yes" type="checkbox"> <a href="http://imagecorp.ru/doc/Настоящий документ «Пользовательское соглашение» представляет собой предложение imagecorp.docx">Пользовательское соглашение</a>
                    </div>
                </div>
            </div>
            <div class="column is-third is-text-left">
                <div class="card">
                    <div class="card-image">
                        <figure class="relative image  card-img-size">
                            <img src="/theme/img/nulled_index_blog.png" class="blogIndexImg" style="background-image: url(<?= $img->src; ?>" alt="<?= $img->alt; ?>" title="<?= $img->title; ?>)">
                            <!-- <div class="is-overlay prices">
                                <del>399</del> 299р
                            </div> -->
                            <a class="is-overlay pink-hover" href="#">
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
                        <div>
                            Вы только что прошли тест на ЦВЕТОТИП ВНЕШНОСТИ. Полноценная профессиональная имидж-консультация внутри личного кабинета! Готовы? Добро пожаловать!
                        </div>
                        <div class="big-price">
                            <?= $model->price; ?>Р
                        </div>
                        <div class="is-text-centered">
                            <button class="button primary primary_min" type="submit">Оплатить</button>
                            <a href="#"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </section>

</div>