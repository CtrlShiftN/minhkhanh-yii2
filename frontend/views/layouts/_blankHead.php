<?php


$cdnUrl = Yii::$app->params['frontend'];
?>
<link rel="shortcut icon" href="<?= $cdnUrl ?>/favicon.ico"/>
<link rel="icon" type="image/x-icon" href="<?= $cdnUrl ?>/favicon.ico"/>
<script type="text/javascript" src="<?= $cdnUrl ?>/js/popper.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= $cdnUrl ?>/css/site.css">
<script type="text/javascript" src="<?= $cdnUrl ?>/js/jquery.min.js"></script>
<link href="<?= \yii\helpers\Url::toRoute('fontawesome/css/all.css') ?>" rel="stylesheet">
<script type="text/javascript" src="<?= $cdnUrl ?>/bootstrap/js/bootstrap.min.js"></script>