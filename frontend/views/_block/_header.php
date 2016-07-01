<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

/**
 * Created by IntelliJ IDEA.
 * User: sandro
 * Date: 29.04.16
 * Time: 13:51
 */
?>
<div class="header-area">
    <header class="m-header">
        <div class="<?= (Yii::$app->controller->route == 'site/index')? 'blog-link':'blog-link style-grey'; ?>">
            <a class="" href="<?= Url::toRoute(['/blog/index']); ?>">Блог</a>
        </div>
        <div class="logo">
            <a href="/"><img src="<?= (Yii::$app->controller->route == 'site/index')? '/theme/img/logo_light.svg':'/theme/img/logo_dark.svg'; ?>" alt="Корпорация Имиджа"></a>
        </div>
            <?php
                if(!Yii::$app->user->isGuest){
                    echo '<ul class="user-menu">';
                    echo '<li><a href="#">Профиль</a></li>';
                    echo '<li><a href="#">Мои тесты</a></li>';
                    echo '<li><a href="' .  Yii::$app->getUrlManager()->getBaseUrl() . 'user/security/logout ">Выйти</a></li>';
                    echo '</ul>';
                    echo '<div class="header-right header-menu m-hidden">';
                    echo '<div class="header-item">';
                    echo '<img src="/theme/img/photo.png" alt="">';

                    if(Yii::$app->controller->route == 'site/index'){
                        echo '<p class="login-btn">' . Yii::$app->user->identity->username . '</p>';
                    }
                    else{
                        echo '<p class="login-btn style-color">Александра</p>';
                    }
                    
                    echo '</div>';
                }
                else{
                    echo '<ul class="user-menu">';
                    echo '<li><a href="' .  Yii::$app->getUrlManager()->getBaseUrl() . 'user/security/login ">Войти</a></li>';
                    echo '<li><a href="#">Зарегистрироваться</a></li>';
                    echo '</ul>';
                    echo '<div class="header-right header-menu m-hidden">';
                    echo '<div class="header-item">';
                    if(Yii::$app->controller->route == 'site/index'){
                        echo '<p class="login-btn">Меню</p>';
                    }
                    else{
                        echo '<p class="login-btn style-color">Меню</p>';
                    }
                    echo '</div>';
                }
            ?>
        </div>
        <div class="hidden-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
</div>
