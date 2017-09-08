<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\Users;
use app\models\BaseModel;

use kartik\widgets\Select2;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */

$this->title = '';
?>

<div class="users-form">
    <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src=<?= Yii::$app->request->baseUrl.Yii::$app->user->identity->profile_pic ?> alt="User profile picture">

              <h3 class="profile-username text-center"><?= BaseModel::getUserFullName(Yii::$app->user->identity->id) ?></h3>
              
              <p class="text-muted text-center"><small><i>Member Since <?= date("F d, Y", $usersInfo->created_at) ?></i></small></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Position</b> <a class="pull-right"><?= $usersInfo->position->name . ' - ' . $usersInfo->position->description ?></a>
                </li>
                <li class="list-group-item">
                  <b>Salary</b> <a class="pull-right"><?= $usersInfo->salary->description . ' <i>(' . number_format($usersInfo->salary->amount,'2','.',',') . ')</i>' ?></a>
                </li>
                <li class="list-group-item">
                  <b>Username</b> <a class="pull-right"><?= Yii::$app->user->identity->username ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?= Yii::$app->user->identity->email ?></a>
                </li>
                <li class="list-group-item">
                  <b>Status</b><?php
                        $status = Yii::$app->user->identity->status;
                        if ($status == 10){
                            echo '<a class="pull-right text-green">Active</a>';
                        } else {

                        }
                    ?>
                </li>
              </ul>
              <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-intersex margin-r-5"></i> Sex</strong>

                <p class="text-muted">
                    <?php 
                        $sex = $usersInfo->userinfo->sex; 
                        if ($sex == ''){
                            echo '<i class="text-red">not-set</i>';
                        } else {
                            echo $sex;
                        }
                    ?>
                </p>

              <hr>

              <strong><i class="fa fa-birthday-cake margin-r-5"></i> Birth Date</strong>

              <p class="text-muted">
                <?php 
                    $bday = $usersInfo->userinfo->bday; 
                    if ($bday == '0000-00-00'){
                        echo '<i class="text-red">not-set</i>';
                    } else {
                        echo date_format(date_create($bday),'F d, Y');
                    }
                ?>
              </p>

              <hr>

              <strong><i class="fa fa-address-card-o margin-r-5"></i> Address</strong>

              <p class="text-muted">
                <?php 
                    $address = $usersInfo->userinfo->address; 
                    if ($address == ''){
                        echo '<i class="text-red">not-set</i>';
                    } else {
                        echo $address;
                    }
                ?>
              </p>

              <hr>

              <strong><i class="fa fa-tag margin-r-5"></i> Contact #</strong>

              <p class="text-muted">
                <?php 
                    $c_num = $usersInfo->userinfo->c_num; 
                    if ($c_num == ''){
                        echo '<i class="text-red">not-set</i>';
                    } else {
                        echo $c_num;
                    }
                ?>
              </p>

              <hr>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">General Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="settings">

            <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">User Information</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <?php $form = ActiveForm::begin([
                        'action' => Yii::$app->request->baseUrl . '/users/updateuserinfo?user_id=' . $modelInfo->user_id . '&module=profile' ,
                        'enableClientValidation' => false,
                        'options' => [
                            'enctype' => 'multipart/form-data',
                        ],
                        ]); ?>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($modelInfo, 'firstName')->textInput(['name' => 'firstName', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelInfo, 'middleName')->textInput(['name' => 'middleName', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelInfo, 'lastName')->textInput(['name' => 'lastName', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($modelInfo, 'ext_name')->textInput(['name' => 'ext_name', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($modelInfo, 'sex')->dropDownList(['Male'=>'Male', 'Female'=>'Female'],['name' => 'sex', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($modelInfo, 'c_num')->textInput(['name' => 'c_num', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($modelInfo, 'bday')->widget(DatePicker::classname(), [
                                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                    'options' => [
                                        'id' => 'bday',
                                        'name' => 'bday',
                                        'placeholder' => '',
                                        'class' => 'form-control forbtnInfo'
                                    ],
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'yyyy-mm-dd'
                                    ],
                                    'removeButton' => false,
                                ])->label('Birth Date');
                            ?>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($modelInfo, 'address')->textArea(['name' => 'address', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <?= $form->field($modelInfo, 'tin')->textInput(['name' => 'tin', 'type' => 'text', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <?= $form->field($modelInfo, 'account_name')->textInput(['name' => 'account_name', 'type' => 'text', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <?= $form->field($modelInfo, 'account_number')->textInput(['name' => 'account_number', 'type' => 'text', 'class' => 'form-control forbtnInfo']) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group div-update-no-load-info text-right">
                                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary btnInfo btn-flat', 'data-placement'=>'right', 'data-toggle'=>'tooltip', 'title'=>'Update User Information', 'disabled' => 'disabled']); ?>
                                </div>
                                <div class="form-group div-update-load-info text-right" hidden>
                                    <button class="btn btn-flat btn-default" disabled="disabled"><img src="<?php echo Yii::$app->request->baseUrl ?>/img/loading.gif"/>&nbsp;&nbsp; Updating user information...</button>
                                </div>
                            </div>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
                <!-- /.box-body -->
                <!-- <div class="box-footer" style="display: block;">
                </div> -->
            </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title">User Account</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <?php 
                        $form = ActiveForm::begin([
                            'action' => Yii::$app->request->baseUrl . '/users/updateaccount?id=' . $model->id . '&module=profile' ,
                            'enableClientValidation' => false,
                            'options' => [
                                'enctype' => 'multipart/form-data',
                            ],
                        ]);

                        $usernameOptions = [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
                        ];
                        ?>

                            <div class="box-body" style="display: block;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'username' , $usernameOptions)->textInput(['id' => 'users-username', 'name' => 'users-username', 'class' => 'form-control users-username forbtnAccount', 'required'=>'required']) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="users-current-password">Current Password</label>
                                        <div class="input-group">
                                            <input id = 'users-current-password' name='users-current-password' class='form-control users-current-password forbtnAccount' type='password' class="form-control" placeholder="">
                                            <span class="input-group-addon" style='cursor: pointer;' ><i class="glyphicon glyphicon-eye-open showPassword"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label" for="users-new-password">New Password</label>
                                        <div class="input-group">
                                            <input id = 'users-new-password' name='users-new-password' class='form-control users-new-password forbtnAccount' type='password' class="form-control" placeholder="">
                                            <span class="input-group-addon" style='cursor: pointer;' ><i class="fa fa-unlock-alt newPassword"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="users-validation-password">Confirm New Password</label>
                                        <div class="input-group">
                                            <input id = 'users-validation-password' name='users-validation-password' class='form-control users-validation-password forbtnAccount' type='password' class="form-control" placeholder="">
                                            <span class="input-group-addon" style='cursor: pointer;' ><i class="fa fa-circle-o validatePassword"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group div-update-no-load-account text-right">
                                            <?= Html::submitButton('Update', ['class' => 'btn btn-primary btnAccount btn-flat', 'data-placement'=>'right', 'data-toggle'=>'tooltip', 'title'=>'Update User Account', 'disabled' => 'disabled']); ?>
                                        </div>
                                        <div class="form-group div-update-load-account text-right" hidden>
                                            <button class="btn btn-flat btn-default" disabled="disabled"><img src="<?php echo Yii::$app->request->baseUrl ?>/img/loading.gif"/>&nbsp;&nbsp; Updating user account...</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- /.box-body -->
                        <!-- <div class="box-footer" style="display: block;">
                        </div> -->
                        <?php ActiveForm::end(); ?>
                    </div>


                    <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Others</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="display: none;">
                            <?php $form = ActiveForm::begin([
                                'action' => Yii::$app->request->baseUrl . '/users/updateuser?id=' . $model->id . '&module=profile' ,
                                'enableClientValidation' => false,
                                'options' => [
                                    'enctype' => 'multipart/form-data',
                                ],
                                ]); ?>
                                
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <?= $form->field($model, 'email')->textInput(['name' => 'email', 'type' => 'email', 'class' => 'form-control users-email forbtnEmail']) ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <?= $form->field($model, 'position_id')->widget(Select2::classname(), [
                                            'data' => BaseModel::getPosition(),
                                            'options' => [
                                                'name' => 'position_id',
                                                'placeholder' => 'Select Position',
                                                'class'=>'form-control forbtnEmail'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true,
                                            ],
                                            'theme' => Select2::THEME_DEFAULT,       
                                        ])->label('Position');
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <?= $form->field($model, 'salary_id')->widget(Select2::classname(), [
                                            'data' => BaseModel::getSalary(),
                                            'options' => [
                                                'name' => 'salary_id',
                                                'placeholder' => 'Select Salary',
                                                'class'=>'form-control forbtnEmail'
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
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group div-update-no-load-email text-right">
                                            <?= Html::submitButton('Update', ['class' => 'btn btn-primary btnEmail btn-flat', 'data-placement'=>'right', 'data-toggle'=>'tooltip', 'title'=>'Update User Information', 'disabled' => 'disabled']); ?>
                                        </div>
                                        <div class="form-group div-update-load-email text-right" hidden>
                                            <button class="btn btn-flat btn-default" disabled="disabled"><img src="<?php echo Yii::$app->request->baseUrl ?>/img/loading.gif"/>&nbsp;&nbsp; Updating user information...</button>
                                        </div>
                                    </div>
                                </div>

                            <?php ActiveForm::end(); ?>

                            <br>

                            <div class="row">
                                <br>
                                <div class="col-md-12" align="center">
                                    <img src=<?= Yii::$app->request->baseUrl.Yii::$app->user->identity->profile_pic ?> class="profile-user-img img-responsive img-circle" alt="User Image" style="heigh:150px;width:150px;">
                                </div>
                            </div>
                            <div class="row">
                                <br>
                                <div class="col-md-12" align="center">
                                    <?= BaseModel::getUserFullName(Yii::$app->user->identity->id) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <?php $form = ActiveForm::begin([
                                            'options'=>['enctype'=>'multipart/form-data'],
                                            'action' => Yii::$app->request->baseUrl . '/users/updateprofilepicture?id=' . $model->id . '&module=profile' ,
                                        ]);
                                    ?> 
                                        <?= $form->field($model, 'file')->fileInput(['class'=>'form-control forbtnPic']); ?>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group div-update-no-load-pic text-right">
                                                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary btnPic btn-flat', 'data-placement'=>'right', 'data-toggle'=>'tooltip', 'title'=>'Update Profile Picture', 'disabled' => 'disabled']); ?>
                                                </div>
                                                <div class="form-group div-update-load-pic text-right" hidden>
                                                    <button class="btn btn-flat btn-default" disabled="disabled"><img src="<?php echo Yii::$app->request->baseUrl ?>/img/loading.gif"/>&nbsp;&nbsp; Updating user profile picture...</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <!-- <div class="box-footer" style="display: block;">
                        </div> -->
                    </div>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <input value='<?= Yii::$app->user->identity->id ?>' class='178163236' hidden='hidden'/>
</div>


<?php
    $js="
        $('.btnInfo').on('click',function()
            {
                if ($('.has-error')[0]){
                    //alert('has-error');
                } else {
                    //alert('has-no-error');
                    $('.close').hide();
                    $('.div-update-no-load-info').hide();
                    $('.div-update-load-info').show();
                }
            }
        )

        $('.forbtnInfo').on('keyup',function(){
            var firstname=document.getElementById('usersinformation-firstname').value;
            var middlename=document.getElementById('usersinformation-middlename').value;
            var lastname=document.getElementById('usersinformation-lastname').value;
            var sex=document.getElementById('usersinformation-sex').value;
            var c_num=document.getElementById('usersinformation-c_num').value;
            var bday=document.getElementById('bday').value;
            var address=document.getElementById('usersinformation-address').value;
            var tin=document.getElementById('usersinformation-tin').value;
            var account_name=document.getElementById('usersinformation-account_name').value;
            var account_number=document.getElementById('usersinformation-account_number').value;

            if(firstname.trim() == '' || middlename.trim() == '' || lastname.trim() == '' || sex.trim() == '' || c_num.trim() == '' || bday.trim() == '' || address.trim() == '' || tin.trim() == '' || account_name.trim() == '' || account_number.trim() == ''){
                $('.btnInfo').prop('disabled',true);
            }else{
                $('.btnInfo').prop('disabled',false);
            }
        })

        $('.btnAccount').on('click',function()
            {
                if ($('.has-error')[0]){
                    //alert('has-error');
                } else {
                    //alert('has-no-error');
                    $('.close').hide();
                    $('.div-update-no-load-account').hide();
                    $('.div-update-load-account').show();
                }
            }
        )

        $('.forbtnAccount').on('keyup',function(){
            var username=document.getElementById('users-username').value;
            var currpass=document.getElementById('users-current-password').value;
            var newpass=document.getElementById('users-new-password').value;
            var validpass=document.getElementById('users-validation-password').value;

            if(username.trim() == '' || currpass.trim() == '' || newpass.trim() == '' || validpass.trim() == ''){
                $('.btnAccount').prop('disabled',true);
            }else{
                $('.btnAccount').prop('disabled',false);
            }
        })

        $('.btnEmail').on('click',function()
            {
                if ($('.has-error')[0]){
                    //alert('has-error');
                } else {
                    //alert('has-no-error');
                    $('.close').hide();
                    $('.div-update-no-load-email').hide();
                    $('.div-update-load-email').show();
                }
            }
        )

        $('.forbtnEmail').on('change',function(){
            var email=document.getElementById('users-email').value;
            var position=document.getElementById('users-position_id').value;
            var salary=document.getElementById('users-salary_id').value;

            if(email.trim() == '' || position.trim() == '' || salary.trim() == ''){
                $('.btnEmail').prop('disabled',true);
            }else{
                $('.btnEmail').prop('disabled',false);
            }
        })

        $('.btnPic').on('click',function()
            {
                if ($('.has-error')[0]){
                    //alert('has-error');
                } else {
                    //alert('has-no-error');
                    $('.close').hide();
                    $('.div-update-no-load-pic').hide();
                    $('.div-update-load-pic').show();
                }
            }
        )

        $('.forbtnPic').on('change',function(){
            var pic=document.getElementById('users-file').value;

            if(pic.trim() == ''){
                $('.btnPic').prop('disabled',true);
            }else{
                $('.btnPic').prop('disabled',false);
            }
        })
    ";
    $this->registerJs($js,$this::POS_END);
?>