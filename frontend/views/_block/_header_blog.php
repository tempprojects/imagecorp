<?php
use yii\helpers\Url;
use common\models\database\BlogCategory;
?>
<header class="blog-header blog-container">
    <div class="top-row">
        <div class="test-link">
            <a href="#" class="head-text hover-prime">Тесты по имиджу</a>
        </div>
        <div class="login-menu">
            <?php
                if(!Yii::$app->user->isGuest){
                    echo '<ul class="user-menu">';
                    echo '<li><a href="#">Профиль</a></li>';
                    echo '<li><a href="#">Мои тесты</a></li>';
                    echo '<li><a href="#">Выйти</a></li>';
                    echo '</ul>';
                    echo '<div class="login-menu">';
                    echo '<img src="/theme/img/photo.png" alt="">';
                    if(Yii::$app->controller->route == 'site/index'){
                        echo '<p class="login-btn">Александра</p>';
                    }
                    else{
                        echo '<p class="login-btn style-color">Александра</p>';
                    }
                }
                else{
                    echo '<ul class="user-menu">';
                    echo '<li><a href="#">Войти</a></li>';
                    echo '<li><a href="#">Зарегистрироваться</a></li>';
                    echo '</ul>';
                    echo '<div class="login-menu">';
                    echo '<div class="header-item">';
                    if(Yii::$app->controller->route == 'site/index'){
                        echo '<p class="login-btn">Меню</p>';
                    }
                    else{
                        echo '<p class="login-btn style-color">Меню</p>';
                    }
                }
                echo '</div>';
                echo '</div>';
            ?>
        </div>
    </div>
    <div class="header-logo">
        <a href="/"><img src="/theme/img/logo_light.svg" alt="logo"></a>
    </div>
    <div class="header-nav">
        <div class="blog-link">
            <a href="<?= Url::toRoute(['/blog/index']); ?>" class="head-text hover-prime">БЛОГ</a>
        </div>
        <nav class="main-nav">
            <ul>
                <?php
                    foreach (BlogCategory::find()->orderBy(['sort' => SORT_ASC])->all() as $item) {
                        echo '<li><a class="';
                        if(Yii::$app->request->get('category') == $item->category_alias){
                            echo 'current-link ';
                        }
                        echo 'img-link" href="'.Url::toRoute(['/blog/index', 'category' => $item->category_alias]).'">'.$item->title.'</a></li>';
                    }
                ?>
            </ul>
        </nav>

        <div class="search">
            <form action="#">
                <input class="search-input" type="text">
                <button class="btn-search" type="submit"></button>
            </form>
        </div>
    </div>
</header>