<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $name;
    public $tel;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'required', 'message'=>'{attribute}' . Yii::t('app',' can not be blank.')],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('app', 'This email address is already in use.')],

            ['password', 'required', 'message'=>'{attribute}' . Yii::t('app',' can not be blank.')],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['name', 'required', 'message'=>'{attribute}' . Yii::t('app',' can not be blank.')],
            ['name', 'string', 'max' => 100],

            ['tel', 'required', 'message'=>'{attribute}' . Yii::t('app',' can not be blank.')],
            [['tel'], 'match', 'pattern' => '/^(84|0)+([0-9]{9})$/', 'message' => Yii::t('app', 'Includes 10 digits starting with 0 or 84.')],
        ];
    }

    /**
     * @return bool|null
     * @throws \yii\base\Exception
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->name = $this->name;
        $user->tel = $this->tel;
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        $user->username = strstr($this->email, '@', true);
        $user->referral_code = strstr($this->email, '@', true);
        $user->role = $user::ROLE_USER;
        $user->created_at = date('Y-m-d H:m:s');
        $user->updated_at = date('Y-m-d H:m:s');
        $user->status = $user::STATUS_ACTIVE;
        return $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app','Email'),
            'name' => Yii::t('app','Name'),
            'password' => Yii::t('app','Password'),
            'tel' => Yii::t('app','Tel'),
        ];
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail(User $user): bool
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
