<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use app\models\BaseModel;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionLabor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-labor-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6">
            <?= $form->field($model, 'account_title_id')->widget(Select2::classname(), [
                'data' => BaseModel::getAccountTitleDirectLabor(),
                'options' => [
                    'id' => 'transactionlabor-update-account-title-id',
                    'placeholder' => 'Select Account Title',
                    //'multiple' => true,
                    'tabindex' => '10',
                    'class'=>'form-control'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'theme' => Select2::THEME_DEFAULT,       
            ])->label('Account Title');
            ?>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <?= $form->field($model, 'mode_of_payment_id')->widget(Select2::classname(), [
                'data' => BaseModel::getModeOfPayment(),
                'options' => [
                    'id' => 'transactionlabor-update-mode-of-payment-id',
                    'placeholder' => 'Select Mode of Payment',
                    //'multiple' => true,
                    'tabindex' => '10',
                    'class'=>'form-control'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'theme' => Select2::THEME_DEFAULT,       
            ])->label('Mode of Payment');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
                'data' => BaseModel::getUsernames(),
                'options' => [
                    'id' => 'transactionlabor-update-user-id',
                    'placeholder' => 'Select User Name',
                    //'multiple' => true,
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'theme' => Select2::THEME_DEFAULT,                
            ])->label('User Name');
            ?>
        </div>
    </div>

    <?php
        echo $form->field($model, 'amount')->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'prefix' => html_entity_decode('&#8369; '),
                'suffix' => '',
                'affixesStay' => true,
                'thousands' => ',',
                'decimal' => '.',
                'precision' => 2,
                'allowZero' => true,
                'allowNegative' => true,
            ],
            'options' => [
                'id' => 'transactionlabor-update-amount',
            ]
        ]);
    ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 3]) ?>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <label class="control-label">&nbsp;</label>
            <div class="form-group div-no-load text-right">
                <?= Html::submitButton('Update', ['class'=>'btn btn-flat btn-primary btnUpdate', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Update Direct Labor', 'disabled'=>'disabled', 'tabindex' => '22']) ?>
            </div>
            <div class="form-group div-load text-right" hidden>
                <button class="btn btn-flat btn-default" disabled="disabled"><img src="<?php echo Yii::$app->request->baseUrl ?>/img/loading.gif"/>&nbsp;&nbsp; Updating data...</button>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js="
    $('.form-control').on('change',function(){        
        var account_title_id=document.getElementById('transactionlabor-update-mode-of-payment-id').value;
        var mode_of_payment_id=document.getElementById('transactionlabor-update-account-title-id').value;
        var user_id=document.getElementById('transactionlabor-update-user-id').value;
        var amount=document.getElementById('transactionlabor-update-amount-disp').value;

        if(account_title_id.trim() == '' || mode_of_payment_id.trim() == '' || user_id.trim() == '' || (amount.trim() == '' || amount.trim() == '₱ 0.00') ){
            $('.btnUpdate').prop('disabled',true);
        }else{
            $('.btnUpdate').prop('disabled',false);
        }
    })

    $('.btnUpdate').on('click',function()
        {
            if ($('.has-error')[0]){
                //alert('has-error');
            } else {
                //alert('has-no-error');
                $('.div-no-load').hide();
                $('.div-load').show();
            }
        }
    )
";

$this->registerJs($js,$this::POS_END);
?>

