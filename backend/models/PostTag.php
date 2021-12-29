<?php

namespace backend\models;

use common\components\helpers\StringHelper;
use common\components\SystemConstant;
use Yii;

/**
 * This is the model class for table "post_tag".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property int|null $status 0 for inactive, 1 for active
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class PostTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['slug', 'checkDuplicatedSlug']
        ];
    }

    public function checkDuplicatedSlug()
    {
        $color = PostTag::find()->where(['slug' => StringHelper::toSlug($this->title)])->asArray()->all();
        if ($color) {
            $this->addError('name', Yii::t('app', 'This title has already been used.'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @param $attribute
     * @param $params
     * @param $validator
     */
    public function checkDuplicateSlug($attribute, $params, $validator)
    {
        if (\common\models\PostTag::findOne(['slug' => StringHelper::toSlug($this->title)])) {
            $this->addError($attribute, 'Thẻ đã tồn tại.');
        }
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updatePostTagTitle($id, $attribute, $value)
    {
        $slug = StringHelper::toSlug($value);
        return \common\models\PostTag::updateAll([$attribute => $value, 'slug' => $slug, 'updated_at' => date('Y-m-d H:i:s')], ['id' => $id]);
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updatePostTagStatus($id, $attribute, $value)
    {
        return \common\models\PostTag::updateAll([$attribute => $value, 'updated_at' => date('Y-m-d H:i:s')], ['id' => $id]);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllTags()
    {
        return \common\models\PostTag::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
    }
}
