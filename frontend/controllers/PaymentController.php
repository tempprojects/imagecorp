<?php

namespace frontend\controllers;

use common\models\database\Order;
use common\models\database\User;
use common\models\main\DataOrder;
use Yii;
use common\models\database\Test;
use common\models\main\StringModel;

class PaymentController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if ($action->id === 'check' || $action->id === 'aviso') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        Yii::$app->view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/bulma/0.0.16/css/bulma.min.css');
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
        Yii::$app->view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/flexie/1.0.3/flexie.min.js', ['depends' => 'yii\web\YiiAsset']);
        if(Yii::$app->request->get()){
            $model = Test::findOne(['id' => Yii::$app->request->get('test')]);
        }
        else{
            return $this->redirect(['/site/index']);
        }
        return $this->render('index',[
            'model' => $model
        ]);
    }

    public function actionInvoice()
    {
        Yii::$app->view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/bulma/0.0.16/css/bulma.min.css');
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
        Yii::$app->view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/flexie/1.0.3/flexie.min.js', ['depends' => 'yii\web\YiiAsset']);
        if(Yii::$app->request->get()){
            $model = Test::findOne(['id' => Yii::$app->request->get('test')]);
        }
        else{
            return $this->redirect(['/site/index']);
        }
        return $this->render('invoice',[
            'model' => $model
        ]);
    }

    public function actionOnePay(){
        Yii::$app->view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/bulma/0.0.16/css/bulma.min.css');
        Yii::$app->view->registerCssFile('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
        Yii::$app->view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/flexie/1.0.3/flexie.min.js', ['depends' => 'yii\web\YiiAsset']);
        if(Yii::$app->request->get()){
            $model = Test::findOne(['id' => Yii::$app->request->get('test')]);
        }
        else{
            return $this->redirect(['/site/index']);
        }
        

        $order = Order::findOne(['order_id' => Yii::$app->request->get('order')]);

        $user = User::findOne(['id' => $order->id_user]);

        $configs = array();
        $configs['shopId'] 			= '117233';
        $configs['scId'] 			= '532316';
        $configs['ShopPassword'] 	= 'asD15famil8476aoN';



        return $this->render('one-pay',[
            'model'   => $model,
            'order'   => $order,
            'configs' => $configs,
            'user'    => $user,
        ]);
    }

    public function actionCheck(){
        $model = Order::findOne(['order_id' => Yii::$app->request->post('customerNumber')]);
        $configs = array();
        $configs['shopId'] 			= '117233';
        $configs['scId'] 			= '532316';
        $configs['ShopPassword'] 	= 'asD15famil8476aoN';
        $data = unserialize($model->data);
        $data['stepOne'] = $_POST;
        $model->data = serialize($data);
        $model->step = 1;
        $model->update();


        $f = fopen("uploads/check.txt", "w");
// Записать текст
        fwrite($f, serialize($_POST));
// Закрыть текстовый файл
        fclose($f);


        $hash = md5(Yii::$app->request->post('action').';'.Yii::$app->request->post('orderSumAmount').';'.Yii::$app->request->post('orderSumCurrencyPaycash').';'.Yii::$app->request->post('orderSumBankPaycash').';'.$configs['shopId'].';'.Yii::$app->request->post('invoiceId').';'.Yii::$app->request->post('customerNumber').';'.$configs['ShopPassword']);
        if (strtolower($hash) != strtolower(Yii::$app->request->post('md5'))){
            $code = 1;
        }
        else {
            $code = 0;
        }
        Yii::$app->response->format = 'xmlCheck';
        $arr = [
            'performedDatetime' => date("c"),
            'code' => $code,
            'invoiceId' => Yii::$app->request->post('invoiceId'),
            'shopId' => $configs['shopId']
        ];
        return $arr;
    }

    public function actionAviso(){
        $model = Order::findOne(['order_id' => Yii::$app->request->post('customerNumber')]);
        $configs = array();
        $configs['shopId'] 			= '117233';
        $configs['scId'] 			= '532316';
        $configs['ShopPassword'] 	= 'asD15famil8476aoN';

        $data = unserialize($model->data);

        $data['stepTwo'] = $_POST;

        $model->data = serialize($data);
        $model->step = 2;
        $model->update();
        $hash = md5(Yii::$app->request->post('action').';'.Yii::$app->request->post('orderSumAmount').';'.Yii::$app->request->post('orderSumCurrencyPaycash').';'.Yii::$app->request->post('orderSumBankPaycash').';'.$configs['shopId'].';'.Yii::$app->request->post('invoiceId').';'.Yii::$app->request->post('customerNumber').';'.$configs['ShopPassword']);
        if (strtolower($hash) != strtolower(Yii::$app->request->post('md5'))){
            $code = 1;
        }
        else {
            $code = 0;
        }
        Yii::$app->response->format = 'xmlAviso';
        $arr = [
            'performedDatetime' => date("c"),
            'code' => $code,
            'invoiceId' => Yii::$app->request->post('invoiceId'),
            'shopId' => $configs['shopId']
        ];
        return $arr;
    }


}