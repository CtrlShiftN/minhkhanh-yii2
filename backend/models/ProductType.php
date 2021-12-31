<?php

namespace backend\models;

use common\components\helpers\StringHelper;
use common\components\SystemConstant;
use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string $image
 * @property int|null $status 0 for inactive, 1 for active
 * @property int|null $admin_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ProductType extends \common\models\ProductType
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image'], 'required'],
            [['status', 'admin_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'image'], 'string', 'max' => 255],
            [['name'], 'unique', 'targetClass' => ProductType::className()],
            [['slug'], 'unique', 'targetClass' => ProductType::className()],
            ['file', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'on' => 'create'],
//            ['file', 'required', 'on' => 'create']
        ];
    }

    public function checkEmpty()
    {
        if (empty($this->file)) {
            $this->addError('file', Yii::t('app', 'This name has already been used.'));
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
            'image' => Yii::t('app', 'Image'),
            'status' => Yii::t('app', 'Status'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'file' => Yii::t('app', 'File'),
        ];
    }

    /**
     * @param $_id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updateProductTypeTitle($_id, $attribute, $value)
    {
            $slug = StringHelper::toSlug($value);
            return \common\models\ProductType::updateAll([$attribute => $value, 'slug' => $slug, 'updated_at' => date('Y-m-d H:i:s'), 'admin_id' => Yii::$app->user->identity->getId()], ['id' => $_id]);

    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updateProductType($id, $attribute, $value)
    {
            return \common\models\ProductType::updateAll(
                [
                    $attribute => $value,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'admin_id' => Yii::$app->user->identity->getId()
                ], ['id' => $id]);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllTypes()
    {
        return ProductType::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getCasualProductType()
    {
        return \frontend\models\ProductType::find()
            ->orWhere(['status' => SystemConstant::STATUS_ACTIVE])
            ->asArray()->all();
    }
}

