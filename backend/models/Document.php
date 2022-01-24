<?php

namespace backend\models;

use common\components\helpers\StringHelper;
use Yii;

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
    public $imageFile;
    public $documentFile;

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
            ['imageFile', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'on' => 'create'],
            [['imageFile', 'documentFile'], 'required', 'on' => 'create'],
            ['documentFile','file','extensions' => 'png, jpg, jpeg, zip, sql, exe, doc, doc, docx, gif, htm, html, ini, jar, m4a, mov, mp3, mp4, pdf, txt, xlm, xls, xlsx, xps', 'on' => 'create'],
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
            'product_type_id' => Yii::t('app', 'Type'),
            'imageFile' => Yii::t('app', 'Image'),
            'documentFile' => Yii::t('app', 'Document'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function updateDocument($id, $attribute, $value)
    {
        return \common\models\Document::updateAll([
            $attribute => $value,
            'updated_at' => date('Y-m-d H:i:s'),
            'admin_id' => Yii::$app->user->identity->getId()
        ], ['id' => $id]);
    }
}
