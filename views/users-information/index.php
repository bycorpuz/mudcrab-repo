<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;

use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\growl\Growl;
use kartik\widgets\Select2;

use app\models\BaseModel;
use app\models\UsersInformation;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Information';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php foreach (Yii::$app->session->getAllFlashes() as $msg):; ?>
    <?php
    Growl::widget([
        'type' => (!empty($msg['type'])) ? $msg['type'] : 'danger',
        'title' => (!empty($msg['title'])) ? Html::encode($msg['title']) : 'Title Not Set!',
        'icon' => (!empty($msg['icon'])) ? $msg['icon'] : 'fa fa-info',
        'body' => (!empty($msg['message'])) ? Html::encode($msg['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 3, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($msg['duration'])) ? $msg['duration'] : 1500, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($msg['positionY'])) ? $msg['positionY'] : 'top',
                'align' => (!empty($msg['positionX'])) ? $msg['positionX'] : 'right',
            ]
        ],
        'useAnimation'=>true
    ]);
    ?>
<?php endforeach; ?>

<div class="users-information-index">
    <section class="content">
        <div class="row">
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add New Employee</h3>
                </div>
                <div class="box-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
              </div>
            </div>

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Employee Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <?php
                            $gridcolumns = [
                                [
                                    'class' => 'kartik\grid\SerialColumn',
                                    'width' => '10px;',
                                    'vAlign' => 'left'
                                ],
                                [
                                    'label'=>'First Name',
                                    'attribute'=>'firstName',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'firstName', 'firstName'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select First Name'],
                                    'value'=>function($model){
                                        if ($model->firstName == '' || $model->firstName == NULL){
                                            return '-';
                                        } else {
                                            return $model->firstName;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Middle Name',
                                    'attribute'=>'middleName',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'middleName', 'middleName'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Middle Name'],
                                    'value'=>function($model){
                                        if ($model->middleName == '' || $model->middleName == NULL){
                                            return '-';
                                        } else {
                                            return $model->middleName;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Last Name',
                                    'attribute'=>'lastName',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'lastName', 'lastName'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Last Name'],
                                    'value'=>function($model){
                                        if ($model->lastName == '' || $model->lastName == NULL){
                                            return '-';
                                        } else {
                                            return $model->lastName;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Extension Name',
                                    'attribute'=>'ext_name',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'ext_name', 'ext_name'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Extension Name'],
                                    'value'=>function($model){
                                        if ($model->ext_name == '' || $model->ext_name == NULL){
                                            return '-';
                                        } else {
                                            return $model->ext_name;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Sex',
                                    'attribute'=>'sex',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'sex', 'sex'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Sex'],
                                    'value'=>function($model){
                                        if ($model->sex == '' || $model->sex == NULL){
                                            return '-';
                                        } else {
                                            return $model->sex;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Contact #',
                                    'attribute'=>'c_num',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'c_num', 'c_num'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Contact #'],
                                    'value'=>function($model){
                                        if ($model->c_num == '' || $model->c_num == NULL){
                                            return '-';
                                        } else {
                                            return $model->c_num;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Birth Date',
                                    'attribute'=>'bday',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'bday', 'bday'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Birth Date'],
                                    'value'=>function($model){
                                        if ($model->bday == '' || $model->bday == NULL){
                                            return '-';
                                        } else {
                                            return $model->bday;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Address',
                                    'attribute'=>'address',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'address', 'address'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Address'],
                                    'value'=>function($model){
                                        if ($model->address == '' || $model->address == NULL){
                                            return '-';
                                        } else {
                                            return $model->address;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'TIN',
                                    'attribute'=>'tin',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'tin', 'tin'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select TIN'],
                                    'value'=>function($model){
                                        if ($model->tin == '' || $model->tin == NULL){
                                            return '-';
                                        } else {
                                            return $model->tin;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Account Name',
                                    'attribute'=>'account_name',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'account_name', 'account_name'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Account Name'],
                                    'value'=>function($model){
                                        if ($model->account_name == '' || $model->account_name == NULL){
                                            return '-';
                                        } else {
                                            return $model->account_name;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Account Number',
                                    'attribute'=>'account_number',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'account_number', 'account_number'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Account Number'],
                                    'value'=>function($model){
                                        if ($model->account_number == '' || $model->account_number == NULL){
                                            return '-';
                                        } else {
                                            return $model->account_number;
                                        }
                                    },
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Position Name',
                                    'attribute'=>'position',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users.position')->where(['!=','user_id',1])->asArray()->all(), 'users.position.id', 'users.position.name'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Position'],
                                    'value'=>'users.position.name',
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Position Description',
                                    'value'=>'users.position.description',
                                    'width' => '150px;'
                                ],
                                [
                                    'label'=>'Salary Type',
                                    'attribute'=>'salary',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users.salary')->where(['!=','user_id',1])->asArray()->all(), 'users.salary.id', 'users.salary.description'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Salary'],
                                    'value'=>'users.salary.description',
                                    'width' => '150px;',
                                    'pageSummary' => 'Total',
                                ],
                                [
                                    'label'=>'Salary Amount',
                                    'value'=>'users.salary.amount',
                                    'width' => '150px;',
                                    'format' => ['decimal', 2],
                                    'pageSummary' => true,
                                ],
                                [
                                    'label'=>'Username',
                                    'attribute'=>'username',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'users.username', 'users.username'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Username'],
                                    'value'=>'users.username',
                                    'width' => '150px;',
                                    'format' => 'raw',
                                    'value' => function($model){
                                        if (Yii::$app->user->can('_CHANGE-DEFAULT-PASSWORD-USER')){
                                            return "<a style='cursor:pointer' onclick='changePassword($model->user_id)' , data-placement='left', data-toggle='tooltip', title='Change Password'>". $model->users->username ."</a>";
                                          } else {
                                            return "<a>". $model->users->username ."</a>";
                                          }
                                    }
                                ],
                                [
                                    'label'=>'Email',
                                    'attribute'=>'email',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter'=>ArrayHelper::map(UsersInformation::find()->joinWith('users')->where(['!=','user_id',1])->asArray()->all(), 'users.email', 'users.email'), 
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Email'],
                                    'value'=>'users.email',
                                    'width' => '150px;'
                                ],
                                [
                                    'attribute' => 'status',
                                    'filterType'=>GridView::FILTER_SELECT2,
                                    'filter' => ['10' => 'Active', '0' => 'Inactive'],
                                    'filterWidgetOptions'=>[
                                        'pluginOptions'=>[
                                            'allowClear'=>true,
                                        ],
                                        'theme' => Select2::THEME_DEFAULT,
                                    ],
                                    'filterInputOptions'=>['placeholder'=>'Select Status'],
                                    'label'=>'Status',
                                    'format' => 'raw',
                                    'value' => function($model) {
                                        if ($model->users->status == 10){
                                            $status = 10;

                                            $a = array(1);
                                            if (in_array($model->users->id, $a, true)){
                                              return "<a class='user user-user'></a>";
                                            } else {
                                              if (Yii::$app->user->can('_ACTIVATE-USER')){
                                                return "<a style='cursor:pointer' class='fa fa-check btn btn-success btn-xs btn-flat' onclick='changeStatusActive($model->user_id,$status)' , data-placement='left', data-toggle='tooltip', title='Dectivate'></a>";
                                              } else {
                                                return "<a style='color:green' class='fa fa-check'></a>";
                                              }
                                            }
                                        } else {
                                            $status = 0;
                                            if (Yii::$app->user->can('_DEACTIVATE-USER')){
                                              return "<a style='cursor:pointer' class='fa fa-remove btn btn-danger btn-xs btn-flat' onclick='changeStatusInactive($model->user_id,$status)'  , data-placement='left', data-toggle='tooltip', title='Activate'></a>";
                                            } else {
                                              return "<a style='color:red' class='fa fa-remove'></a>";
                                            }
                                        }
                                    },
                                    'width' => '150px;',
                                    'hAlign'=>'center',
                                    'vAlign'=>'middle',
                                ],
                                [
                                  'class' => 'kartik\grid\ActionColumn',
                                  'template' => '{update}',
                                  'hAlign'=>'center',
                                  'vAlign'=>'middle',
                                  'buttons' => [
                                      //view button
                                      'view' => function ($url, $model) {
                                          $t = 'view?id='.$model->user_id;
                                          return ' ' . Html::button('<span class="fa fa-eye"></span>', ['value'=>Url::to($t), 'class' =>'btn btn-flat btn-info btn-xs modalButtonview', 'data-placement'=>'top', 'data-toggle'=>'tooltip', 'title'=>'View']);
                                      },
                                      //update button
                                      'update' => function ($url, $model) {
                                          if(Yii::$app->user->can('_EDIT-USER')){
                                              /*$t = 'update?id='.$model->user_id;
                                              return ' ' . Html::button('<span class="fa fa-pencil-square-o"></span>', ['value'=>Url::to($t), 'class' =>'btn btn-flat btn-primary btn-xs modalButtonedit', 'data-placement'=>'top', 'data-toggle'=>'tooltip', 'title'=>'Edit'])
                                              ;*/
                                              $t = '/mudcrab/users/useraccount?id='.$model->user_id;
                                              return ' ' . Html::button('<span class="fa fa-pencil-square-o"></span>', ['value'=>Url::to($t), 'class' =>'btn btn-flat btn-primary btn-xs modalButtoneditprofile', 'data-placement'=>'top', 'data-toggle'=>'tooltip', 'title'=>'Edit']);
                                          }
                                      },
                                      //delete button
                                      'delete' => function ($url, $model) {
                                          if(Yii::$app->user->can('_DELETE-USER')){
                                              return ' ' . Html::a('<span class="fa fa-trash-o"></span>', ['delete', 'id'=>$model->user_id], [
                                                  'class' => 'btn btn-flat btn-danger btn-xs',
                                                  'data' => [
                                                      'confirm' => "Are you sure to delete this item?",
                                                      'method' => 'post',
                                                  ], 
                                                  'data-placement'=>'top', 'data-toggle'=>'tooltip', 'title'=>'Delete'
                                              ])
                                              ;
                                          }
                                      },
                                  ],
                                  'width' => '50px;'
                              ],
                            ];

                            if(Yii::$app->user->can('_ACTIVATE-MULTIPLE-USER')){
                              $gridcolumns[] = [
                                'class' => 'kartik\grid\CheckboxColumn',
                                'width' => '50px;',
                              ]; 
                            }

                            $headercols = [
                                ['content' => 'Employee Information', 'options' => ['colspan' => 100, 'class' => 'text-center bg-primary']],
                            ];

                            $heading = 'List of Employee Information';

                            $export = ExportMenu::widget([
                                'dataProvider' => $dataProvider,
                                'columns' => $gridcolumns,
                                'target' => ExportMenu::TARGET_BLANK,
                                'fontAwesome' => true,
                                'pjaxContainerId' => 'usersinformation',
                                'enableFormatter' => true,
                                'showColumnSelector' => true,
                                'dropdownOptions' => [
                                    'label' => 'Export All',
                                    'class' => 'btn btn-default btn-flat',
                                    'itemsBefore' => [
                                        '<li class="dropdown-header">Export All Data</li>',
                                    ],
                                ],
                                'filename' => 'usersinformation',
                            ]);

                            if(Yii::$app->user->can('_ACTIVATE-MULTIPLE-USER')){
                              $after = '<div class="pull-right">
                              <button type="button" class="btn btn-flat btn-warning changeSelectedPasswordbutton" data-placement="left" data-toggle="tooltip", title="Change Password">Change Password Selected</button>
                              <button type="button" class="btn btn-flat btn-danger deleteSelectedactivationbutton" data-placement="bottom" data-toggle="tooltip", title="Activate/ Deactivate">Activate/ Deactivate Selected</button>
                              </div><div style="padding-top: 5px;">
                              <em>&nbsp;</em>
                              </div>
                              <div class="clearfix"></div>';
                            } else {
                              $after = '';
                            }

                            if(Yii::$app->user->can('_VIEW-LOGS')){
                              $logs = Html::button('<i class=""></i> Logs', ['class' =>'btn btn-flat btn-default modalButtonlogs', 'data-placement'=>'bottom', 'data-toggle'=>'tooltip', 'title'=>'Show Logs']);

                            } else {
                              $logs = '';
                            }
                        ?>
                        <?=
                          GridView::widget([
                              'dataProvider' => $dataProvider,
                              'filterModel' => $searchModel,
                              'columns' => $gridcolumns,

                              'floatHeader'=>true,
                              'floatHeaderOptions'=>[
                                  'top'=>'0',
                                  'position'=>'absolute',
                              ],
                              'resizableColumns'=>true,
                              'beforeHeader' => [
                                  [
                                      'columns' => $headercols,
                                  ]
                              ],
                              'rowOptions' => function($model) {
                                    if($model->users->status == 0){
                                        return ['class' => 'warning', 'style'=>'font-weight:bold;'];
                                    }else{
                                        return ['class'=>'success'];
                                    }
                               },
                              'options' => ['id' => 'usersinformation'],
                              'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                              'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                              'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                              'pjax' => true, // pjax is set to always true for this demo
                              'pjaxSettings' =>[
                                  'neverTimeout'=>true,
                                  'options'=>[
                                          'id'=>'kv-unique-id-1',
                                      ]
                                  ],
                              // set your toolbar
                              'toolbar' => [
                                  ['content' =>
                                      Html::a('<i class="fa fa-repeat"></i>', ['index'], ['data-pjax' => 1, 'class' => 'btn btn-flat btn-default', 'title' => 'Reset Grid']) . $export . '{toggleData}' . $logs,
                                  ],
                                  //'{export}',
                                  //'{toggleData}',
                              ],
                              // set export properties
                              'export' => [
                                  'fontAwesome' => true
                              ],
                              // parameters from the demo form
                              'bordered' => true,
                              'striped' => true,
                              'condensed' => true,
                              'responsive' => true,
                              'hover' => true,
                              'showPageSummary' => false,
                              'panel' => [
                                  'type' => GridView::TYPE_PRIMARY,
                                  'heading' => $heading,
                                  'after'=>$after,
                              ],
                              'persistResize' => false,
                              'exportConfig' => true,
                          ]);
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
    Modal::begin(
            [
                //'header' => '<h2>Create New Region</h2>',
                'id' => 'modalcreate',
                'size' => 'modal-md',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE , 'class'=>'modal modal-primary'],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]
    );
        echo "<div class='box box-success' id='modalContent'></div>";
        Modal::end();
?>


<?php
    Modal::begin(
            [
                //'header' => '<h2>Edit Region</h2>',
                'id' => 'modaledit',
                'size' => 'modal-md',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]
    );
    echo "<div class='box box-primary' id='modalContent'></div>";
    Modal::end();
?>

<?php
    Modal::begin(
            [
                //'header' => '<h2>Region</h2>',
                'id' => 'modalview',
                'size' => 'modal-md',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]
    );
    echo "<div class='box box-info' id='modalContent'></div>";
    Modal::end();
?>

<?php
    Modal::begin([
        //'header' => '<h2>Events</h2>',
        'id' => 'modal',
        'size'=>'modal-lg',
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE, 'class'=>'modal modal-primary'],
        'options' => [
            'tabindex' => false // important for Select2 to work properly
        ],
    ]);

    echo "<div class='box box-primary' id='modalContent'></div>";
    Modal::end();
?>

<?php
$js = "
$(document).on('click','.modalButtonlogs', function(){        
    $.get('logs',{},function(data){

        var clear_datatable = $('#table_datails').DataTable();
        clear_datatable.clear();
        $('#modal').modal('show').find('#modalContent').html(data);
        
        $('#table_datails').DataTable({
             'processing': true,
             'dom': 'lBfrtip',
             'order': [[ 0, 'desc' ]],
             'columnDefs': [
                {
                    'targets': [ 0 ],
                    'visible': true,
                    'searchable': false
                },
             ],
             'buttons': [
                {
                    extend: 'collection',
                    text: 'Export to...',
                    buttons: [
                        'copy',
                        'excel',
                        'csv',
                        'pdf',
                        'print'
                    ]
                }
            ]
        });
    });
});

";
$this->registerJs($js, $this::POS_END);
?>