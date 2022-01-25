<?php

namespace backend\models;

use common\components\helpers\StringHelper;
use common\components\SystemConstant;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $short_description
 * @property string $description
 * @property float $cost_price
 * @property float $regular_price
 * @property int|null $discount
 * @property float|null $sale_price
 * @property float $selling_price
 * @property string|null $SKU
 * @property int $quantity
 * @property string $image
 * @property string|null $images
 * @property string|null $related_product
 * @property int|null $trademark_id
 * @property int|null $hide 0 for show, 1 for hide
 * @property int|null $is_feature 0 for no, 1 for yes
 * @property int|null $viewed +1 each click to view
 * @property int|null $fake_sold client see this amount if sold < 1k
 * @property int|null $sold
 * @property int|null $status 0 for inactive, 1 for active
 * @property int|null $admin_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Product extends \common\models\Product
{
    public $file;
    public $files;
    public $type;
    public $category;
    public $relatedProduct;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'description', 'cost_price', 'regular_price', 'selling_price', 'image'], 'required'],
            [['description', 'images'], 'string'],
            [['cost_price', 'regular_price', 'sale_price', 'selling_price'], 'number'],
            [['discount', 'quantity', 'trademark_id', 'hide', 'is_feature', 'viewed', 'fake_sold', 'sold', 'status', 'admin_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'short_description', 'SKU', 'image', 'related_product'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['file', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'on' => 'create'],
            ['file', 'required', 'on' => 'create'],
            [['files'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10, 'on' => 'create'],
            [['type', 'category', 'relatedProduct'], 'safe'],
            [['type', 'category'], 'required', 'when' => function ($model) {
                return Yii::$app->controller->action->id == 'create';
            }, 'whenClient' => "function () {return $('#action').val() == 'create';}"],
            ['quantity', 'integer', 'min' => 1],
            ['name', 'checkDuplicatedSlug'],
            ['discount', 'integer', 'min' => 0, 'max' => 100]
        ];
    }

    public function checkDuplicatedSlug()
    {
        $product = Product::find()->where(['slug' => StringHelper::toSlug($this->name)])->asArray()->all();
        if ($product) {
            $this->addError('name', Yii::t('app', 'This name has already been used.'));
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
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'cost_price' => Yii::t('app', 'Cost Price'),
            'regular_price' => Yii::t('app', 'Regular Price'),
            'discount' => Yii::t('app', 'Discount'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'SKU' => Yii::t('app', 'Sku'),
            'quantity' => Yii::t('app', 'Quantity'),
            'image' => Yii::t('app', 'Image'),
            'images' => Yii::t('app', 'Images'),
            'related_product' => Yii::t('app', 'Related Product'),
            'relatedProduct' => Yii::t('app', 'Related Product'),
            'trademark_id' => Yii::t('app', 'Trademark'),
            'hide' => Yii::t('app', 'Hide'),
            'is_feature' => Yii::t('app', 'Feature'),
            'viewed' => Yii::t('app', 'Viewed'),
            'fake_sold' => Yii::t('app', 'Fake Sold'),
            'sold' => Yii::t('app', 'Sold'),
            'status' => Yii::t('app', 'Status'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'type' => Yii::t('app', 'Product Type'),
            'category' => Yii::t('app', 'Product Category'),
        ];
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updateProductTitle($id, $attribute, $value)
    {
        $slug = StringHelper::toSlug($value);
        return \common\models\Product::updateAll([$attribute => $value, 'slug' => $slug, 'updated_at' => date('Y-m-d H:i:s'), 'admin_id' => Yii::$app->user->identity->getId()], ['id' => $id]);
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updateProductAttr($id, $attribute, $value)
    {
        return \common\models\Product::updateAll([$attribute => $value, 'updated_at' => date('Y-m-d H:i:s'), 'admin_id' => Yii::$app->user->identity->getId()], ['id' => $id]);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllProduct()
    {
        return Product::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
    }

    /**
     * @param int $product_id
     * @return false|int|string|null
     */
    public static function findNameByID(int $product_id)
    {
        return Product::find()->select('name')->where(['status' => SystemConstant::STATUS_ACTIVE, 'id' => $product_id])->scalar();
    }

    /**
     * @param $_id
     * @param $value
     * @return bool
     */
    public static function updateDiscount($_id, $value)
    {
        $model = Product::findOne($_id);
        $model->discount = $value;
        $salePrice = $model->regular_price * (100 - $model->discount) / 100;
        $model->sale_price = round($salePrice, -3);
        $model->selling_price = $model->sale_price;
        return $model->save(false);
    }
}
