<?php

namespace frontend\models;

use common\components\SystemConstant;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "document".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $image
 * @property string|null $link
 * @property int|null $product_type_id
 * @property int|null $admin_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Document extends \common\models\Document
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_type_id', 'admin_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'image', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'),
            'link' => Yii::t('app', 'Link'),
            'product_type_id' => Yii::t('app', 'Product Type ID'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @param $type
     * @return Query
     */
    public static function getAllDocument($type) {
        $query = (new Query())->from('document')
            ->where(['status' => SystemConstant::API_SUCCESS_STATUS]);
        if($type != null) {
            $query->andWhere(['product_type_id' => $type]);
        }
        return $query;
    }
}
