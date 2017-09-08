<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$this->title = 'Update User Access';
$this->params['breadcrumbs'][] = ['label' => 'User Access', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-assignment-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <br>


    <?= $this->render('_updateForm', [
        'model' => $model,
    ]) ?>

</div>
