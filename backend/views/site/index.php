<?php

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Admin Panel');
$imgUrl = Yii::$app->params['common'] . '/media';
?>
<div class="site-index pt-3">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $totalOrder ?></h3>

                    <p><?= Yii::t('app','In-process Orders') ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <a href="<?= \yii\helpers\Url::toRoute('order/') ?>" class="small-box-footer" target="_blank"><?= Yii::t('app', 'More info') ?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $totalActiveUsers ?></h3>

                    <p><?= Yii::t('app', 'Active Users') ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="<?= (Yii::$app->user->identity->getRole() == 1) ? \yii\helpers\Url::toRoute('user/') : '#' ?>"
                   class="small-box-footer" target="_blank"><?= Yii::t('app', 'More info') ?> <i
                            class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- Product & Order -->
    <div class="row">
        <div class="col-md-8">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title"><?= Yii::t('app', 'Latest Orders') ?></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th><?= Yii::t('app', 'Product') ?></th>
                                <th><?= Yii::t('app', 'Status') ?></th>
                                <th><?= Yii::t('app', 'Address') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orders as $key => $orderDetail) : ?>
                                <tr>
                                    <td>
                                        <a href="<?= \yii\helpers\Url::toRoute(['order/view', 'id' => \common\components\encrypt\CryptHelper::encryptString($orderDetail['id'])]) ?>"
                                           target="_blank">DO<?= $orderDetail['id'] ?></a>
                                    </td>
                                    <td><?= $orderDetail['product_name'] ?></td>
                                    <td>
                                        <span class="badge <?= $statusBG[$orderDetail['status'] - 1] ?>"><?= Yii::t('app', $orderDetail['status_name']) ?></span>
                                    </td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                            <?= $orderDetail['address'] ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="<?= \yii\helpers\Url::toRoute('order/create') ?>" class="btn btn-sm btn-info float-left"
                       target="_blank"><?= Yii::t('app', 'Place New Order') ?></a>
                    <a href="<?= \yii\helpers\Url::toRoute('order/') ?>" class="btn btn-sm btn-secondary float-right"
                       target="_blank"><?= Yii::t('app', 'View All Orders') ?></a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
        <div class="col-md-4">
            <!-- PRODUCT LIST -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= Yii::t('app', 'Recently Added Products') ?></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        <?php foreach ($products as $key => $value): ?>
                            <li class="item">
                                <div class="product-img">
                                    <img src="<?= $imgUrl . '/' . $value['image'] ?>" alt="<?= $value['name'] ?>"
                                         class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title"><?= $value['name'] ?>
                                        <span class="badge badge-warning float-right"><?= Yii::$app->formatter->asCurrency($value['cost_price']) ?></span></a>
                                    <span class="product-description"><?= strip_tags($value['description']) ?></span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="<?= \yii\helpers\Url::toRoute('product/') ?>"
                       class="uppercase"><?= Yii::t('app', 'View All Products') ?></a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>
    <!-- End Product & Order -->
</div>
