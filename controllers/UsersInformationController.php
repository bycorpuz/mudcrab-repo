<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\BaseModel;

use app\models\UsersInformation;
use app\models\UsersInformationSearch;
use app\models\ActivityLog;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersInformationController implements the CRUD actions for UsersInformation model.
 */
class UsersInformationController extends Controller
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
     * Lists all UsersInformation models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('_CREATE-USER')){
            $success_counter = 0;

            $searchModel = new UsersInformationSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $model = new UsersInformation();

            if ($model->load(Yii::$app->request->post())) {

                $userModel = new Users();
                $password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);

                $userModel->username = TRIM($model->username);
                $userModel->password_hash = TRIM($password_hash);
                $userModel->email = TRIM($model->email);
                $userModel->status = 10; //10 is for active and inactive is 0
                $userModel->created_at = strtotime(date("Y-m-d H:i:s"));
                $userModel->profile_pic = '/uploads/profile_pictures/avatar.jpg';
                $userModel->position_id = $model->position;
                $userModel->salary_id = $model->salary;

                if ($userModel->save(false)) {
                    $model->user_id = $userModel->id;
                    $model->firstName = TRIM(ucwords(strtolower($model->firstName)));
                    $model->middleName = TRIM(ucwords(strtolower($model->middleName)));
                    $model->lastName = TRIM(ucwords(strtolower($model->lastName)));
                    $model->ext_name = TRIM(ucwords(strtolower($model->ext_name)));
                    $model->sex = TRIM($model->sex);
                    $model->c_num = TRIM($model->c_num);
                    $model->bday = TRIM($model->bday);
                    $model->address = TRIM(ucwords(strtolower($model->address)));
                    $model->tin = $model->tin;
                    $model->account_name = $model->account_name;
                    $model->account_number = $model->account_number;

                    if ($model->save(false)){
                        $activityLog = new ActivityLog();
                        $activityLog->module = "USER";
                        $activityLog->action = 'added user : ' . $model->id . ' ' . 
                                                $model->firstName . ' ' . 
                                                $model->middleName . ' ' . 
                                                $model->lastName . ' ' . 
                                                $model->ext_name . ' ' . 
                                                $model->sex . ' ' . 
                                                $model->bday . ' ' . 
                                                $model->c_num . ' ' . 
                                                $model->address . ' ' . 
                                                $model->username . ' ' . 
                                                $model->password . ' ' . 
                                                $model->email . ' ' . 
                                                $model->tin . ' ' . 
                                                $model->account_name . ' ' . 
                                                $model->account_number
                                                ;
                        $activityLog->user_id = $model->user_id;
                        $activityLog->user_id_log = Yii::$app->user->identity->id;
                        $activityLog->date = date('Y-m-d m:h:s');
                        $activityLog->save();

                        $success_counter += 1;
                    }
                }

                if ($success_counter>0){
                    Yii::$app->session->setFlash('success',[
                        'type' => 'success',
                        'icon' => 'glyphicon glyphicon-ok-sign',
                        'message' => 'Employee successfully created.',
                        'title' => 'Well done, ' . Yii::$app->user->identity->username . '!',
                    ]);
                } else {
                    Yii::$app->session->setFlash('danger',[
                        'type' => 'danger',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Employee not created',
                        'title' => 'Please try again!',
                    ]);
                }

                return $this->redirect(['index']);
            } else {
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }        
    }

    /**
     * Displays a single UsersInformation model.
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
     * Creates a new UsersInformation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new UsersInformation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing UsersInformation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('_EDIT-USER')){
            $success_counter = 0;

            $oldModel = $this->findModel($id);
            $oldModelx = Users::findOne($id);

            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $oldModelx_username = $oldModelx->username;
                $oldModelx_password_hash = $oldModelx->password_hash;
                $oldModelx_email = $oldModelx->email;
                $oldModelx_position_id = $oldModelx->position_id;
                $oldModelx_salary_id = $oldModelx->salary_id; 

                $password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                
                $userModel = Users::findOne($id);
                $userModel->username = TRIM($model->username);
                $userModel->password_hash = TRIM($password_hash);
                $userModel->email = TRIM($model->email);
                $userModel->position_id = $model->position;
                $userModel->salary_id = $model->salary;

                if ($userModel->save(false)) {
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

                    $model->firstName = TRIM(ucwords(strtolower($model->firstName)));
                    $model->middleName = TRIM(ucwords(strtolower($model->middleName)));
                    $model->lastName = TRIM(ucwords(strtolower($model->lastName)));
                    $model->ext_name = TRIM(ucwords(strtolower($model->ext_name)));
                    $model->sex = TRIM($model->sex);
                    $model->c_num = TRIM($model->c_num);
                    $model->bday = TRIM($model->bday);
                    $model->address = TRIM(ucwords(strtolower($model->address)));
                    $model->tin = TRIM(ucwords(strtolower($model->tin)));
                    $model->account_name = TRIM(ucwords(strtolower($model->account_name)));
                    $model->account_number = TRIM(ucwords(strtolower($model->account_number)));

                    if ($model->save(false)){
                        $activityLog = new ActivityLog();
                        $activityLog->module = "USER";
                        $activityLog->action = 'old user data: ' . $oldModel_id . ' ' . 
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
                                                $oldModelx_username . ' ' . 
                                                $oldModelx_password_hash . ' ' . 
                                                $oldModelx_email . ' ' . 
                                                BaseModel::getPositionName($oldModelx_position_id) . ' ' . 
                                                BaseModel::getSalaryDescription($oldModelx_salary_id) . ' ' . 
                                                '\nnew user data: '. $oldModel_id . ' ' . 
                                                $model->firstName . ' ' . 
                                                $model->middleName . ' ' . 
                                                $model->lastName . ' ' . 
                                                $model->ext_name . ' ' . 
                                                $model->sex . ' ' . 
                                                $model->c_num . ' ' . 
                                                $model->bday . ' ' . 
                                                $model->address . ' ' . 
                                                $model->tin . ' ' . 
                                                $model->account_name . ' ' . 
                                                $model->account_number . ' ' . 
                                                $userModel->username . ' ' . 
                                                $userModel->password_hash . ' ' . 
                                                $userModel->email . ' ' . 
                                                BaseModel::getPositionName($userModel->position_id) . ' ' . 
                                                BaseModel::getSalaryDescription($userModel->salary_id);
                        $activityLog->user_id = $oldModel_id;
                        $activityLog->user_id_log = Yii::$app->user->identity->id;
                        $activityLog->date = date('Y-m-d m:h:s');
                        $activityLog->save();

                        $success_counter += 1;
                    }
                }

                if ($success_counter>0){
                    Yii::$app->session->setFlash('success',[
                        'type' => 'success',
                        'icon' => 'glyphicon glyphicon-ok-sign',
                        'message' => 'Employee successfully updated.',
                        'title' => 'Well done, ' . Yii::$app->user->identity->username . '!',
                    ]);
                } else {
                    Yii::$app->session->setFlash('danger',[
                        'type' => 'danger',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Employee not updated',
                        'title' => 'Please try again!',
                    ]);
                }

                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }   
    }

    /**
     * Deletes an existing UsersInformation model.
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
     * Finds the UsersInformation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersInformation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersInformation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionActivation() {
        if(Yii::$app->user->can('_ACTIVATE-USER')){
            $success_counter = 0;
            if (Yii::$app->request->isAjax) {
                $user_id = filter_input(INPUT_POST, 'user_id');
                $status = filter_input(INPUT_POST, 'status');

                if ($status == 0){
                    $status = 10;
                    $status1 = "ACTIVE";
                } else {
                    $status = 0;
                    $status1 = "INACTIVE";
                }

                $sql = "UPDATE `user` SET `status` = $status WHERE `user`.`id` = '$user_id'";
                $query = Yii::$app->db->createCommand($sql)->execute();

                $activityLog = new ActivityLog();
                $activityLog->module = "USER STATUS";
                $activityLog->action = "Updated user status to: " . $status1;
                $activityLog->user_id = $user_id;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $success_counter += 1;

            } else {
                return $this->redirect(['index']);
            }
            
            if ($success_counter>0){
                return true;
            } else {
                return false;
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        } 
    }

    public function actionChangepassword() {
        $success_counter = 0;
        if (Yii::$app->request->isAjax) {
            $user_id = filter_input(INPUT_POST, 'user_id');

            $defaultPass = "password";
            $password_hash = Yii::$app->getSecurity()->generatePasswordHash($defaultPass);

            $sql = "UPDATE `user` SET `password_hash` = '$password_hash' WHERE `user`.`id` = '$user_id'";
            $query = Yii::$app->db->createCommand($sql)->execute();

            $activityLog = new ActivityLog();
            $activityLog->module = "USER STATUS";
            $activityLog->action = "Updated user password to: password";
            $activityLog->user_id = $user_id;
            $activityLog->user_id_log = Yii::$app->user->identity->id;
            $activityLog->date = date('Y-m-d m:h:s');
            $activityLog->save();

            $success_counter += 1;

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        if ($success_counter>0){
            return true;
        } else {
            return false;
        }
    }

    public function actionChangemultiplepassword() {
        $success_counter = 0;

        $pk = Yii::$app->request->post('row_id');
        if($pk){
            foreach ($pk as $key => $value) 
            {
                $defaultPass = "password";
                $password_hash = Yii::$app->getSecurity()->generatePasswordHash($defaultPass);

                $sql = "UPDATE `user` SET `password_hash` = '$password_hash' WHERE `user`.`id` = '$value'";
                $query = Yii::$app->db->createCommand($sql)->execute();

                $activityLog = new ActivityLog();
                $activityLog->module = "USER STATUS";
                $activityLog->action = "Updated user password to: password";
                $activityLog->user_id = $value;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $success_counter += 1;
            }
            if ($success_counter>0){
                return true;
            } else {
                return false;
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        } 
    }


    public function actionDeletemultiple() {
        $success_counter = 0;

        $pk = Yii::$app->request->post('row_id');
        if($pk){
            foreach ($pk as $key => $value) 
            {

                $user = Users::findone($value);

                if ($user->status == 0){
                    $status = 10;
                    $status1 = "ACTIVE";
                } else {
                    $status = 0;
                    $status1 = "INACTIVE";
                }

                $sql = "UPDATE `user` SET `status` = $status WHERE `user`.`id` = '$value'";
                $query = Yii::$app->db->createCommand($sql)->execute();

                $activityLog = new ActivityLog();
                $activityLog->module = "USER STATUS";
                $activityLog->action = "Updated user status to: " . $status1;
                $activityLog->user_id = $value;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $success_counter += 1;
            }
            if ($success_counter>0){
                return true;
            } else {
                return false;
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        } 
    }

    public function actionLogs()
    {   
        if(Yii::$app->user->can('_VIEW-LOGS')){
            $model = ActivityLog::find()->where(['module'=>'USER STATUS'])->orWhere(['module'=>'USER'])->all();
            return $this->renderAjax('logs', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
