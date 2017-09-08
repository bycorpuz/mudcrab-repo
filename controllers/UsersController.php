<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Users;
use app\models\UsersInformation;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\BaseModel;
use app\models\ActivityLog;

use yii\web\UploadedFile;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMyaccount(){
        
        $userModel = User::findOne(Yii::$app->user->identity->id);

        $model = new Users();
        $model->id = $userModel->id;
        $model->username = $userModel->username;
        $model->email = $userModel->email;
        $model->position_id = $userModel->position_id;
        $model->salary_id = $userModel->salary_id;

        $modelUser = UsersInformation::findOne(Yii::$app->user->identity->id);

        $modelInfo = new UsersInformation();
        $modelInfo->user_id = $modelUser->user_id;
        $modelInfo->firstName = $modelUser->firstName;
        $modelInfo->middleName = $modelUser->middleName;
        $modelInfo->lastName = $modelUser->lastName;
        $modelInfo->ext_name = $modelUser->ext_name;
        $modelInfo->sex = $modelUser->sex;
        $modelInfo->c_num = $modelUser->c_num;
        $modelInfo->bday = $modelUser->bday;
        $modelInfo->address = $modelUser->address;
        $modelInfo->tin = $modelUser->tin;
        $modelInfo->account_name = $modelUser->account_name;
        $modelInfo->account_number = $modelUser->account_number;

        $usersInfo = Users::find()->joinWith('userinfo')->joinWith('position')->joinWith('salary')->where(['user.id'=>Yii::$app->user->identity->id])->one();
        
        return $this->renderAjax('myaccount', [
            'model' => $model,
            'modelInfo' => $modelInfo,
            'usersInfo' => $usersInfo,
        ]);
    }

    public function actionUseraccount($id){
        
        $userModel = User::findOne($id);

        $model = new Users();
        $model->id = $userModel->id;
        $model->username = $userModel->username;
        $model->email = $userModel->email;
        $model->position_id = $userModel->position_id;
        $model->salary_id = $userModel->salary_id;

        $modelUser = UsersInformation::findOne($id);

        $modelInfo = new UsersInformation();
        $modelInfo->user_id = $modelUser->user_id;
        $modelInfo->firstName = $modelUser->firstName;
        $modelInfo->middleName = $modelUser->middleName;
        $modelInfo->lastName = $modelUser->lastName;
        $modelInfo->ext_name = $modelUser->ext_name;
        $modelInfo->sex = $modelUser->sex;
        $modelInfo->c_num = $modelUser->c_num;
        $modelInfo->bday = $modelUser->bday;
        $modelInfo->address = $modelUser->address;
        $modelInfo->tin = $modelUser->tin;
        $modelInfo->account_name = $modelUser->account_name;
        $modelInfo->account_number = $modelUser->account_number;

        $usersInfo = Users::find()->joinWith('userinfo')->joinWith('position')->joinWith('salary')->where(['user.id'=>$id])->one();
        
        return $this->renderAjax('useraccount', [
            'model' => $model,
            'modelInfo' => $modelInfo,
            'usersInfo' => $usersInfo,
        ]);
    }

    public function actionUpdateuser($id,$module){
        $success_counter = 0;

        $model = User::findOne($id);
        $model->email = TRIM($_POST['email']);
        $model->position_id = $_POST['position_id'];
        $model->salary_id = $_POST['salary_id'];

        $oldModelx = Users::findOne($id);
        $oldModelx_id = $oldModelx->id;
        $oldModelx_email = $oldModelx->email;
        $oldModelx_position_id = $oldModelx->position_id;
        $oldModelx_salary_id = $oldModelx->salary_id; 

        if($model->save()){
            $activityLog = new ActivityLog();
            $activityLog->module = "USER";
            $activityLog->action = 'old employee information: ' . $oldModelx_id . ' ' . 
                                    $oldModelx_email . ' ' . 
                                    BaseModel::getPositionName($oldModelx_position_id) . ' ' . 
                                    BaseModel::getSalaryDescription($oldModelx_salary_id) . ' ' . 
                                    '\nnew employee information: '. $oldModelx_id . ' ' . 
                                    $model->email . ' ' . 
                                    BaseModel::getPositionName($model->position_id) . ' ' . 
                                    BaseModel::getSalaryDescription($model->salary_id);
            $activityLog->user_id = $oldModelx_id;
            $activityLog->user_id_log = Yii::$app->user->identity->id;
            $activityLog->date = date('Y-m-d m:h:s');
            $activityLog->save();

            $success_counter += 1;
        }

        
        if ($module == 'userinformation'){
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Employee information successfully updated!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('danger',[
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Employee information not updated!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['users-information/index']);
        } else {
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Your information successfully updated!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('danger',[
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Your information not updated!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['/index']);
        }
    }

    public function actionUpdateuserinfo($user_id,$module){
        $success_counter = 0;

        $oldModel = UsersInformation::findOne($user_id);
        $oldModel_id = $oldModel->user_id;
        $oldModel_firstName = $oldModel->firstName;
        $oldModel_middleName = $oldModel->middleName;
        $oldModel_lastName = $oldModel->lastName;
        $oldModel_ext_name = $oldModel->ext_name;
        $oldModel_sex = $oldModel->sex;
        $oldModel_c_num = $oldModel->c_num;
        $oldModel_bday = $oldModel->bday;
        $oldModel_address = $oldModel->address;
        $oldModel_tin = $oldModel->tin;
        $oldModel_account_name = $oldModel->account_name;
        $oldModel_account_number = $oldModel->account_number;

        $model = UsersInformation::findOne($user_id);
        $model->firstName = TRIM(ucwords(strtolower($_POST['firstName'])));
        $model->middleName = TRIM(ucwords(strtolower($_POST['middleName'])));
        $model->lastName = TRIM(ucwords(strtolower($_POST['lastName'])));
        $model->ext_name = TRIM(ucwords(strtolower($_POST['ext_name'])));
        $model->sex = TRIM(ucwords(strtolower($_POST['sex'])));
        $model->c_num = TRIM(ucwords(strtolower($_POST['c_num'])));
        $model->bday = TRIM(ucwords(strtolower($_POST['bday'])));
        $model->address = TRIM(ucwords(strtolower($_POST['address'])));
        $model->tin = TRIM(ucwords(strtolower($_POST['tin'])));
        $model->account_name = TRIM(ucwords(strtolower($_POST['account_name'])));
        $model->account_number = TRIM(ucwords(strtolower($_POST['account_number'])));

        if ($model->save(false)){
            $activityLog = new ActivityLog();
            $activityLog->module = "USER";
            $activityLog->action = 'old employee information: ' . $oldModel_id . ' ' . 
                                    $oldModel_firstName . ' ' . 
                                    $oldModel_middleName . ' ' . 
                                    $oldModel_lastName . ' ' . 
                                    $oldModel_ext_name . ' ' . 
                                    $oldModel_sex . ' ' . 
                                    $oldModel_c_num . ' ' . 
                                    $oldModel_bday . ' ' . 
                                    $oldModel_address . ' ' . 
                                    $oldModel_tin . ' ' . 
                                    $oldModel_account_name . ' ' . 
                                    $oldModel_account_number . ' ' . 
                                    '\nnew employee information: '. $oldModel_id . ' ' . 
                                    $model->firstName . ' ' . 
                                    $model->middleName . ' ' . 
                                    $model->lastName . ' ' . 
                                    $model->ext_name . ' ' . 
                                    $model->sex . ' ' . 
                                    $model->c_num . ' ' . 
                                    $model->bday . ' ' . 
                                    $model->address  . ' ' . 
                                    $model->tin  . ' ' . 
                                    $model->account_name  . ' ' . 
                                    $model->account_number
                                    ;
            $activityLog->user_id = $oldModel_id;
            $activityLog->user_id_log = Yii::$app->user->identity->id;
            $activityLog->date = date('Y-m-d m:h:s');
            $activityLog->save();

            $success_counter += 1;
        }

        if ($module == 'userinformation'){
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Employee information successfully updated!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('danger',[
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Employee information not updated!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['users-information/index']);
        } else {
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Your information successfully updated!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('danger',[
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Your information not updated!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['/index']);
        }
    }

    public function actionUpdateaccount($id,$module){
        $success_counter = 0;

        $current_user = User::findOne($id);
        $username = $_POST['users-username'];
        $curPass = $_POST['users-current-password'];
        $newPass = $_POST['users-new-password'];

        if (Yii::$app->getSecurity()->validatePassword($curPass, $current_user->password_hash)) {
            $hash = Yii::$app->getSecurity()->generatePasswordHash($newPass);
            $current_user->password_hash = $hash;
            $current_user->username = $username;
        } else {
            Yii::$app->session->setFlash('danger',[
                'type' => 'danger',
                'icon' => 'glyphicon glyphicon-remove-sign',
                'message' => 'User account not updated!',
                'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
            ]);
        }

        $oldModelx = Users::findOne($id);
        $oldModelx_id = $oldModelx->id;
        $oldModelx_username = $oldModelx->username;
        $oldModelx_password_hash = $oldModelx->password_hash;

        if($current_user->save()){
            $activityLog = new ActivityLog();
            $activityLog->module = "USER";
            $activityLog->action = 'old user account: ' . $oldModelx_id . ' ' . 
                                    $oldModelx_username . ' ' . 
                                    $oldModelx_password_hash . ' ' . 
                                    '\nnew user account: '. $oldModelx_id . ' ' . 
                                    $current_user->username . ' ' . 
                                    $current_user->password_hash;
            $activityLog->user_id = $oldModelx_id;
            $activityLog->user_id_log = Yii::$app->user->identity->id;
            $activityLog->date = date('Y-m-d m:h:s');
            $activityLog->save();

            $success_counter += 1;
        }

        if ($module == 'userinformation'){
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Employee account successfully updated!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('danger',[
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Employee account not updated!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['users-information/index']);
        } else {
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Your account successfully updated!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('danger',[
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Your account not updated!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['/index']);
        }
    }

    public function actionUpdateprofilepicture($id,$module){
        $success_counter = 0;

        $model = new Users();

        if ($model->load(Yii::$app->request->post())){
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('uploads/profile_pictures/'. $id . '-' . $model->file->name);
            
            $modelx = User::findOne($id);

            $modelx->profile_pic= "/uploads/profile_pictures/". $id . '-' . $model->file->name;

            if($modelx->save()){

                $activityLog = new ActivityLog();
                $activityLog->module = "USER";
                $activityLog->action = 'updated profile picture';
                $activityLog->user_id = $id;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $success_counter += 1;
            }
        } 
        
        if ($module == 'userinformation'){
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Employee profile picture successfully updated!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('danger',[
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Employee profile picture not updated!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['users-information/index']);
        } else {
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Your profile picture successfully updated!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('danger',[
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Your profile picture not updated!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['/index']);
        }
    }

    public function actionCheckuser(){
        $username = $_POST['username'];

        $model = User::find()->where(['username'=>$username])->one();
        return count($model); //if > 0
    }

    public function actionChecknewemail(){
        $email = $_POST['email'];

        $model = User::find()->where(['email'=>$email])->one();
        return count($model);
    }


    public function actionCheckusername(){
        $username = $_POST['username'];
        $id = $_POST['id'];

        $model = User::find()->where(['username'=>$username])->andWhere('id != :id',['id' => $id])->one(); //ok ra kung imong kaugalingong username
        return count($model); //if > 0
    }

    public function actionCheckemail(){
        $email = $_POST['email'];
        $id = $_POST['id'];

        $model = User::find()->where(['email'=>$email])->andWhere('id != :id',['id' => $id])->one();
        return count($model);
    }



    public function actionCheckpassword(){
        $id = $_POST['id'];

        $current_user=User::findOne($id);

        if (Yii::$app->getSecurity()->validatePassword(filter_input(INPUT_POST, 'current_password'), $current_user->password_hash)) {
            return 1;
        } else {
            return 0;
        }
    }

}
