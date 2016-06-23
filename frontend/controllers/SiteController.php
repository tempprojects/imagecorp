<?php
namespace frontend\controllers;

use common\models\database\Content;
use common\models\database\Gallery;
use common\models\database\Slider;
use Yii;
use yii\web\Controller;
use common\models\database\Test;
use common\models\database\Blog;

/**
 * Site controller
*/
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
        Yii::$app->view->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', ['depends' => 'yii\web\YiiAsset']);
        $model = Test::find()->where(['sort' => 1])->all();
        $slider = [];
        foreach (unserialize(Slider::findOne(['id' => 2])->image_id) as $key => $item) {
            $slider[$key] = Gallery::findOne(['id' => $item])->src;
        }
        $aboutUs = Content::findOne(['id' => 1]);
        $blog = Blog::find()->limit(3)->all();
        return $this->render('index', [
            'model' => $model,
            'slider' => $slider,
            'content' => [$aboutUs],
            'blog' => $blog
        ]);
    }

    public function actionListTest()
    {
        Yii::$app->view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/bulma/0.0.16/css/bulma.min.css');
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
        $female = Test::find()->where(['type' => 1])->orderBy(['sort' => SORT_DESC])->all();
        $male = Test::find()->where(['type' => 2])->orderBy(['sort' => SORT_DESC])->all();
        $wedd = Test::find()->where(['type' => 3])->orderBy(['sort' => SORT_DESC])->all();
        return $this->render('list-test', [
            'female' => $female,
            'male' => $male,
            'wedd' => $wedd,
        ]);
    }
}
