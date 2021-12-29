<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_assoc".
 *
 * @property int $id
 * @property int $product_id
 * @property string $type_id A product can have more than one type
 * @property int $category_id
 * @property int|null $status 0 for inactive, 1 for active
 * @property int|null $admin_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ProductAssoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_assoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'type_id', 'category_id'], 'required'],
            [['product_id', 'category_id', 'status', 'admin_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type_id'], 'string', 'max' => 255],
            [['product_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'status' => Yii::t('app', 'Status'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
