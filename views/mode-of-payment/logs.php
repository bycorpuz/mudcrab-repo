<?php

use yii\helpers\Html;

use app\models\BaseModel;

/* @var $this yii\web\View */
/* @var $model frontend\models\logs\NFT */

$this->title = 'Mode of Payment Logs';
?>
<div class="logs-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <br>

    <div class='table-responsive'>
        <table class="display dataTable no-footer" id="table_datails" cellspacing='0' width='100%'>
            <thead>
                <tr>
                    <th style='vertical-align: middle;'> # </th>
                    <th style='vertical-align: middle;'> Action </th>
                    <th style='vertical-align: middle;'> By</th>
                    <th style='vertical-align: middle;'> Date </th>
                </tr>
            </thead>

        <?php
            $string = '<tbody>';
            foreach ($model as $key => $value){
                $string .= "<tr>"                      
                    ."<td>" . $value->id . "</td>"
                    ."<td>" . str_replace('\n', '<br/>', $value->action) . "</td>"
                    ."<td>" . BaseModel::getuserFullName1($value->user_id_log) . "</td>"
                    ."<td>" . date_format(date_create($value->date),'F d, Y h:i:s A') . "</td>"
                ."</tr>";
            }
            $string .= '</tbody>';
            echo $string;
        ?>
        </table>
    </div>

</div>