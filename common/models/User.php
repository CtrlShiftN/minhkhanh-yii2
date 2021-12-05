<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string|null $tel
 * @property string|null $address
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property string|null $verified_at
 * @property string $referral_code
 * @property int $status 0 for inactive, 1 for active
 * @property int $role 0 for customer, >= 1 for admins and sales
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $verification_token
 * @property string|null $source
 * @property string|null $source_id
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;
    const ROLE_SALE = 2;
    const ROLE_EDITOR = 3;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const ROLES = ['User', 'Admin', 'Sale', 'Editor'];

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name', 'auth_key', 'password_hash', 'email', 'referral_code', 'created_at', 'updated_at'], 'required'],
            [['verified_at', 'created_at', 'updated_at'], 'safe'],
            [['status', 'role'], 'integer'],
            ['role', 'default', 'value' => self::ROLE_USER],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['username', 'address', 'password_hash', 'password_reset_token', 'email', 'referral_code', 'verification_token', 'source', 'source_id'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 12],
            ['tel', 'validateTel'],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['referral_code'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'name' => Yii::t('app', 'Name'),
            'tel' => Yii::t('app', 'Tel'),
            'address' => Yii::t('app', 'Address'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'verified_at' => Yii::t('app', 'Verified At'),
            'referral_code' => Yii::t('app', 'Referral Code'),
            'status' => Yii::t('app', 'Status'),
            'role' => Yii::t('app', 'Role'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'source' => Yii::t('app', 'Source'),
            'source_id' => Yii::t('app', 'Source ID'),
        ];
    }

    public function validateTel($attribute, $params, $validator)
    {
        if (!preg_match('/^(84|0[1-9])+([0-9]{8})$/', $this->tel)) {
            $this->addError($attribute, 'Số điện thoại không hợp lệ');
        }
    }

    /**
     * @param int|string $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @param $username
     * @return User|null
     */
    public static function findByUsername($username): ?User
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @param $email
     * @return User|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @param $token
     * @return User|null
     */
    public static function findByPasswordResetToken($token): ?User
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param $token
     * @return User|null
     */
    public static function findByVerificationToken($token): ?User
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * @param $token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token): bool
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @return array|int|mixed|string|null
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return string|null
     */
    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * @todo Reset password_reset_token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }
}
