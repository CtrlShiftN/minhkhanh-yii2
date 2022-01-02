<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form of `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'discount', 'quantity', 'trademark_id', 'is_feature', 'viewed', 'fake_sold', 'sold', 'status', 'admin_id'], 'integer'],
            [['name', 'slug', 'short_description', 'description', 'SKU', 'image', 'images', 'related_product', 'created_at', 'updated_at'], 'safe'],
            [['cost_price', 'regular_price', 'sale_price', 'selling_price'], 'number'],
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
        $query = Product::find();

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
            'cost_price' => $this->cost_price,
            'regular_price' => $this->regular_price,
            'discount' => $this->discount,
            'sale_price' => $this->sale_price,
            'selling_price' => $this->selling_price,
            'quantity' => $this->quantity,
            'trademark_id' => $this->trademark_id,
            'is_feature' => $this->is_feature,
            'viewed' => $this->viewed,
            'fake_sold' => $this->fake_sold,
            'sold' => $this->sold,
            'status' => $this->status,
            'admin_id' => $this->admin_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'SKU', $this->SKU])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'related_product', $this->related_product]);

        return $dataProvider;
    }
}
