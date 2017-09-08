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
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
                'data' => BaseModel::getUsernames(),
                'options' => [
                    'id' => 'user-id',
                    'placeholder' => 'Select User Name',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'theme' => Select2::THEME_DEFAULT,                
            ])->label('User Name');
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($model, 'item_name')->widget(Select2::classname(), [
                'data' => BaseModel::getUseraccess(),
                'options' => [
                    'id' => 'useraccess-id',
                    'placeholder' => 'Select Access',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'theme' => Select2::THEME_DEFAULT,                
            ])->label('Access');
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group div-no-load text-right">
                <?= Html::submitButton('Save', ['class'=>'btn btn-flat btn-success btnSave', 'data-placement'=>'left', 'data-toggle'=>'tooltip', 'title'=>'Add New User Access']) ?>
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
    $('.btnSave').on('click',function()
        {
            var clear = $('span.select2-selection__clear').length;

            if (clear >= 2 ){
                $('.div-no-load').hide();
                $('.div-load').show();
            }
        }
    )
";

$this->registerJs($js,$this::POS_END);
?>

