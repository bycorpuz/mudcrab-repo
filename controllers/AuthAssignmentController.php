<?php

namespace app\controllers;

use Yii;
use app\models\AuthAssignment;
use app\models\AuthAssignmentSearch;
use app\models\BaseModel;
use app\models\ActivityLog;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthAssignmentController extends Controller
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
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('_CREATE-ACCESS')){
            $success_counter = 0;

            $searchModel = new AuthAssignmentSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $model = new AuthAssignment();

            if ($model->load(Yii::$app->request->post())) {

                    $array_access = $model->item_name; 
                    $array_user = $model->user_id; 

                    foreach ($array_user as $value_user) { 
                        foreach ($array_access as $value_access) { 
                            $model = new AuthAssignment();
                            $model->item_name = $value_access; 
                            $model->user_id = $value_user; 
                            
                            if ($model->save()){
                                $activityLog = new ActivityLog();
                                $activityLog->module = "USER ACCESS";
                                $activityLog->action = 'added access : ' . $model->id . ' ' . BaseModel::itemnameDescription($model->item_name) . ' ' . BaseModel::getuserFullName($model->user_id);
                                $activityLog->user_id = $model->user_id;
                                $activityLog->user_id_log = Yii::$app->user->identity->id;
                                $activityLog->date = date('Y-m-d m:h:s');
                                $activityLog->save();

                                $success_counter += 1;
                            }                            
                        }
                    }

                    if ($success_counter>0){
                        Yii::$app->session->setFlash('success',[
                            'type' => 'success',
                            'icon' => 'glyphicon glyphicon-ok-sign',
                            'message' => 'Access successfully created!',
                            'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                        ]);
                    } else {
                        Yii::$app->session->setFlash('error',[
                            'type' => 'error',
                            'icon' => 'glyphicon glyphicon-remove-sign',
                            'message' => 'Access not created!',
                            'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
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
     * Displays a single AuthAssignment model.
     * @param integer $id
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    /*public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new AuthAssignment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        
    }*/

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('_EDIT-ACCESS')){
            $success_counter = 0;

            $oldModel = $this->findModel($id);
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()) {

                    $activityLog = new ActivityLog();
                    $activityLog->module = "USER ACCESS";
                    $activityLog->action = 'old access : ' . $oldModel->id . ' ' . BaseModel::itemnameDescription($oldModel->item_name) . ' ' . BaseModel::getuserFullName($oldModel->user_id) . ' ' . '\nnew access : ' . $model->id . ' ' . BaseModel::itemnameDescription($model->item_name) . ' ' . BaseModel::getuserFullName($model->user_id);
                    $activityLog->user_id = $oldModel->user_id;
                    $activityLog->user_id_log = Yii::$app->user->identity->id;
                    $activityLog->date = date('Y-m-d m:h:s');
                    $activityLog->save();

                    $success_counter += 1;
                }

                if ($success_counter>0){
                    Yii::$app->session->setFlash('success',[
                        'type' => 'success',
                        'icon' => 'glyphicon glyphicon-ok-sign',
                        'message' => 'Access successfully updated!',
                        'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error',[
                        'type' => 'error',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Access not updated!',
                        'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
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
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('_DELETE-ACCESS')){
            $success_counter = 0;

            $oldModel = $this->findModel($id);

            if($this->findModel($id)->delete()){

                $activityLog = new ActivityLog();
                $activityLog->module = "USER ACCESS";
                $activityLog->action = 'deleted access : ' . $oldModel->id . ' ' . BaseModel::itemnameDescription($oldModel->item_name) . ' ' . BaseModel::getuserFullName($oldModel->user_id);
                $activityLog->user_id = $oldModel->user_id;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $success_counter += 1;
            }
            
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Access successfully deleted!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('error',[
                    'type' => 'error',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Access not deleted!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['index']);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $item_name
     * @param string $user_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthAssignment::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSaveuseraccess(){
        $model = new AuthAssignment();
        if (Yii::$app->request->isAjax) {
            $item_name = filter_input(INPUT_POST, 'item_name');
            $user_id = filter_input(INPUT_POST, 'user_id');
            $created_at = strtotime(date("Y-m-d H:i:s"));

            $model->item_name = TRIM($item_name);
            $model->user_id = TRIM($user_id);
            $model->created_at = TRIM($created_at);
            
            if ($model->save()){
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
                $oldModel = $this->findModel($value);
                $activityLog = new ActivityLog();
                $activityLog->module = "USER ACCESS";
                $activityLog->action = 'deleted access : ' . $oldModel->id . ' ' . BaseModel::itemnameDescription($oldModel->item_name) . ' ' . BaseModel::getuserFullName($oldModel->user_id);
                $activityLog->user_id = $oldModel->user_id;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $sql = "DELETE FROM auth_assignment WHERE id = '$value'";
                $query = Yii::$app->db->createCommand($sql)->execute();

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
            $model = ActivityLog::find()->where(['module'=>'USER ACCESS'])->all();
            return $this->renderAjax('logs', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
