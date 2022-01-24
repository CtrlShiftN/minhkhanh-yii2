<?php

namespace backend\models;

use common\components\SystemConstant;
use Yii;

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
class User extends \common\models\User
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name', 'auth_key', 'email', 'referral_code', 'created_at', 'updated_at'], 'required', 'on' => 'create'],
            ['password_hash', 'required', 'on' => 'create','when' => function ($model) {
                return Yii::$app->controller->action->id == 'create';
            }, 'whenClient' => "function () {return $('#action').val() == 'create';}"],
            [['verified_at', 'created_at', 'updated_at'], 'safe'],
            [['status', 'role'], 'integer'],
            [['username', 'address', 'password_hash', 'password_reset_token', 'email', 'referral_code', 'verification_token', 'source', 'source_id'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 12],
            ['tel', 'validateTel'],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique', 'targetClass' => User::className()],
            [['email'], 'unique', 'targetClass' => User::className()],
            [['referral_code'], 'unique', 'targetClass' => User::className()],
            [['password_reset_token'], 'unique', 'targetClass' => User::className()],
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
        ];
    }

    /**
     * @param $attribute
     * @param $params
     * @param $validator
     */
    public function validateTel($attribute, $params, $validator)
    {
        if (!preg_match('/^(84|0[1-9])+([0-9]{8})$/', $this->tel)) {
            $this->addError($attribute, Yii::t('app', 'Invalid phone number.'));
        }
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int
     */
    public static function updateUser($id, $attribute, $value)
    {
        return \common\models\User::updateAll([$attribute => $value], ['id' => $id]);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllUser()
    {
        return \common\models\User::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllCustomer()
    {
        return \common\models\User::find()
            ->where(['status' => SystemConstant::STATUS_ACTIVE])
            ->andWhere(['!=', 'role', 1])
            ->asArray()->all();
    }

    /**
     * @param int $user_id
     * @return false|int|string|null
     */
    public static function findNameByID(int $user_id)
    {
        return User::find()->select('name')->where(['status' => SystemConstant::STATUS_ACTIVE, 'id' => $user_id])->scalar();
    }
}
