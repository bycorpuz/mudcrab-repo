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
use app\models\Salary;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salary';
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

<div class="salary-index">
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Salary</h3>
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
              <div class="box-header">
                <h3 class="box-title">Salary Information</h3>
              </div>
              <div class="box-body">
                <?php
                  $gridcolumns = [
                        [
                            'class' => 'kartik\grid\SerialColumn',
                            'width' => '10px;',
                            'vAlign' => 'left'
                        ],
                        [
                            'label'=>'Name',
                            'attribute'=>'name',
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(Salary::find()->asArray()->all(), 'name', 'name'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>[
                                    'allowClear'=>true,
                                ],
                                'theme' => Select2::THEME_DEFAULT,
                            ],
                            'filterInputOptions'=>['placeholder'=>'Select Salary Name'],
                            'value'=>function($model){
                                if ($model->name == '' || $model->name == NULL){
                                    return '-';
                                } else {
                                    return $model->name;
                                }
                            },
                            'width' => '150px;'
                        ],
                        [
                            'label'=>'Description',
                            'attribute'=>'description',
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(Salary::find()->asArray()->all(), 'description', 'description'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>[
                                    'allowClear'=>true,
                                ],
                                'theme' => Select2::THEME_DEFAULT,
                            ],
                            'filterInputOptions'=>['placeholder'=>'Select Salary Description'],
                            'value'=>function($model){
                                if ($model->description == '' || $model->description == NULL){
                                    return '-';
                                } else {
                                    return $model->description;
                                }
                            },
                            'width' => '150px;'
                        ],
                        [
                            'label'=>'Grade',
                            'attribute'=>'sg',
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(Salary::find()->asArray()->all(), 'sg', 'sg'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>[
                                    'allowClear'=>true,
                                ],
                                'theme' => Select2::THEME_DEFAULT,
                            ],
                            'filterInputOptions'=>['placeholder'=>'Select Salary Grade'],
                            'value'=>function($model){
                                if ($model->sg == '' || $model->sg == NULL){
                                    return '-';
                                } else {
                                    return $model->sg;
                                }
                            },
                            'width' => '150px;',
                        ],
                        [
                            'label'=>'Amount',
                            'attribute'=>'amount',
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(Salary::find()->asArray()->all(), 'amount', 'amount'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>[
                                    'allowClear'=>true,
                                ],
                                'theme' => Select2::THEME_DEFAULT,
                            ],
                            'filterInputOptions'=>['placeholder'=>'Select Salary Amount'],
                            'value'=>function($model){
                                if ($model->amount == '' || $model->amount == NULL){
                                    return '-';
                                } else {
                                    return $model->amount;
                                }
                            },
                            'width' => '150px;',
                            'format' => ['decimal', 2],
                        ],
                        [
                          'class' => 'kartik\grid\ActionColumn',
                          'template' => '{update}{delete}',
                          'hAlign'=>'center',
                          'vAlign'=>'middle',
                          'buttons' => [
                              //view button
                              'view' => function ($url, $model) {
                                  $t = 'view?id='.$model->id;
                                  return ' ' . Html::button('<span class="fa fa-eye"></span>', ['value'=>Url::to($t), 'class' =>'btn btn-flat btn-info btn-xs modalButtonview', 'data-placement'=>'top', 'data-toggle'=>'tooltip', 'title'=>'View']);
                              },
                              //update button
                              'update' => function ($url, $model) {
                                  if(Yii::$app->user->can('_EDIT-SALARY')){
                                      $t = 'update?id='.$model->id;
                                      return ' ' . Html::button('<span class="fa fa-pencil-square-o"></span>', ['value'=>Url::to($t), 'class' =>'btn btn-flat btn-primary btn-xs modalButtonedit', 'data-placement'=>'top', 'data-toggle'=>'tooltip', 'title'=>'Edit'])
                                      ;
                                  }
                              },
                              //delete button
                              'delete' => function ($url, $model) {
                                  if(Yii::$app->user->can('_DELETE-SALARY')){
                                      return ' ' . Html::a('<span class="fa fa-trash-o"></span>', ['delete', 'id'=>$model->id], [
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

                  if(Yii::$app->user->can('_DELETE-MULTIPLE-SALARY')){
                    $gridcolumns[] = [
                      'class' => 'kartik\grid\CheckboxColumn',
                      'visible' => (Yii::$app->user->can('_DELETE-MULTIPLE-SALARY')),
                      'width' => '50px;'
                    ]; 
                  }

                  $headercols = [
                      ['content' => 'Salary Information', 'options' => ['colspan' => 100, 'class' => 'text-center bg-primary']],
                  ];

                  $heading = 'List of Salary';

                  $export = ExportMenu::widget([
                      'dataProvider' => $dataProvider,
                      'columns' => $gridcolumns,
                      'target' => ExportMenu::TARGET_BLANK,
                      'fontAwesome' => true,
                      'pjaxContainerId' => 'salary',
                      'enableFormatter' => true,
                      'showColumnSelector' => true,
                      'dropdownOptions' => [
                          'label' => 'Export All',
                          'class' => 'btn btn-default btn-flat',
                          'itemsBefore' => [
                              '<li class="dropdown-header">Export All Data</li>',
                          ],
                      ],
                      'filename' => 'salary',
                  ]);

                  if(Yii::$app->user->can('_DELETE-MULTIPLE-SALARY')){
                    $after = '<div class="pull-right">
                    <button type="button" class="btn btn-flat btn-danger deleteSelectedSalarybutton" data-placement="left" data-toggle="tooltip", title="Delete Selected">Delete Selected</button></div><div style="padding-top: 5px;">
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
                            if($model->flag == 0){
                                return ['class' => 'warning', 'style'=>'font-weight:bold;'];
                            }else{
                                return ['class'=>'info'];
                            }
                       },
                      'options' => ['id' => 'salary'],
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

$('body').on('click', '.deleteSelectedSalarybutton', function(){
    var deleteSelected = $('#salary').yiiGridView('getSelectedRows');
    if (deleteSelected == ''){
        swal('Error', 'No selected record!', 'error');
    }
    else {
        swal({
          title: 'Are you sure?',
          text: 'The selected salary will be deleted.',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, I agree!',
          closeOnConfirm: false
        },
        function(){
            $.ajax({
                type: 'POST',
                url : 'deletemultiple',
                data : {row_id: deleteSelected},
                success : function() {
                    $.pjax.reload({container:'#kv-unique-id-1'});
                    swal('Success!', 'Selected Salary Successfully Deleted.', 'success');
                },
                error: function () {
                    swal('Error', 'Selected Salary Not Deleted.', 'error');
                }
            });
        });
    }
});

";
$this->registerJs($js, $this::POS_END);
?>