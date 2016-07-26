<?php
namespace common\models\main;

use Yii;
use yii\base\Model;
use common\models\database\Order;
use common\models\main\StringModel;

/**
 * Class dataOrder
 * @package app\models\getData
 *
 * @property integer $summ
 * @property string $payType
 * @property string $idElement
 * @property string $recurent
 * @property string $date
 * @property integer $user
 * @property integer $order_id
 */

class DataOrder extends Model
{
    public $summ;
    public $payType;
    public $idElement;
    public $recurent;
    public $user;
    public $order_id;
    public $date;

    public function rules()
    {
        return [
            [['summ'], 'required'],
            [['summ', 'user'], 'integer'],
            [['idElement', 'recurent', 'payType', 'date'], 'string'],
        ];
    }

    public function getNewOrder($user){
        $order = new Order();
        $this->order_id = $this->getIdNewOrder();
        $this->date = (string)time();
        $order->order_id = $this->order_id;
        $order->id_user = $user;
        $order->date = $this->date;
        $order->for = Yii::$app->request->post('test');
        $order->data = serialize([]);
        $order->type = 'nulled';
        $order->sum = 399;
        $order->recurent = 11;
        $order->step = 0;
        $order->save();
        return $order;
    }

    private function getIdNewOrder(){
        return StringModel::generate(16);
    }
}