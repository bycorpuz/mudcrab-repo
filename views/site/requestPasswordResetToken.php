<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\PasswordResetRequestForm */

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

$this->title = Yii::t('app', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;

$emailOptions = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
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
        <p class="login-box-msg">Please fill out your email. A link to reset password will be sent there.</p>
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    
                    <?= $form
                        ->field($model, 'email', $emailOptions)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('email')]) 
                    ?>

                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-4">
                            <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'reset-button']) ?>
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <!-- < ?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            < ?= $form->field($model, 'email')->input('email', 
                ['placeholder' => Yii::t('app', 'Please fill out your email.'), 'autofocus' => true]) ?>

            <div class="form-group">
                < ?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary']) ?>
            </div>

        < ?php ActiveForm::end(); ?> -->

    </div>
</div>
