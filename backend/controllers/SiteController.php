<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actions(){
        if(Yii::$app->user->isGuest){
            $this->redirect(['user/security/login']);
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
