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
    
    public function actions()
    {
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
        Yii::$app->view->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', ['depends' => 'yii\web\YiiAsset']);

        $model = Test::find()->orderBy('sort')->limit(3)->all();
        $slider = [];
        foreach (unserialize(Slider::findOne(['id' => 2])->image_id) as $key => $item) {
            $slider[$key] = Gallery::findOne(['id' => $item])->src;
        }
        $aboutUs = Content::findOne(['id' => 1]);
//        var_dump($aboutUs);die;
        //meta
        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $aboutUs->getAttribute('meta_description')]);
        Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $aboutUs->getAttribute('meta_title')]);
        Yii::$app->view->registerMetaTag(['name' => 'keys', 'content' => $aboutUs->getAttribute('meta_keys')]);

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

        $seoBlock = Content::findOne(['id' => 2]);
        //meta
        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $seoBlock->getAttribute('meta_description')]);
        Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $seoBlock->getAttribute('meta_title')]);
		Yii::$app->view->registerMetaTag(['name' => 'keys', 'content' => $seoBlock->getAttribute('meta_keys')]);

        return $this->render('list-test', [
            'female' => $female,
            'male' => $male,
            'wedd' => $wedd,
            'seoBlock' => $seoBlock,
        ]);
    }
} 