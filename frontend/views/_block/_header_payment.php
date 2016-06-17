<?php
//use Yii;
?>
<div class="container">
    <nav class="navbar">
        <!-- Left Side -->
        <div class="navbar-item">
            <span class="icon is-medium"><a href="#!"><i class="fa fa-twitter"></i></a></span>
            <span class="icon is-medium"><a href="#!"><i class="fa fa-facebook"></i></a></span>
            <span class="icon is-medium"><a href="#!"><i class="fa fa-vk"></i></a></span>
            <span class="icon is-medium"><a href="#!"><i class="fa fa-instagram"></i></a></span>
        </div>

        <!-- /Left Side -->
        <!-- Center -->
        <div class="navbar-item is-text-centered">
            <a href="/"><img src="<?= Yii::$app->params['site']; ?>/theme/img/logo.svg" class="logo-svg" alt="Корпорация Имиджа"></a>
        </div>
        <!-- /Center -->
        <!-- Right Side -->
        <div class="navbar-item is-text-right accent normal text_1">
            <a href="#">Войти</a> или

            <a href="#">Зарегистрироваться</a>
        </div>
        <!-- /Right Side -->

    </nav>
</div>