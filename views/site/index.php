
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\growl\Growl;

$this->title = 'Mud Crab Inventory Management System';
?>

<?php foreach (Yii::$app->session->getAllFlashes() as $msg):; ?>
    <?php
    Growl::widget([
        'type' => (!empty($msg['type'])) ? $msg['type'] : 'danger',
        'title' => (!empty($msg['title'])) ? Html::encode($msg['title']) : 'Title Not Set!',
        'icon' => (!empty($msg['icon'])) ? $msg['icon'] : 'fa fa-info',
        'body' => (!empty($msg['message'])) ? Html::encode($msg['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 5, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($msg['duration'])) ? $msg['duration'] : 5000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($msg['positionY'])) ? $msg['positionY'] : 'top',
                'align' => (!empty($msg['positionX'])) ? $msg['positionX'] : 'right',
            ]
        ],
        'useAnimation'=>true
    ]);
    ?>
<?php endforeach; ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary table-responsive">
                <div class="box-header">
                  <h3 class="box-title">NCDDP 2017 Sub Projects</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-9 col-sm-8">
                      <div class="pad">
                        <div id="container-sp" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-4">
                      <div class="pad box-pane-right bg-default" style="min-height: 420px">
                        <div id="container-sp2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    Highcharts.setOptions({
        credits: {
            enabled: false
        },
        lang: {
            decimalPoint: '.',
            thousandsSep: ',',
        }
    });

    Highcharts.chart('container-sp', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'NCDDP 2017 Sub Projects'
        },
        subtitle: {
            text: 'as of ' + '<?php $today = date("l F j, Y - g:i a"); echo $today; ?>'
        },
        xAxis: {
             categories: ['AGUSAN DEL NORTE', 'AGUSAN DEL SUR', 'SURIGAO DEL NORTE', 'SURIGAO DEL SUR', 'DINAGAT ISLANDS'],
            tickmarkPlacement: 'on',
            title: {
                text: 'Provinces'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Sub Project, Grant & Total LCC'
            },
            min: 0
        },
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },
         plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },
        series: [
            {
                name: 'No. of SP',
                data: [3, 6, 9, 12, 15]
            }, 
            {
                name: 'GRANT',
                data: [1000000, 2000000, 3000000, 4000000, 5000000]
            }, 
            {
                name: 'LCC (Cash & In-Kind)',
                data: [2000000, 4000000, 6000000, 7000000, 10000000]
            }, 
        ]
    });

    Highcharts.chart('container-sp2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'NCDDP 2017 Sub Projects'
        },
        subtitle: {
            text: 'as of ' + '<?php $today = date("l F j, Y - g:i a"); echo $today; ?>'
        },
        xAxis: {
             categories: ['CARAGA'],
            tickmarkPlacement: 'on',
            title: {
                text: 'Region'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Sub Project, Grant & Total LCC'
            },
            min: 0
        },
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },
         plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },
        series: [
            {
                name: 'No. of SP',
                data: [326]
            }, 
            {
                name: 'GRANT',
                data: [1000000]
            }, 
            {
                name: 'LCC (Cash & In-Kind)',
                data: [2000000]
            }, 
        ]
    });
</script>