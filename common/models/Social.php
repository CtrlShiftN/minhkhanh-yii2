<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social".
 *
 * @property int $id
 * @property string $icon
 * @property string $link
 * @property int $admin_id
 * @property int|null $status 0 for inactive 1 for active
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Social extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icon', 'link', 'admin_id'], 'required'],
            [['admin_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['icon', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'icon' => Yii::t('app', 'Icon'),
            'link' => Yii::t('app', 'Link'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
