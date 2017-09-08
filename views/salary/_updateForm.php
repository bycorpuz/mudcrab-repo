<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\Salary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'salary-update-name']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2, 'id' => 'salary-update-description']) ?>

    <?= $form->field($model, 'sg')->textInput(['maxlength' => true, 'id' => 'salary-update-sg']) ?>

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
                'id' => 'salary-update-amount',
            ]
        ]);
    ?>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group div-update-no-load text-right">
                <?= Html::submitButton('Update', ['class'=>'btn btn-flat btn-primary btnUpdate', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Update Salary']) ?>
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
        var name=document.getElementById('salary-update-name').value;
        var description=document.getElementById('salary-update-description').value;
        var sg=document.getElementById('salary-update-sg').value;
        var amount=document.getElementById('salary-update-amount').value;

        if(name.trim() == '' || description.trim() == '' || sg.trim() == '' || amount.trim() == ''){
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