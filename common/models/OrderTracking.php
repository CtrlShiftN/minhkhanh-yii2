<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_tracking".
 *
 * @property int $id
 * @property int $order_id
 * @property int $admin_id
 * @property int $action 0 - new,1 - processing,2 - approved,3 - shipping,4 - finished,5- cancelled,6 - expired,7 - returned,8 - postpone,9 - rejected,10 - failed,11 - fake
 * @property string|null $notes
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class OrderTracking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_tracking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'admin_id', 'action'], 'required'],
            [['order_id', 'admin_id', 'action'], 'integer'],
            [['notes'], 'string'],
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
            'order_id' => Yii::t('app', 'Order ID'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'action' => Yii::t('app', 'Action'),
            'notes' => Yii::t('app', 'Notes'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
