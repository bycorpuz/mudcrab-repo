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
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=>'Enter Name', 'class'=>'form-control', 'tabindex' => '11', 'id' => 'supplier-update-name']) ?>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'is_company')->widget(Select2::classname(), [
                'data' => BaseModel::getYesNo(),
                'options' => [
                    'id' => 'supplier-update-is_company',
                    'placeholder' => 'Select Is Company',
                    //'multiple' => true,
                    'tabindex' => '12',
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
            <?= $form->field($model, 'description')->textarea(['rows' => 3, 'placeholder'=>'Enter Description', 'id' => 'supplier-update-description', 'tabindex' => '13']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder'=>'Enter Address', 'class'=>'form-control', 'tabindex' => '14', 'id' => 'supplier-update-address']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'c_num')->textInput(['maxlength' => true, 'placeholder'=>'Enter Contact Number', 'class'=>'form-control', 'tabindex' => '15', 'id' => 'supplier-update-c_num'])->label('Contact Number') ?>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder'=>'Enter Email Address', 'class'=>'form-control', 'tabindex' => '16', 'id' => 'supplier-update-email'])->label('Email Address') ?>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'tin')->textInput(['maxlength' => true, 'placeholder'=>'Enter TIN', 'class'=>'form-control', 'tabindex' => '17', 'id' => 'supplier-update-tin'])->label('TIN') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6">
            <?= $form->field($model, 'account_name')->textInput(['maxlength' => true, 'placeholder'=>'Enter Account Name', 'class'=>'form-control', 'tabindex' => '18', 'id' => 'supplier-update-account_name'])->label('Account Name') ?>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <?= $form->field($model, 'account_number')->textInput(['maxlength' => true, 'placeholder'=>'Enter Account Number', 'class'=>'form-control', 'tabindex' => '19', 'id' => 'supplier-update-account_number'])->label('Account Number') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group div-update-no-load text-right">
                <?= Html::submitButton('Update', ['class'=>'btn btn-flat btn-primary btnUpdate', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Update Supplier']) ?>
            </div>

            <div class="form-group div-update-load text-right" hidden>
                <button class="btn btn-flat btn-default" disabled="disabled"><img src="<?php echo Yii::$app->request->baseUrl ?>/img/loading.gif"/>&nbsp;&nbsp; Updating data...</button>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js="

    $('.form-control').on('change',function(){
        var name =document.getElementById('supplier-update-name').value;
        var is_company =document.getElementById('supplier-update-is_company').value;
        var description =document.getElementById('supplier-update-description').value;
        var address =document.getElementById('supplier-update-address').value;
        var c_num =document.getElementById('supplier-update-c_num').value;
        var email =document.getElementById('supplier-update-email').value;
        var tin =document.getElementById('supplier-update-tin').value;
        var account_name =document.getElementById('supplier-update-account_name').value;
        var account_number =document.getElementById('supplier-update-account_number').value;

        if(name.trim() == '' || is_company.trim() == '' || description.trim() == '' || address.trim() == '' || c_num.trim() == '' || email.trim() == '' || tin.trim() == '' || account_name.trim() == '' || account_number.trim() == ''){
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
                $('.div-update-no-load').hide();
                $('.div-update-load').show();
            }
        }
    )

";

$this->registerJs($js,$this::POS_END);
?>

