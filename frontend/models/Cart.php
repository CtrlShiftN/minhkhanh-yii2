<?php

namespace frontend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property int $total_price
 * @property int|null $status 0 for inactive, 1 for active
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Cart extends \common\models\Cart
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'quantity', 'total_price'], 'required'],
            [['user_id', 'product_id', 'quantity', 'total_price', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'total_price' => Yii::t('app', 'Total Price'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public static function getCartByUserId($id)
    {
        return (new Query())->select(
            [
                'c.id',
                'c.quantity',
                'c.total_price',
                'p.name as p-name',
                'p.image as p-img',
                'p.quantity as p-quantity',
                'p.selling_price as p-price',
                'p.id as p-id',
            ]
        )->from('cart as c')
            ->leftJoin('product as p', 'p.id = c.product_id')
            ->where(['c.status' => 1, 'c.user_id' => $id])->all();
    }
}
