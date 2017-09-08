<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountTitle */

$this->title = 'Create Account Title';
$this->params['breadcrumbs'][] = ['label' => 'Account Titles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-title-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
