<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\BaseModel;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-8 col-md-8 col-lg-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=>'Enter Name', 'class'=>'form-control', 'tabindex' => '1']) ?>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'is_company')->widget(Select2::classname(), [
                'data' => BaseModel::getYesNo(),
                'options' => [
                    'id' => 'supplier-is_company',
                    'placeholder' => 'Select Is Company',
                    //'multiple' => true,
                    'tabindex' => '2',
                    'class'=>'form-control'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'theme' => Select2::THEME_DEFAULT,       
            ])->label('Is Company?');
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 3, 'placeholder'=>'Enter Description', 'tabindex' => '3']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder'=>'Enter Address', 'class'=>'form-control', 'tabindex' => '4']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'c_num')->textInput(['maxlength' => true, 'placeholder'=>'Enter Contact Number', 'class'=>'form-control', 'tabindex' => '5'])->label('Contact Number') ?>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder'=>'Enter Email Address', 'class'=>'form-control', 'tabindex' => '6'])->label('Email Address') ?>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'tin')->textInput(['maxlength' => true, 'placeholder'=>'Enter TIN', 'class'=>'form-control', 'tabindex' => '7'])->label('TIN') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6">
            <?= $form->field($model, 'account_name')->textInput(['maxlength' => true, 'placeholder'=>'Enter Account Name', 'class'=>'form-control', 'tabindex' => '8'])->label('Account Name') ?>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <?= $form->field($model, 'account_number')->textInput(['maxlength' => true, 'placeholder'=>'Enter Account Number', 'class'=>'form-control', 'tabindex' => '9'])->label('Account Number') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group div-no-load text-right">
                <?= Html::submitButton('Save', ['class'=>'btn btn-flat btn-success btnSave', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Add New Supplier', 'disabled'=>'disabled', 'tabindex' => '10']) ?>
            </div>
            <div class="form-group div-load text-right" hidden>
                <button class="btn btn-flat btn-default" disabled="disabled"><img src="<?php echo Yii::$app->request->baseUrl ?>/img/loading.gif"/>&nbsp;&nbsp; Saving data...</button>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js="

    $('.form-control').on('change',function(){
        var name =document.getElementById('supplier-name').value;
        var is_company =document.getElementById('supplier-is_company').value;
        var description =document.getElementById('supplier-description').value;
        var address =document.getElementById('supplier-address').value;
        var c_num =document.getElementById('supplier-c_num').value;
        var email =document.getElementById('supplier-email').value;
        var tin =document.getElementById('supplier-tin').value;
        var account_name =document.getElementById('supplier-account_name').value;
        var account_number =document.getElementById('supplier-account_number').value;

        if(name.trim() == '' || is_company.trim() == '' || description.trim() == '' || address.trim() == '' || c_num.trim() == '' || email.trim() == '' || tin.trim() == '' || account_name.trim() == '' || account_number.trim() == ''){
            $('.btnSave').prop('disabled',true);
        }else{
            $('.btnSave').prop('disabled',false);
        }
    })

    $('.btnSave').on('click',function()
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

