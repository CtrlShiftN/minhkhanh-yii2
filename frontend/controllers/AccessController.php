<?php
/**
 * Created by PhpStorm.
 * User: giaphv
 * Date: 21/08/2018
 * Time: 10:00 SA
 */

namespace frontend\controllers;

use common\components\SystemConstant;
use common\models\User;
use Yii;
use yii\web\Controller;

class AccessController extends Controller
{
    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;
    const ROLE_SALE = 2;
    const ROLE_EDITOR = 3;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const ROLES = ['User', 'Admin', 'Sale', 'Editor'];

    /**
     * @return array[]
     */
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    /**
     * @param $client
     * @return void|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        $user = User::findOne([
            'source' => $client->getId(),
            'source_id' => $attributes['id']
        ]);
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        } else {
            if ($user) {
                Yii::$app->user->login($user);
                return $this->goHome();
            } else {
                $userModel = new User();
                $userModel->email = $attributes['email'];
                $userModel->setPassword(rand(10000000, 99999999));
                $userModel->name = $attributes['name'];
                $userModel->generateAuthKey();
                $userModel->generatePasswordResetToken();
                $userModel->username = strstr($attributes['email'], '@', true);
                $userModel->referral_code = strstr($attributes['email'], '@', true);
                $userModel->role = $this::ROLE_USER;
                $userModel->source = $client->getId();
                $userModel->source_id = $attributes['id'];
                $userModel->created_at = date('Y-m-d H:m:s');
                $userModel->updated_at = date('Y-m-d H:m:s');
                $userModel->status = SystemConstant::STATUS_ACTIVE;
                if ($userModel->save()) {
                    $_user = User::findOne([
                        'source' => $client->getId(),
                        'source_id' => $attributes['id']
                    ]);
                    Yii::$app->user->login($_user);
                    return $this->goHome();
                }
            }
        }
    }

}