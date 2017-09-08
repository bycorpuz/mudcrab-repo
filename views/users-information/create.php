<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersInformation */

$this->title = 'Create Users Information';
$this->params['breadcrumbs'][] = ['label' => 'Users Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-information-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
