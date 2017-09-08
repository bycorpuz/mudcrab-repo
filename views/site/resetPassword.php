<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\ResetPasswordForm */

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

$emailOptions = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
    <!-- <h1>< ?= Html::encode($this->title) ?></h1> -->

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
        <div class="login-box-body">
            <p><?= Yii::t('app', 'Please choose your new password:') ?></p>
            <div class="row">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                        <!-- < ?= $form->field($model, 'password')->widget(PasswordInput::classname(), 
                            ['options' => ['placeholder' => Yii::t('app', 'Enter new password'), 'autofocus' => true]]) ?>
                        <div class="form-group">
                            < ?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                        </div> -->
                        
                        <?= $form
                            ->field($model, 'password', $emailOptions)
                            ->label(false)
                            ->textInput(['placeholder' => $model->getAttributeLabel('password')]) 
                        ?>

                        <div class="row">
                            <div class="col-xs-8">
                            </div>
                            <div class="col-xs-4">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'reset-button']) ?>
                            </div>
                        </div>
                        
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

