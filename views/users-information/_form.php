<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use app\models\BaseModel;

/* @var $this yii\web\View */
/* @var $model app\models\UsersInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-information-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'firstName')->textInput(['maxlength' => true, 'placeholder'=>'Enter First Name', 'class'=>'form-control keyNames', 'tabindex' => '1']) ?>
	    </div>
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'sex')->widget(Select2::classname(), [
	            'data' => BaseModel::getSex(),
	            'options' => [
	                'id' => 'useraccess-information-sex',
	                'placeholder' => 'Select Sex',
	                //'multiple' => true,
	                'tabindex' => '5',
	                'class'=>'form-control'
	            ],
	            'pluginOptions' => [
	                'allowClear' => true,
	            ],
	            'theme' => Select2::THEME_DEFAULT,	     
	        ])->label('Sex');
	        ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'middleName')->textInput(['maxlength' => true, 'placeholder'=>'Enter Middle Name', 'class'=>'form-control keyNames', 'tabindex' => '2']) ?>
	    </div>
	    <div class="col-sm-6 col-md-6 col-lg-6">
            <?php
            echo $form->field($model, 'bday')->widget(DatePicker::classname(), [
				'name' => 'bday',
				'type' => DatePicker::TYPE_COMPONENT_PREPEND,
				//'value' => 'bday',
				'options' => [
                      'placeholder' => 'yyyy-mm-dd',
                      'tabindex' => '6',
	                ],
				'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
				],
	            'removeButton' => false
            ])->label('Birth Date');
            ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'lastName')->textInput(['maxlength' => true, 'placeholder'=>'Enter Last Name', 'class'=>'form-control keyNames', 'tabindex' => '3']) ?>
	    </div>  
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'c_num')->textInput(['maxlength' => true, 'placeholder'=>'Enter Contact Number', 'tabindex' => '7']) ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'ext_name')->textInput(['maxlength' => true, 'placeholder'=>'Enter Extension Name', 'tabindex' => '4']) ?>
	    </div>
		<div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder'=>'Enter Address', 'tabindex' => '8']) ?>
	    </div>
	</div>
	<?php
		$model->password='password';
	?>
	<div class="row">
	    <div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder'=>'Auto Generated Username']) ?>
	    </div>
		<div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'password')->textInput(['maxlength' => true, 'placeholder'=>'password']) ?>
	    </div>
	    <div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder'=>'Enter E-mail']) ?>
	    </div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'position')->widget(Select2::classname(), [
	            'data' => BaseModel::getPosition(),
	            'options' => [
	                'id' => 'users-information-position',
	                'placeholder' => 'Select Position',
	                //'multiple' => true,
	                'tabindex' => '9',
	                'class'=>'form-control'
	            ],
	            'pluginOptions' => [
	                'allowClear' => true,
	            ],
	            'theme' => Select2::THEME_DEFAULT,	     
	        ])->label('Position');
	        ?>
	    </div>
		<div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'salary')->widget(Select2::classname(), [
	            'data' => BaseModel::getSalary(),
	            'options' => [
	                'id' => 'users-information-salary',
	                'placeholder' => 'Select Salary',
	                //'multiple' => true,
	                'tabindex' => '10',
	                'class'=>'form-control'
	            ],
	            'pluginOptions' => [
	                'allowClear' => true,
	            ],
	            'theme' => Select2::THEME_DEFAULT,	     
	        ])->label('Salary');
	        ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'tin')->textInput(['maxlength' => true, 'placeholder'=>'Enter TIN']) ?>
	    </div>
		<div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'account_name')->textInput(['maxlength' => true, 'placeholder'=>'Enter Account Name']) ?>
	    </div>
	    <div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'account_number')->textInput(['maxlength' => true, 'placeholder'=>'Enter Account Number']) ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-12 col-md-12 col-lg-12">
		    <div class="form-group div-no-load text-right">
		        <?= Html::submitButton('Save', ['class'=>'btn btn-flat btn-success btnSave', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Add New Employee', 'disabled'=>'disabled', 'tabindex' => '11']) ?>
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
        var firstname=document.getElementById('usersinformation-firstname').value;
        var middlename=document.getElementById('usersinformation-middlename').value;
        var lastname=document.getElementById('usersinformation-lastname').value;
        var sex=document.getElementById('useraccess-information-sex').value;
        var bday=document.getElementById('usersinformation-bday').value;
        var c_num=document.getElementById('usersinformation-c_num').value;
        var address=document.getElementById('usersinformation-address').value;

        var username=document.getElementById('usersinformation-username').value;
        var password=document.getElementById('usersinformation-password').value;
        var email=document.getElementById('usersinformation-email').value;
        
        var position=document.getElementById('users-information-position').value;
        var salary=document.getElementById('users-information-salary').value;

        if(firstname.trim() == '' || middlename.trim() == '' || lastname.trim() == '' || sex.trim() == '' || bday.trim() == '' || c_num.trim() == '' || address.trim() == '' || username.trim() == '' || password.trim() == '' || email.trim() == '' || position.trim() == '' || salary.trim() == ''){
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

    $( '.keyNames' ).keyup(function() {
	  var firstName =  $('#usersinformation-firstname').val();
	  var middleName = $('#usersinformation-middlename').val();
	  var lastName = $('#usersinformation-lastname').val();
	  var username = firstName.substr(0, 1) + middleName.substr(0, 1) + lastName;
	  username = username.replace(/\s/g, '');

	  $('#usersinformation-username').val(username.toLowerCase());
	  $('#usersinformation-email').val(username.toLowerCase() + '@gmail.com');

	    /*$.post('/mudcrab/users/checkuser',{'username':username},function(data){
	        if(data > 0){
	            swal('Not Allowed', 'Username is Already Taken!', 'error');
	            document.getElementById('usersinformation-username').value = '';
	            document.getElementById('usersinformation-username').focus();
	        }
	    });*/

	});

";

$this->registerJs($js,$this::POS_END);
?>

