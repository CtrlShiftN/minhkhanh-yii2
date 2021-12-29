<?php

namespace backend\models;

use common\components\helpers\StringHelper;
use common\components\SystemConstant;
use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $type_id
 * @property int|null $status 0 for inactive, 1 for active
 * @property int|null $admin_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ProductCategory extends \common\models\ProductCategory
{
    public $types;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'type_id'], 'required'],
            [['status', 'admin_id'], 'integer'],
            [['created_at', 'updated_at', 'types'], 'safe'],
            [['name', 'slug', 'type_id'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['slug', 'checkDuplicatedSlug']
        ];
    }

    public function checkDuplicatedSlug()
    {
        $color = ProductCategory::find()->where(['slug' => StringHelper::toSlug($this->name)])->asArray()->all();
        if ($color) {
            $this->addError('title', Yii::t('app', 'This name has already been used.'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'type_id' => Yii::t('app', 'Type ID'),
            'status' => Yii::t('app', 'Status'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updateProductCategoryTitle($id, $attribute, $value)
    {
        $slug = StringHelper::toSlug($value);
        return \common\models\ProductCategory::updateAll([$attribute => $value, 'slug' => $slug, 'updated_at' => date('Y-m-d H:i:s'), 'admin_id' => Yii::$app->user->identity->getId()], ['id' => $id]);
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updateProductCategoryStatus($id, $attribute, $value)
    {
        return \common\models\ProductCategory::updateAll([$attribute => $value, 'updated_at' => date('Y-m-d H:i:s'), 'admin_id' => Yii::$app->user->identity->getId()], ['id' => $id]);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllProductCategory()
    {
        return \common\models\ProductCategory::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
    }
}
