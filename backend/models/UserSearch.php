<?php

namespace backend\models;

use backend\models\User;
use common\components\SystemConstant;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form of `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'role'], 'integer'],
            [['username', 'name', 'tel', 'address', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verified_at', 'referral_code', 'created_at', 'updated_at', 'verification_token', 'source', 'source_id'], 'safe'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()->where(['status' => SystemConstant::STATUS_ACTIVE]);
        $query->andWhere(['>=', 'id', 2]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query->indexBy('id'),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'verified_at' => $this->verified_at,
            'status' => $this->status,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'referral_code', $this->referral_code])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'source_id', $this->source_id]);

        return $dataProvider;
    }
}
