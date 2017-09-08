<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\Configuration;

use kartik\growl\Growl;

$companyName = Configuration::find()->all();
foreach ($companyName as $name => $value) {
    $company_name = $value->companyName;
    $company_site_name = $value->siteName;
    $company_description = $value->description;
    $company_logo = $value->logo;
    $company_favicon = $value->favicon;
}

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>

<?php foreach (Yii::$app->session->getAllFlashes() as $msg):; ?>
    <?php
    Growl::widget([
        'type' => (!empty($msg['type'])) ? $msg['type'] : 'danger',
        'title' => (!empty($msg['title'])) ? Html::encode($msg['title']) : 'Title Not Set!',
        'icon' => (!empty($msg['icon'])) ? $msg['icon'] : 'fa fa-info',
        'body' => (!empty($msg['message'])) ? Html::encode($msg['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 3, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($msg['duration'])) ? $msg['duration'] : 1500, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($msg['positonY'])) ? $msg['positonY'] : 'top',
                'align' => (!empty($msg['positonX'])) ? $msg['positonX'] : 'right',
            ]
        ],
        'useAnimation'=>true
    ]);
    ?>
<?php endforeach; ?>



<div class="login-box">
    <div class="login-logo">
        <?php
            $name = explode(" ", $company_site_name);
            echo '<b style="font-size:32px;">' . $name[0] . ' ' . $name[1] . ' ' . $name[2] . '</b>';
            echo '<br>';
            echo '<i><span style="font-size:18px;">' . $name[3] . ' ' . $name[4] . ' ' . $name[5] . ' ' . $name[6] . ' ' . $name[7] . '</span></i>';
        ?>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

        <!-- <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
                using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
                in using Google+</a>
        </div> -->
        <!-- /.social-auth-links -->

        <!-- <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>
         -->
        <div style="color:#999;">
            <?= Html::a('I forgot my password', ['request-password-reset']) ?>
            <br>
            <?= Html::a('Register a new account', ['signup'])?>
        </div>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
