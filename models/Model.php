<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "table".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $price
 * @property string $description
 * @property integer $available
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'description'], 'required'],
            [['order_id', 'available'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'price' => 'Price',
            'description' => 'Description',
            'available' => 'Available',
        ];
    }
}
