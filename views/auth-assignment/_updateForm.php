<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;

use app\models\UsersInformation;

use app\models\BaseModel;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => BaseModel::getUsernames(),
        'options' => [
            'id' => 'user-id-update',
            'placeholder' => 'Select Name',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        'theme' => Select2::THEME_DEFAULT,
        
    ])->label('User Name');
    ?>

    <?= $form->field($model, 'item_name')->widget(Select2::classname(), [
        'data' => BaseModel::getUseraccess(),
        'options' => [
            'id' => 'useraccess-id-update',
            'placeholder' => 'Select Name',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        'theme' => Select2::THEME_DEFAULT,
        
    ])->label('Access');
    ?>

    <div class="form-group div-update-no-load text-right">
        <?= Html::submitButton('Update', ['class'=>'btn btn-flat btn-primary btnUpdate', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Update User Access']) ?>
    </div>

    <div class="form-group div-update-load text-right" hidden>
        <button class="btn btn-flat btn-default" disabled="disabled"><img src="<?php echo Yii::$app->request->baseUrl ?>/img/loading.gif"/>&nbsp;&nbsp; Updating data...</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js="
    $('.btnUpdate').on('click',function()
        {
            if ($('.has-error')[0]){
                //alert('has-error');
            } else {
                //alert('has-no-error');
                $('.close').hide();
                $('.div-update-no-load').hide();
                $('.div-update-load').show();
            }
        }
    )   
";

$this->registerJs($js,$this::POS_END);
?>

