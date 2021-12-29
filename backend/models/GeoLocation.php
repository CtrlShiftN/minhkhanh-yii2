<?php

namespace backend\models;

use common\components\SystemConstant;
use Yii;

/**
 * This is the model class for table "geo_location".
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property int $parent
 * @property int|null $status 0 for inactive, 1 for active
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class GeoLocation extends \common\models\GeoLocation
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'parent'], 'required'],
            [['parent', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
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
            'parent' => Yii::t('app', 'Parent'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllGeoLocation()
    {
        return GeoLocation::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllProvince()
    {
        return GeoLocation::find()->where([
            'status' => SystemConstant::STATUS_ACTIVE,
            'parent' => 0
        ])->orderBy('name ASC')->asArray()->all();
    }

    /**
     * @param $provinceID
     * @return array|void|\yii\db\ActiveRecord[]
     */
    public static function getDistrictByProvinceID($provinceID)
    {
        if ($provinceID > 0) {
            return GeoLocation::find()->where([
                'status' => SystemConstant::STATUS_ACTIVE,
                'parent' => $provinceID,
            ])->asArray()->all();
        }
    }

    /**
     * @param int $geoID
     * @return false|int|string|null
     */
    public static function findNameByID(int $geoID)
    {
        return GeoLocation::find()->select('name')->where(['status' => SystemConstant::STATUS_ACTIVE, 'id' => $geoID])->scalar();
    }
}
