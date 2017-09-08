<?php

use app\models\BaseModel;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->request->baseUrl.Yii::$app->user->identity->profile_pic ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= BaseModel::getUserFullName(Yii::$app->user->identity->id) ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?php
            if (Yii::$app->user->can('_CREATE-USER') || Yii::$app->user->can('_CREATE-ACCESS') || Yii::$app->user->can('_CREATE-POSITION') || Yii::$app->user->can('_CREATE-SALARY')  || Yii::$app->user->can('_CREATE-ACCOUNT-TITLE')){
                $configuration =  ['label' => 'CONFIGURATION', 'options' => ['class' => 'header']];
            } else {
                $configuration = '';
            }

            if (Yii::$app->user->can('_CREATE-USER') || Yii::$app->user->can('_CREATE-ACCESS')){
                $user =  [
                            'label' => 'Employee', 'icon' => 'users', 'url' => '#',
                            'items' => [
                                ['label' => 'Information', 'icon' => 'info', 'url' => ['/users-information/index'], 'visible'=>Yii::$app->user->can('_CREATE-USER')],
                                
                                ['label' => 'Access', 'icon' => 'code-fork', 'url' => ['/auth-assignment/index'], 'visible'=>Yii::$app->user->can('_CREATE-ACCESS')],
                            ],
                        ];
            } else {
                $user = '';
            }

            if (Yii::$app->user->can('_CREATE-DIRECT-MATERIALS') || Yii::$app->user->can('_CREATE-DIRECT-LABOR') || Yii::$app->user->can('_CREATE-PRODUCTION-OVERHEAD')){
                $transaction =  ['label' => 'TRANSACTION', 'options' => ['class' => 'header']];
            } else {
                $transaction = '';
            }

            if (Yii::$app->user->can('_CREATE-DIRECT-MATERIALS') || Yii::$app->user->can('_CREATE-DIRECT-LABOR') || Yii::$app->user->can('_CREATE-PRODUCTION-OVERHEAD')){
                $expense = [
                            'label' => 'Expenses', 'icon' => 'credit-card', 'url' => '#',
                            'items' => [
                                ['label' => 'Direct Materials', 'icon' => 'circle-o', 'url' => ['/transaction-direct-materials/index'], 'visible'=>Yii::$app->user->can('_CREATE-DIRECT-MATERIALS')],

                                ['label' => 'Direct Labor', 'icon' => 'circle-o', 'url' => ['/transaction-direct-labor/index'], 'visible'=>Yii::$app->user->can('_CREATE-DIRECT-LABOR')],

                                ['label' => 'Production Overhead', 'icon' => 'circle-o', 'url' => ['/transaction-production-overhead/index'], 'visible'=>Yii::$app->user->can('_CREATE-PRODUCTION-OVERHEAD')],
                            ],
                        ];
            } else {
                $expense = '';
            }
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'NAVIGATIONAL MENU', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['site/index']],

                    $transaction,
                    
                        $expense,

                    $configuration,

                        ['label' => 'Item', 'icon' => 'bolt', 'url' => ['item/index'], 'visible'=>Yii::$app->user->can('_CREATE-ITEM')],

                        ['label' => 'Unit', 'icon' => 'clone', 'url' => ['unit/index'], 'visible'=>Yii::$app->user->can('_CREATE-UNIT')],

                        ['label' => 'Mode of Payment', 'icon' => 'money', 'url' => ['mode-of-payment/index'], 'visible'=>Yii::$app->user->can('_CREATE-MODE-OF-PAYMENT')],

                        ['label' => 'Account Title', 'icon' => 'book', 'url' => ['account-title/index'], 'visible'=>Yii::$app->user->can('_CREATE-ACCOUNT-TITLE')],

                        ['label' => 'Position', 'icon' => 'map-marker', 'url' => ['position/index'], 'visible'=>Yii::$app->user->can('_CREATE-POSITION')],

                        ['label' => 'Salary', 'icon' => 'rub', 'url' => ['salary/index'], 'visible'=>Yii::$app->user->can('_CREATE-SALARY')],

                        ['label' => 'Supplier', 'icon' => 'truck', 'url' => ['supplier/index'], 'visible'=>Yii::$app->user->can('_CREATE-SUPPLIER')],

                        $user,
                ],
            ]
        ) ?>

    </section>

</aside>
