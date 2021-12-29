<?php

namespace backend\models;

use common\components\helpers\StringHelper;
use common\components\SystemConstant;
use Yii;

/**
 * This is the model class for table "trademark".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property int|null $status 0 for inactive, 1 for active
 * @property int|null $admin_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Trademark extends \common\models\Trademark
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trademark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'admin_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['name', 'checkDuplicatedSlug']
        ];
    }

    public function checkDuplicatedSlug()
    {
        $trademark = Trademark::find()->where(['slug' => StringHelper::toSlug($this->name)])->asArray()->all();
        if ($trademark) {
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
            'status' => Yii::t('app', 'Status'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllTrademark()
    {
        return \common\models\Trademark::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updateTitle($id, $attribute, $value)
    {
        $slug = StringHelper::toSlug($value);
        return \common\models\Trademark::updateAll(
            [
                $attribute => $value,
                'slug' => $slug,
                'updated_at' => date('Y-m-d H:i:s'),
                'admin_id' => Yii::$app->user->identity->getId()
            ], ['id' => $id]);
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updateStatus($id, $attribute, $value)
    {
        return \common\models\Trademark::updateAll(
            [
                $attribute => $value,
                'admin_id' => Yii::$app->user->identity->getId(),
                'updated_at' => date('Y-m-d H:i:s')
            ], ['id' => $id]);
    }
}
