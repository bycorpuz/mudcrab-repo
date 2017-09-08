<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mode of Payment */

$this->title = 'Update Mode of Payment';
$this->params['breadcrumbs'][] = ['label' => 'Mode of Payment', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modeofpayment-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <br>

    <?= $this->render('_updateForm', [
        'model' => $model,
    ]) ?>

</div>
