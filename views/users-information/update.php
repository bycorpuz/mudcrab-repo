<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersInformation */

$this->title = 'Update User Information';
$this->params['breadcrumbs'][] = ['label' => 'Users Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-information-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <br>

    <?= $this->render('_updateForm', [
        'model' => $model,
    ]) ?>

</div>
