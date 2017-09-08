<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$this->title = 'User Access';
$this->params['breadcrumbs'][] = ['label' => 'User Access', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-view">

    <!-- <h1>< ?= Html::encode($this->title) ?></h1>

    <p>
        < ?= Html::a('Update', ['update', 'id' => $model->id, 'item_name' => $model->item_name, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        < ?= Html::a('Delete', ['delete', 'id' => $model->id, 'item_name' => $model->item_name, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <h3><?= Html::encode($this->title) ?></h3>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'User Name',
                'attribute' => 'user_id',
                'value' => $model->userinfo->lastName . ', ' . $model->userinfo->firstName . ' ' . substr($model->userinfo->middleName, 0,1) . '.',
            ],
            [
                'label' => 'Access',
                'attribute' => 'item_name',
                'value' => $model->item_name,
            ],
            [
                'label' => 'Created on',
                'attribute' => 'created_at',
                'value' => date("Y-m-d H:i:s", $model->created_at),
            ]
            
        ],
    ]) ?>

</div>
