<?php

use yii\helpers\Url;
use common\models\database\Gallery;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

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

        <div class="columns">
            <div class="column is-half is-text-right">
                <div class="box box_min is-pulled-right">
                    <form method="POST" action="https://demomoney.yandex.ru/eshop.xml">
                        <!-- Если у вас боевой режим платежей, то замените action="https://money.yandex.ru/eshop.xml" -->

                        <!-- ОБЯЗАТЕЛЬНАНЫЕ ПОЛЯ (все параметры яндекс.кассы регистрозависимые) -->
                        <input type="hidden" name="shopId" value="<?= $configs['shopId']; ?>">
                        <input type="hidden" name="scid" value="<?= $configs['scId']; ?>">
                        Код платежа: <?= $order->order_id; ?><br>
                        <input type="hidden" name="customerNumber" value="<?= $order->order_id; ?>"><br><br>
                        Сумма (руб.): <?= $model->price; ?><br>
                        <input type="hidden" name="sum" value="<?= $model->price; ?>"><br><br>

                        <!-- CustomerNumber -- до 64 символов; идентификатор плательщика в ИС Контрагента.
                        В качестве идентификатора может использоваться номер договора плательщика, логин плательщика и т.п.
                        Возможна повторная оплата по одному и тому же идентификатору плательщика.

                        sum -- сумма заказа в рублях.
                        -->

                        <!-- необязательные поля (все параметры яндекс.кассы регистрозависимые) -->
                        <input name="orderNumber" value="<?= $order->order_id; ?>" type="hidden"/>
                        <input name="cps_phone" value="79110000000" type="hidden"/>
                        <input name="cps_email" value="user@domain.com" type="hidden"/>

                        <!-- Внимание! Для тестирования в ДЕМО-среде доступны только два метода оплаты: тестовый Яндекс.Кошелек и Тестовая банковская карта
                        -->
                        Способ оплаты:<br><br>
                        <div class="is-block">
                            <div class="uppercase is-text-centered text_0">Яндекс.Деньгах
                                <input value="PC" type="radio" id="c1" name="paymentType">
                                <label for="c1"><span></span></label>
                            </div>
                        </div>
                        <hr>
                        <div class="is-block">
                            <div class="uppercase is-text-centered text_0">карты
                                <input value="AC" type="radio" id="c2" name="paymentType">
                                <label for="c2"><span></span></label>
                            </div>
                        </div>
                        <!--
                        Если подключен метод repeatCardPayment, то в платежную форму можно добавить
                        <input name="rebillingOn" value="true" type="hidden"/>
                        -->

                        <!--
                        Ниже перечислены доступные формы оплаты.
                        Перечисленные методы оплаты могут быть доступны в боевой среде после подписания Договора.
                        Какие именно методы доступны для вашего Договора, вы можете уточнить у своего персонального менеджера.

                        AB - Альфа-Клик
                        AC - банковская карта
                        GP - наличные через терминал
                        MA - MasterPass
                        MC - мобильная коммерция
                        PB  -интернет-банк Промсвязьбанка
                        PC - кошелек Яндекс.Денег
                        SB - Сбербанк Онлайн
                        WM - кошелек WebMoney
                        WQ - Qiwi
                        QP - Куппи.ру
                        KV - КупиВкредит

                        <input name="paymentType" value="GP" type="radio">Оплата по коду через терминал<br>
                        <input name="paymentType" value="WM" type="radio">Оплата cо счета WebMoney<br>
                        <input name="paymentType" value="AB" type="radio">Оплата через Альфа-Клик<br>
                        <input name="paymentType" value="PB" type="radio">Оплата через Промсвязьбанк<br>
                        <input name="paymentType" value="MA" type="radio">Оплата через MasterPass<br>
                        <input name="paymentType" value="QW" type="radio">Оплата через Qiwi<br>
                        <input name="paymentType" value="QP" type="radio">Куппи.ру<br>
                        <input name="paymentType" value="KV" type="radio">КупиВкредит<br>

                        Перечисление всех методов оплаты https://tech.yandex.ru/money/doc/payment-solution/reference/payment-type-codes-docpage/
                        -->

                        <br>
                        <input type=submit value="Оплатить"><br>
                    </form>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>