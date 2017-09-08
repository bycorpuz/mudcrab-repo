<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Unit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'unit-update-name']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2, 'id' => 'unit-update-description']) ?>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group div-update-no-load text-right">
                <?= Html::submitButton('Update', ['class'=>'btn btn-flat btn-primary btnUpdate', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Update Unit']) ?>
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
    $('.form-control').on('keyup',function(){        
        var name=document.getElementById('unit-update-name').value;
        var description=document.getElementById('unit-update-description').value;

        if(name.trim() == '' || description.trim() == ''){
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
                $('.close').hide();
                $('.div-update-no-load').hide();
                $('.div-update-load').show();
            }
        }
    )   
";

$this->registerJs($js,$this::POS_END);
?>