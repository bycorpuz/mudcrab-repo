<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use app\models\BaseModel;

use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\UsersInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usersinformation-update-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'firstName')->textInput(['maxlength' => true, 'placeholder'=>'Enter First Name', 'class'=>'form-control keyNames', 'tabindex' => '12', 'id'=>'usersinformation-update-firstname']) ?>
	    </div>
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'sex')->widget(Select2::classname(), [
	            'data' => BaseModel::getSex(),
	            'options' => [
	                'id' => 'usersinformation-update-sex',
	                'placeholder' => 'Select Sex',
	                //'multiple' => true,
	                'tabindex' => '16',
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
	    	<?= $form->field($model, 'middleName')->textInput(['maxlength' => true, 'placeholder'=>'Enter Middle Name', 'class'=>'form-control keyNames', 'tabindex' => '13', 'id'=>'usersinformation-update-middlename']) ?>
	    </div>
	    <div class="col-sm-6 col-md-6 col-lg-6">
            <?php
            echo $form->field($model, 'bday')->widget(DatePicker::classname(), [
				'name' => 'bday',
				'type' => DatePicker::TYPE_COMPONENT_PREPEND,
				//'value' => 'bday',
				'options' => [
					  'id' => 'usersinformation-update-bday',
                      'placeholder' => 'yyyy-mm-dd',
                      'tabindex' => '17',
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
	    	<?= $form->field($model, 'lastName')->textInput(['maxlength' => true, 'placeholder'=>'Enter Last Name', 'class'=>'form-control keyNames', 'tabindex' => '14', 'id'=>'usersinformation-update-lastname']) ?>
	    </div>  
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'c_num')->textInput(['maxlength' => true, 'placeholder'=>'Enter Contact Number', 'tabindex' => '18', 'id'=>'usersinformation-update-c_num']) ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'ext_name')->textInput(['maxlength' => true, 'placeholder'=>'Enter Extension Name', 'tabindex' => '15', 'id'=>'usersinformation-update-ext_name']) ?>
	    </div>
		<div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder'=>'Enter Address', 'tabindex' => '19', 'id'=>'usersinformation-update-address']) ?>
	    </div>
	</div>

	<?php
		$users = Users::find()->where(['id'=>$model->user_id])->one();
		$model->username = $users['username'];
		$model->password = $users['password_hash'];
		$model->email = $users['email'];
		$model->position = $users['position_id'];
		$model->salary = $users['salary_id'];
	?>

	<div class="row">
	    <div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder'=>'Auto Generated Username', 'id'=>'usersinformation-update-username']) ?>
	    </div>
		<div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'password')->textInput(['maxlength' => true, 'placeholder'=>'password', 'id'=>'usersinformation-update-password']) ?>
	    </div>
	    <div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder'=>'Enter E-mail', 'id'=>'usersinformation-update-email']) ?>
	    </div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-md-6 col-lg-6">
	    	<?= $form->field($model, 'position')->widget(Select2::classname(), [
	            'data' => BaseModel::getPosition(),
	            'options' => [
	                'id' => 'usersinformation-update-position',
	                'placeholder' => 'Select Position',
	                //'multiple' => true,
	                'tabindex' => '20',
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
	                'id' => 'usersinformation-update-salary',
	                'placeholder' => 'Select Salary',
	                //'multiple' => true,
	                'tabindex' => '21',
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
	    	<?= $form->field($model, 'tin')->textInput(['maxlength' => true, 'placeholder'=>'Enter TIN', 'id'=>'usersinformation-update-tin']) ?>
	    </div>
		<div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'account_name')->textInput(['maxlength' => true, 'placeholder'=>'Enter Account Name', 'id'=>'usersinformation-update-account_name']) ?>
	    </div>
	    <div class="col-sm-4 col-md-4 col-lg-4">
	    	<?= $form->field($model, 'account_number')->textInput(['maxlength' => true, 'placeholder'=>'Enter Account Number', 'id'=>'usersinformation-update-account_number']) ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-12 col-md-12 col-lg-12">
	    	<label class="control-label">&nbsp;</label>
		    <div class="form-group div-no-load text-right">
		        <?= Html::submitButton('Update', ['class'=>'btn btn-flat btn-primary btnUpdate', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Update User Information', 'disabled'=>'disabled', 'tabindex' => '22']) ?>
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
        var firstname=document.getElementById('usersinformation-update-firstname').value;
        var middlename=document.getElementById('usersinformation-update-middlename').value;
        var lastname=document.getElementById('usersinformation-update-lastname').value;
        var sex=document.getElementById('usersinformation-update-sex').value;
        var bday=document.getElementById('usersinformation-update-bday').value;
        var c_num=document.getElementById('usersinformation-update-c_num').value;
        var address=document.getElementById('usersinformation-update-address').value;

        var username=document.getElementById('usersinformation-update-username').value;
        var password=document.getElementById('usersinformation-update-password').value;
        var email=document.getElementById('usersinformation-update-email').value;
        
        var position=document.getElementById('usersinformation-update-position').value;
        var salary=document.getElementById('usersinformation-update-salary').value;

        if(firstname.trim() == '' || middlename.trim() == '' || lastname.trim() == '' || sex.trim() == '' || bday.trim() == '' || c_num.trim() == '' || address.trim() == '' || username.trim() == '' || password.trim() == '' || email.trim() == '' || position.trim() == '' || salary.trim() == ''){
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

    $( '.keyNames' ).keyup(function() {
	  var firstName =  $('#usersinformation-update-firstname').val();
	  var middleName = $('#usersinformation-update-middlename').val();
	  var lastName = $('#usersinformation-update-lastname').val();
	  var username = firstName.substr(0, 1) + middleName.substr(0, 1) + lastName;
	  username = username.replace(/\s/g, '');

	  $('#usersinformation-update-username').val(username.toLowerCase());
	  $('#usersinformation-update-email').val(username.toLowerCase() + '@gmail.com');

	    /*$.post('/mudcrab/users/checkuser',{'username':username},function(data){
	        if(data > 0){
	            swal('Not Allowed', 'Username is Already Taken!', 'error');
	            document.getElementById('usersinformation-update-username').value = '';
	            document.getElementById('usersinformation-update-username').focus();
	        }
	    });*/

	});

";

$this->registerJs($js,$this::POS_END);
?>

