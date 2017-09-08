<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionLabor */

$this->title = 'Update Direct Labor: ' . $model->or_number;
$this->params['breadcrumbs'][] = ['label' => 'Transaction Direct Labors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-direct-labor-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <br>

    <?= $this->render('_updateForm', [
        'model' => $model,
    ]) ?>

</div>
