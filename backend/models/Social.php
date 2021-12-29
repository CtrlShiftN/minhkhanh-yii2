<?php

namespace backend\models;

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
class Social extends \common\models\Social
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

    public static function updateSocial($id, $attribute, $value)
    {
        return \common\models\Social::updateAll([
            $attribute => $value,
            'updated_at' => date('Y-m-d H:i:s'),
            'admin_id' => Yii::$app->user->identity->getId()
        ], ['id' => $id]);
    }
}
