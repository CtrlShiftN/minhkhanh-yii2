<?php

namespace console\controllers;

use common\components\importSample\SampleData;
use yii\console\Controller;

class SeederController extends Controller
{
    public function actionIndex() {
        echo SampleData::importAllSampleData();
    }
}
