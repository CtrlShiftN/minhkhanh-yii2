<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $avatar
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property int|null $admin_id
 * @property int|null $viewed
 * @property string|null $tag_id
 * @property int $post_category_id
 * @property int|null $status 0 for inactive, 1 for active
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avatar', 'title', 'slug', 'content', 'post_category_id'], 'required'],
            [['content'], 'string'],
            [['admin_id', 'viewed', 'post_category_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['avatar', 'title', 'slug', 'tag_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'avatar' => Yii::t('app', 'Avatar'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'content' => Yii::t('app', 'Content'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'viewed' => Yii::t('app', 'Viewed'),
            'tag_id' => Yii::t('app', 'Tag ID'),
            'post_category_id' => Yii::t('app', 'Post Category ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
