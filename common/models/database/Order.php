<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $order_id
 * @property integer $date
 * @property string $data
 * @property integer $sum
 * @property string $type
 * @property integer $status
 * @property string $for
 * @property integer $recurent
 * @property integer $step
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'order_id', 'date', 'data', 'sum', 'type', 'step'], 'required'],
            [['id', 'id_user', 'date', 'sum', 'status', 'recurent', 'step'], 'integer'],
            [['data'], 'string'],
            [['order_id', 'for'], 'string', 'max' => 500],
            [['type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'order_id' => 'Order ID',
            'date' => 'Date',
            'data' => 'Data',
            'sum' => 'Sum',
            'type' => 'Type',
            'status' => 'Status',
            'for' => 'For',
            'recurent' => 'Recurent',
            'step' => 'Step',
        ];
    }
}
