<?php

namespace frontend\controllers;

use common\components\encrypt\CryptHelper;
use common\components\helpers\ParamHelper;
use frontend\models\Document;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class DocumentController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = 'main';
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true; // or false to not run the action
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $type = ParamHelper::getParamValue('type');
        if ($type) {
            $type = CryptHelper::decryptString($type);
        } else {
            $type = null;
        }
        $document = Document::getAllDocument($type);
        $arrType = ['Camera','Elevator'];
        return $this->render('index',[
            'arrType' => $arrType,
            'document' => $document->all()
        ]);
    }

}
