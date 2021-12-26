<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $BL_code
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property int $province_id
 * @property int $district_id
 * @property int $village_id
 * @property string $specific_address
 * @property string $address
 * @property string|null $notes
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property int $admin_id
 * @property int $logistic_method 0:home delivery, 1:receive at store
 * @property int|null $status 0 - new,1 - processing,2 - approved,3 - shipping,4 - finished,5- cancelled,6 - expired,7 - returned,8 - postpone,9 - rejected,10 - failed,11 - fake
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BL_code', 'user_id', 'product_id', 'quantity', 'province_id', 'district_id', 'village_id', 'specific_address', 'address', 'name', 'email', 'tel', 'admin_id', 'logistic_method'], 'required'],
            [['user_id', 'product_id', 'quantity', 'province_id', 'district_id', 'village_id', 'admin_id', 'logistic_method', 'status'], 'integer'],
            [['address', 'notes'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['BL_code', 'specific_address', 'name', 'email', 'tel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'BL_code' => Yii::t('app', 'Bl Code'),
            'user_id' => Yii::t('app', 'User ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'province_id' => Yii::t('app', 'Province ID'),
            'district_id' => Yii::t('app', 'District ID'),
            'village_id' => Yii::t('app', 'Village ID'),
            'specific_address' => Yii::t('app', 'Specific Address'),
            'address' => Yii::t('app', 'Address'),
            'notes' => Yii::t('app', 'Notes'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'tel' => Yii::t('app', 'Tel'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'logistic_method' => Yii::t('app', 'Logistic Method'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
