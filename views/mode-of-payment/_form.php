<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModeOfPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modeofpayment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group div-no-load text-right">
                <?= Html::submitButton('Save', ['class'=>'btn btn-flat btn-success btnSave', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Add New Mode of Payment', 'disabled'=>'disabled']) ?>
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
    $('.form-control').on('keyup',function(){        
        var name=document.getElementById('modeofpayment-name').value;
        var description=document.getElementById('modeofpayment-description').value;

        if(name.trim() == '' || description.trim() == ''){
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