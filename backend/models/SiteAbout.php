<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "site_about".
 *
 * @property int $id
 * @property string|null $content
 * @property string $image
 * @property string $section
 * @property int $admin_id
 * @property int|null $status 0 for inactive 1 for active
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class SiteAbout extends \common\models\SiteAbout
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_about';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'section'], 'string'],
            [['image', 'section', 'admin_id'], 'required'],
            [['admin_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['image'], 'string', 'max' => 255],
            ['file', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'on' => 'create'],
            ['file', 'required', 'on' => 'create'],
            ['content', 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content' => Yii::t('app', 'Content'),
            'image' => Yii::t('app', 'Image'),
            'section' => Yii::t('app', 'Section'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'file' => Yii::t('app', 'File')
        ];
    }

    public static function updateAttr($id, $attribute, $value)
    {
        return \common\models\SiteAbout::updateAll(
            [
                $attribute => $value,
                'updated_at' => date('Y-m-d H:i:s'),
                'admin_id' => Yii::$app->user->identity->getId()
            ], ['id' => $id]);
    }
}
