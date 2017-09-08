<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\BaseModel;
use app\models\Users;

use kartik\widgets\Select2;

use yii\helpers\Url;
use yii\bootstrap\Modal;

use app\models\Configuration;

$companyName = Configuration::find()->all();
foreach ($companyName as $name => $value) {
    $company_name = $value->companyName;
    $company_site_name = $value->siteName;
    $company_description = $value->description;
    $company_logo = $value->logo;
    $company_favicon = $value->favicon;
}
$usersInfo = Users::find()->joinWith('userinfo')->joinWith('position')->joinWith('salary')->where(['user.id'=>Yii::$app->user->identity->id])->one();
?>

<div class="fixed">
	<header class="main-header">

		<?php
            $name = explode(" ", $company_site_name);
        ?>

	    <?= Html::a('<span class="logo-mini">'. substr($name[0], 0, 1) . substr($name[1], 0, 1) . substr($name[2], 0, 1) .'</span><span class="logo-lg">' . strtoupper(strtolower( $name[3] )) . ' ' . strtoupper(strtolower( $name[4])) . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

	    <!--  afte 4 ~ ' ' . substr($name[5], 0, 1) . substr($name[6], 0, 1) . substr($name[7], 0, 1) . -->

	    <nav class="navbar navbar-static-top" role="navigation">

	        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	            <span class="sr-only">Toggle navigation</span>
	        </a>

	        <div class="navbar-custom-menu">

	            <ul class="nav navbar-nav">

	                <!-- Messages: style can be found in dropdown.less-->
	                <!-- < ?php if (yii::$app->user->can('_CREATE-INCOMING')) : ?>
	                	<li class="dropdown messages-menu">
		                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		                        <i class="fa fa-envelope-o"></i>
		                        <span class="label label-warning">
		                            < ?= $pending = DocumentTracker::find()->where(['dtr_status'=>2])->count(); ?>
		                        </span>
		                    </a>
		                    <ul class="dropdown-menu">
		                        <li class="header">< ?= $pending = DocumentTracker::find()->where(['dtr_status'=>2])->count(); ?> Pending Documents</li>
		                        <li>
		                            <ul class="menu">

		                            < ?php
		                                $pendings = DocumentTracker::find()
		                                            ->joinWith('userinfo')
		                                            ->joinWith('user')
		                                            ->where(['dtr_status'=>2])
		                                            ->orderBy([
		                                               'doc_tracker.id' => SORT_DESC,
		                                            ])
		                                            ->limit(5)
		                                            ->all();

		                                foreach ($pendings as $key => $value) {
		                                     echo '<li>
		                                        <a href="/mudcrab/document/pending?DocumentTrackerPendingSearch%5Bdtr_id%5D='.$value->dtr_id.'">
		                                            <div class="pull-left">
		                                                <img src="'.Yii::$app->request->baseUrl.Yii::$app->user->identity->profile_pic.'" class="img-circle" alt="User Image"/>
		                                            </div>
		                                            <h4>
		                                                <i style="font-weight:bold;">'.$value->user->username.'</i>
		                                                <small class="text-muted">
		                                                    <i class="glyphicon glyphicon-time"></i>
		                                                <abbr class="timeago" title=' . date('c', strtotime($value->dtr_doc_date_encoded)) . '>' . date_format(date_create($value->dtr_doc_date_encoded), "F d, Y") . '</abbr> 
		                                                </small>
		                                            </h4>
		                                            <p>'.$value->dtr_subj.'</p>
		                                        </a>
		                                    </li>';
		                                }
		                            ?>

		                            </ul>
		                        </li>
		                        <li class="footer"><a href="/mudcrab/document/pending">See All Pending Documents</a></li>
		                    </ul>
		                </li>
					< ?php endif; ?> -->
	                
	                <!-- Tasks: style can be found in dropdown.less -->
	                <!-- <li class="dropdown tasks-menu">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                        <i class="fa fa-flag-o"></i>
	                        <span class="label label-danger">9</span>
	                    </a>
	                    <ul class="dropdown-menu">
	                        <li class="header">Number of pending documents</li>
	                        <li>
	                            
	                            <ul class="menu">
	                                <li>
	                                    <a href="#">
	                                        <h3>
	                                            Design some buttons
	                                            <small class="pull-right">20%</small>
	                                        </h3>
	                                        <div class="progress xs">
	                                            <div class="progress-bar progress-bar-aqua" style="width: 20%"
	                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
	                                                 aria-valuemax="100">
	                                                <span class="sr-only">20% Complete</span>
	                                            </div>
	                                        </div>
	                                    </a>
	                                </li>
	                                
	                                <li>
	                                    <a href="#">
	                                        <h3>
	                                            Create a nice theme
	                                            <small class="pull-right">40%</small>
	                                        </h3>
	                                        <div class="progress xs">
	                                            <div class="progress-bar progress-bar-green" style="width: 40%"
	                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
	                                                 aria-valuemax="100">
	                                                <span class="sr-only">40% Complete</span>
	                                            </div>
	                                        </div>
	                                    </a>
	                                </li>
	                                
	                                <li>
	                                    <a href="#">
	                                        <h3>
	                                            Some task I need to do
	                                            <small class="pull-right">60%</small>
	                                        </h3>
	                                        <div class="progress xs">
	                                            <div class="progress-bar progress-bar-red" style="width: 60%"
	                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
	                                                 aria-valuemax="100">
	                                                <span class="sr-only">60% Complete</span>
	                                            </div>
	                                        </div>
	                                    </a>
	                                </li>
	                                
	                                <li>
	                                    <a href="#">
	                                        <h3>
	                                            Make beautiful transitions
	                                            <small class="pull-right">80%</small>
	                                        </h3>
	                                        <div class="progress xs">
	                                            <div class="progress-bar progress-bar-yellow" style="width: 80%"
	                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
	                                                 aria-valuemax="100">
	                                                <span class="sr-only">80% Complete</span>
	                                            </div>
	                                        </div>
	                                    </a>
	                                </li>
	                                
	                            </ul>
	                        </li>
	                        <li class="footer">
	                            <a href="#">View all tasks</a>
	                        </li>
	                    </ul>
	                </li> -->
	                <!-- User Account: style can be found in dropdown.less -->
	                <?php if (yii::$app->user->can('_CREATE-USER')) : ?>
	                	<li class="dropdown notifications-menu">
		                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		                        <i class="fa fa-bell-o"></i>
		                        <span class="label label-info"><?= $users = Users::find()->where(['!=','id',1])->count(); ?></span>
		                    </a>
		                    <ul class="dropdown-menu">
		                        <li class="header"><?= $users = Users::find()->where(['!=','id',1])->count(); ?> Registered Users </li>
		                        <li>
		                            <!-- inner menu: contains the actual data -->
		                            <ul class="menu">
		                                <?php
		                                $active = Users::find()->where(['status' => 10])->andWhere(['!=','id',1])->count();
		                                $inactive = Users::find()->where(['status' => 0])->andWhere(['!=','id',1])->count();
		                                echo '
		                                <li>
		                                    <a href="/mudcrab/users-information/index?UsersInformationSearch%5Bstatus%5D=10">
		                                        <i class="fa fa-users text-green"></i>'.$active.' Active Users
		                                    </a>
		                                </li>
		                                <li>
		                                    <a href="/mudcrab/users-information/index?UsersInformationSearch%5Bstatus%5D=0">
		                                        <i class="fa fa-users text-red"></i>'.$inactive.' Inactive Users
		                                    </a>
		                                </li>
		                                ';
		                            ?>
		                            </ul>
		                        </li>
		                        <li class="footer"><a href="/mudcrab/users-information/index">View All Users</a></li>
		                    </ul>
		                </li>
					<?php endif; ?>
	                
	                

	                <li class="dropdown user user-menu">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                        <img src="<?= Yii::$app->request->baseUrl.Yii::$app->user->identity->profile_pic ?>" class="user-image" alt="User Image"/>
	                        <span class="hidden-xs"><?= BaseModel::getUserFullName(Yii::$app->user->identity->id) ?></span>
	                    </a>
	                    <ul class="dropdown-menu">
	                        <!-- User image -->
	                        <li class="user-header">
	                            <img src="<?= Yii::$app->request->baseUrl.Yii::$app->user->identity->profile_pic ?>" class="img-circle"
	                                 alt="User Image"/>

	                            <p>
	                                <?= BaseModel::getUserFullName(Yii::$app->user->identity->id) ?>
	                                <small><?= $usersInfo->position->name . ' - ' . $usersInfo->position->description ?></small>
	                            </p>
	                        </li>
	                        <!-- Menu Body -->
	                        <!-- <li class="user-body">
	                            <div class="col-xs-4 text-center">
	                                <a href="#">Followers</a>
	                            </div>
	                            <div class="col-xs-4 text-center">
	                                <a href="#">Sales</a>
	                            </div>
	                            <div class="col-xs-4 text-center">
	                                <a href="#">Friends</a>
	                            </div>
	                        </li> -->
	                        <!-- Menu Footer-->
	                        <li class="user-footer">
	                            <div class="pull-left">
	                                <?php
	                                	$t = '/mudcrab/users/myaccount';
	                                    echo Html::button('Profile', ['value'=>Url::to($t), 'class' =>'btn btn-default btn-flat modalButtoneditprofile']);
	                                ?>
	                            </div>
	                            <div class="pull-right">
	                                <?= Html::a(
	                                    'Sign out',
	                                    ['/site/logout'],
	                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
	                                ) ?>
	                            </div>
	                        </li>
	                    </ul>
	                </li>

	                <!-- User Account: style can be found in dropdown.less -->
	                <!-- <li>
	                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
	                </li> -->
	            </ul>
	        </div>
	    </nav>
	</header>
</div>

<?php
    Modal::begin(
            [
                //'header' => '<h2>Edit Region</h2>',
                'id' => 'modalupdateprofile',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]
    );
    echo "<div id='modalContent'></div>";
    Modal::end();
?>