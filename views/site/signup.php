<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */

use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\Configuration;

$companyName = Configuration::find()->all();
foreach ($companyName as $name => $value) {
    $company_name = $value->companyName;
    $company_site_name = $value->siteName;
    $company_description = $value->description;
    $company_logo = $value->logo;
    $company_favicon = $value->favicon;
}

$usernameOptions = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];
$emailOptions = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
$passwordOptions = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
$password_hash2Options = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-repeat form-control-feedback'></span>"
];
?>
<div class="login-box">
    <div class="login-logo">
        <a href=<?= Yii::$app->request->baseUrl . '/login' ?> >
            <?php
                $name = explode(" ", $company_site_name);
                echo '<b style="font-size:32px;">' . $name[0] . ' ' . $name[1] . ' ' . $name[2] . '</b>';
                echo '<br>';
                echo '<span style="font-size:18px;">' . $name[3] . ' ' . $name[4] . ' ' . $name[5] . ' ' . $name[6] . ' ' . $name[7] . '</span>';
            ?>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?= Yii::t('app', 'Please fill out the following fields to signup:') ?></p>
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form
                        ->field($model, 'username', $usernameOptions)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('username'), 'autofocus' => true]) 
                    ?>

                    <?= $form
                        ->field($model, 'email', $emailOptions)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('email')]) 
                    ?>

                    <!-- < ?= $form->field($model, 'password_hash')->widget(PasswordInput::classname(), 
                        ['options' => ['placeholder' => Yii::t('app', 'Create your password_hash')]]) ?> -->

                    <?= $form
                        ->field($model, 'password_hash', $passwordOptions)
                        ->label(false)
                        ->textInput(['type' => 'password', 'placeholder' => $model->getAttributeLabel('password_hash')]) 
                    ?>
                    <?= $form
                        ->field($model, 'password_hash2', $password_hash2Options)
                        ->label(false)
                        ->textInput(['type' => 'password', 'placeholder' => $model->getAttributeLabel('password_hash2')]) 
                    ?>

                    <div class="row">
                        <div class="col-xs-8">
                            <a href= <?= Yii::$app->request->baseUrl . '/login' ?> > I already have an account!</a>
                        </div>
                        <div class="col-xs-4">
                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'signup-button']) ?>
                        </div>
                    </div> 

                <?php ActiveForm::end(); ?>

                <?php if ($model->scenario === 'rna'): ?>
                    <div style="color:#666;margin:1em 0">
                        <i>*<?= Yii::t('app', 'We will send you an email with account activation link.') ?></i>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>