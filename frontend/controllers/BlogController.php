<?php

namespace frontend\controllers;

use Yii;
use common\models\database\Blog;
use common\models\database\BlogCategory;

class BlogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
        Yii::$app->view->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', ['depends' => 'yii\web\YiiAsset']);
        $query = Blog::find();
        if(Yii::$app->request->get('category') && BlogCategory::findOne(['category_alias' => Yii::$app->request->get('category')])){
            $query->where(['category' => BlogCategory::findOne(['category_alias' => Yii::$app->request->get('category')])->id]);
        }
        $model = $query->all();
        $popular = $query->limit(4)->orderBy(['like' => SORT_DESC])->all();
        return $this->render('index',[
            'blog' => $model,
            'popular' => $popular,
        ]);
    }

    public function actionView()
    {
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
        Yii::$app->view->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', ['depends' => 'yii\web\YiiAsset']);
        if(Yii::$app->request->get('element') && Blog::findOne(['alias' => Yii::$app->request->get('element')])){
            $model = Blog::findOne(['alias' => Yii::$app->request->get('element')]);
            $also = Blog::find()->where(['category' => $model->category])->limit(3)->all();

            //meta
            Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $model->getAttribute('meta_description')]);
            Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $model->getAttribute('meta_title')]);
            Yii::$app->view->registerMetaTag(['name' => 'keys', 'content' => $model->getAttribute('meta_keys')]);
        }

        return $this->render('view',[
            'model' => $model,
            'also' => $also,
        ]);
    }
}
