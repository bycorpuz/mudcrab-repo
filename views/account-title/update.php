<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccountTitle */

$this->title = 'Update Account Title';
$this->params['breadcrumbs'][] = ['label' => 'Account Titles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-title-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <br>

    <?= $this->render('_updateForm', [
        'model' => $model,
    ]) ?>

</div>
