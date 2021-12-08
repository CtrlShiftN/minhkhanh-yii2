<?php

namespace frontend\models;

use common\components\SystemConstant;
use common\models\Contact;
use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property int|null $tel
 * @property string|null $content
 * @property int|null $status 0 for inactive, 1 for active
 * @property int|null $user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ContactForm extends Contact
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message' => Yii::t('app', 'Name can not be blank.')],
            [['status', 'user_id'], 'integer'],

            ['content', 'required', 'message' => Yii::t('app', "Content can't be blank.")],
            [['content'], 'string'],

            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],

            ['email', 'required', 'message' => Yii::t('app', "Email can't be blank.")],
            [['email'], 'email', 'message' => Yii::t('app', 'Invalid email.')],

            ['tel', 'integer', 'message' => Yii::t('app', 'Invalid phone number.')],
            ['tel', 'required', 'message' => Yii::t('app', 'Phone number can not be blank.')],
            [['tel'], 'match', 'pattern' => '/^(84|0)+([0-9]{9})$/', 'message' => Yii::t('app', 'Includes 10 digits starting with 0 or 84.')],
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
            'email' => Yii::t('app', 'Email'),
            'tel' => Yii::t('app', 'Tel'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return bool
     */
    public function saveContactData()
    {
        $contactModel = new ContactForm();
        $contactModel->name = $this->name;
        $contactModel->email = $this->email;
        $contactModel->tel = $this->tel;
        $contactModel->content = $this->content;
        if (!Yii::$app->user->isGuest) {
            $contactModel->user_id = Yii::$app->user->identity->id;
        } else {
            $contactModel->user_id = null;
        }
        $contactModel->status = SystemConstant::STATUS_ACTIVE;
        $contactModel->created_at = date('Y-m-d H:i:s');
        $contactModel->updated_at = date('Y-m-d H:i:s');
        return $contactModel->save();
    }

    /**
     * @return bool
     */
    public static function sendReplyContact()
    {
        return Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject(Yii::t('app','You have a new contact!'))
            ->setHtmlBody(Yii::t('app','Customer has just created a contact. Check now!'))
            ->send();
    }
}
