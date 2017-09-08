<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModeOfPayment */

$this->title = 'Create Mode of Payment';
$this->params['breadcrumbs'][] = ['label' => 'Mode of Payment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modeofpayment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
