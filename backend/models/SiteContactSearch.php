<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SiteContact;

/**
 * SiteContactSearch represents the model behind the search form of `backend\models\SiteContact`.
 */
class SiteContactSearch extends SiteContact
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tel', 'admin_id', 'status'], 'integer'],
            [['gps_link', 'logo_link', 'company_address', 'email', 'created_at', 'updated_at'], 'safe'],
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
        $query = SiteContact::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'tel' => $this->tel,
            'admin_id' => $this->admin_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'gps_link', $this->gps_link])
            ->andFilterWhere(['like', 'logo_link', $this->logo_link])
            ->andFilterWhere(['like', 'company_address', $this->company_address])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
