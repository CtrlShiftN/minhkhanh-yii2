<?php

namespace backend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $BL_code
 * @property int $user_id
 * @property int $product_id
 * @property int $color_id
 * @property int $size_id
 * @property int $quantity
 * @property int $province_id
 * @property int $district_id
 * @property int $village_id
 * @property string $specific_address
 * @property string $address
 * @property string|null $notes
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property int $admin_id
 * @property int $logistic_method 0:home delivery, 1:receive at store
 * @property int|null $status 0 - new,1 - processing,2 - approved,3 - shipping,4 - finished,5- cancelled,6 - expired,7 - returned,8 - postpone,9 - rejected,10 - failed,11 - fake
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Order extends \common\models\Order
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BL_code', 'user_id', 'product_id', 'color_id', 'size_id', 'quantity', 'province_id', 'district_id', 'village_id', 'specific_address', 'address', 'name', 'email', 'tel', 'admin_id', 'logistic_method'], 'required'],
            [['user_id', 'product_id', 'color_id', 'size_id', 'quantity', 'province_id', 'district_id', 'village_id', 'admin_id', 'logistic_method', 'status'], 'integer'],
            [['email'], 'email', 'message' => Yii::t('app', 'Invalid email.')],
            [['quantity'], 'integer', 'min' => 1],
            [['address', 'notes'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['BL_code', 'specific_address', 'name', 'email', 'tel'], 'string', 'max' => 255],
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
            'BL_code' => Yii::t('app', 'Bill of lading code'),
            'user_id' => Yii::t('app', 'User'),
            'product_id' => Yii::t('app', 'Product'),
            'color_id' => Yii::t('app', 'Color'),
            'size_id' => Yii::t('app', 'Size'),
            'quantity' => Yii::t('app', 'Quantity'),
            'province_id' => Yii::t('app', 'Province'),
            'district_id' => Yii::t('app', 'District'),
            'village_id' => Yii::t('app', 'Village'),
            'specific_address' => Yii::t('app', 'Specific Address'),
            'address' => Yii::t('app', 'Address'),
            'notes' => Yii::t('app', 'Notes'),
            'name' => Yii::t('app', 'Consignee'),
            'email' => Yii::t('app', 'Email'),
            'tel' => Yii::t('app', 'Tel'),
            'logistic_method' => Yii::t('app', 'Logistic Method'),
            'admin_id' => Yii::t('app', 'Admin'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return bool|void
     */
    public static function updateOrderNotes($id, $attribute, $value)
    {
        $updateStatus = \common\models\Order::updateAll([
            $attribute => $value,
            'updated_at' => date('Y-m-d H:i:s'),
            'admin_id' => Yii::$app->user->identity->getId()
        ], ['id' => $id]);
        $model = \common\models\Order::findOne($id);
        if (!empty($model)) {
            $status = $model->status;
            $adminID = $model->admin_id;
            return self::updateOrCreateOrderTrackingNote($id, $adminID, $status, $value);
        }
    }

    /**
     * @param $orderID
     * @param $adminID
     * @param $actionID
     * @param $note
     * @return bool
     */
    private static function updateOrCreateOrderTrackingNote($orderID, $adminID, $actionID, $note)
    {
        $model = \common\models\OrderTracking::findOne([
            'order_id' => $orderID,
            'admin_id' => $adminID,
            'action' => $actionID
        ]);
        if (!empty($model)) {
            $model->notes = $note;
            $model->updated_at = date('Y-m-d H:i:s');
            return $model->save();
        } else {
            $orderTrackingModel = new \common\models\OrderTracking();
            $orderTrackingModel->order_id = $orderID;
            $orderTrackingModel->admin_id = $adminID;
            $orderTrackingModel->action = $actionID;
            $orderTrackingModel->notes = $note;
            $orderTrackingModel->created_at = date('Y-m-d H:i:s');
            $orderTrackingModel->updated_at = date('Y-m-d H:i:s');
            return $orderTrackingModel->save();
        }
    }

    /**
     * @param $id
     * @param $attribute
     * @param $value
     * @return int|void
     */
    public static function updateOrder($id, $attribute, $value)
    {
        $model = new \common\models\OrderTracking();
        $model->admin_id = Yii::$app->user->identity->getId();
        $model->order_id = $id;
        $model->action = $value;
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');
        if ($model->save()) {
            return \common\models\Order::updateAll([
                $attribute => $value,
                'updated_at' => date('Y-m-d H:i:s'),
                'admin_id' => Yii::$app->user->identity->getId()
            ], ['id' => $id]);
        }
    }

    /**
     * @param int $limit
     * @return array
     */
    public static function getLatestOrder(int $limit)
    {
        return (new Query())
            ->select([
                'o.*',
                'p.name as product_name',
                'u.name as user_name',
                'ts.name as status_name',
            ])->from('order as o')
            ->leftJoin('product as p', 'o.product_id = p.id')
            ->leftJoin('user as u', 'o.user_id = u.id')
            ->leftJoin('tracking_status as ts', 'o.status = ts.id')
            ->orderBy('created_at DESC')
            ->limit($limit)
            ->all();
    }

    public static function getStatusColor()
    {
        return [
            'badge-success',
            'badge-warning',
            'badge-success',
            'badge-warning',
            'badge-secondary',
            'badge-danger',
            'badge-danger',
            'badge-secondary',
            'badge-warning',
            'badge-danger',
            'badge-danger',
        ];
    }
}
