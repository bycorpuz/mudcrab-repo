<?php

namespace app\controllers;

use Yii;
use app\models\Supplier;
use app\models\SupplierSearch;
use app\models\ActivityLog;
use app\models\BaseModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SupplierController implements the CRUD actions for Supplier model.
 */
class SupplierController extends Controller
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
     * Lists all Supplier models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('_CREATE-SUPPLIER')){
            $success_counter = 0;

            $searchModel = new SupplierSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $model = new Supplier();

            if ($model->load(Yii::$app->request->post())) {

                $model->name = TRIM($model->name);
                $model->description = TRIM($model->description);
                $model->address = TRIM($model->address);
                $model->email = TRIM($model->email);
                $model->c_num = TRIM($model->c_num);
                $model->tin = TRIM($model->tin);
                $model->account_name = TRIM($model->account_name);
                $model->account_number = TRIM($model->account_number);
                $model->is_company = TRIM($model->is_company);
                $model->flag = 1;

                if ($model->save()){
                    $activityLog = new ActivityLog();
                    $activityLog->module = "SUPPLIER";
                    $activityLog->action = 'added supplier : ' . $model->id . ' ' . $model->name . ' ' . $model->description . ' ' . $model->address . ' ' . $model->email . ' ' . $model->c_num . ' ' . $model->tin . ' ' . $model->account_name . ' ' . $model->account_number . ' ' . BaseModel::getYesNo1($model->is_company);
                    $activityLog->user_id = 0;
                    $activityLog->user_id_log = Yii::$app->user->identity->id;
                    $activityLog->date = date('Y-m-d m:h:s');
                    $activityLog->save();

                    $success_counter += 1;
                }                            

                if ($success_counter>0){
                    Yii::$app->session->setFlash('success',[
                        'type' => 'success',
                        'icon' => 'glyphicon glyphicon-ok-sign',
                        'message' => 'Supplier successfully created!',
                        'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error',[
                        'type' => 'error',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Supplier not updated! Common cause: Duplicate Name/Description.',
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
     * Displays a single Supplier model.
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
     * Creates a new Supplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Supplier();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing Supplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('_EDIT-SUPPLIER')){
            $success_counter = 0;

            $oldModel = $this->findModel($id);
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {

                $model->name = TRIM($model->name);
                $model->description = TRIM($model->description);
                $model->address = TRIM($model->address);
                $model->email = TRIM($model->email);
                $model->c_num = TRIM($model->c_num);
                $model->tin = TRIM($model->tin);
                $model->account_name = TRIM($model->account_name);
                $model->account_number = TRIM($model->account_number);
                $model->is_company = TRIM($model->is_company);

                if ($model->save()) {

                    $activityLog = new ActivityLog();
                    $activityLog->module = "SUPPLIER";
                    $activityLog->action = 'old data : ' . $oldModel->id . ' ' . $oldModel->name . ' ' . $oldModel->description . ' ' . $oldModel->address . ' ' . $oldModel->email . ' ' . $oldModel->c_num . ' ' . $oldModel->tin . ' ' . $oldModel->account_name . ' ' . $oldModel->account_number . ' ' . BaseModel::getYesNo1($oldModel->is_company) . ' ' . '\nnew data : ' . $model->id . ' ' . $model->name . ' ' . $model->description . ' ' . $model->address . ' ' . $model->email . ' ' . $model->c_num . ' ' . $model->tin . ' ' . $model->account_name . ' ' . $model->account_number . ' ' . BaseModel::getYesNo1($model->is_company);
                    $activityLog->user_id = 0;
                    $activityLog->user_id_log = Yii::$app->user->identity->id;
                    $activityLog->date = date('Y-m-d m:h:s');
                    $activityLog->save();

                    $success_counter += 1;
                }

                if ($success_counter>0){
                    Yii::$app->session->setFlash('success',[
                        'type' => 'success',
                        'icon' => 'glyphicon glyphicon-ok-sign',
                        'message' => 'Supplier successfully updated!',
                        'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error',[
                        'type' => 'error',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Supplier not updated! Common cause: Duplicate Data.',
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
     * Deletes an existing Supplier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('_DELETE-SUPPLIER')){
            $success_counter = 0;

            $oldModel = $this->findModel($id);

            if($this->findModel($id)->delete()){

                $activityLog = new ActivityLog();
                $activityLog->module = "SUPPLIER";
                $activityLog->action = 'deleted supplier : ' . $oldModel->id . ' ' . $oldModel->name . ' ' . $oldModel->description . ' ' . $oldModel->address . ' ' . $oldModel->email . ' ' . $oldModel->c_num . ' ' . $oldModel->tin . ' ' . $oldModel->account_name . ' ' . $oldModel->account_number . ' ' . BaseModel::getYesNo1($oldModel->is_company);
                $activityLog->user_id = 0;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $success_counter += 1;
            }
            
            if ($success_counter>0){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Supplier successfully deleted!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('error',[
                    'type' => 'error',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Supplier not deleted!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['index']);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeletemultiple() {
        if(Yii::$app->user->can('_DELETE-MULTIPLE-SUPPLIER')){
            $success_counter = 0;

            $pk = Yii::$app->request->post('row_id');

            foreach ($pk as $key => $value)
            {
                $oldModel = $this->findModel($value);

                $activityLog = new ActivityLog();
                $activityLog->module = "SUPPLIER";
                $activityLog->action = 'deleted supplier : ' . $oldModel->id . ' ' . $oldModel->name . ' ' . $oldModel->description . ' ' . $oldModel->address . ' ' . $oldModel->email . ' ' . $oldModel->c_num . ' ' . $oldModel->tin . ' ' . $oldModel->account_name . ' ' . $oldModel->account_number . ' ' . BaseModel::getYesNo1($oldModel->is_company);
                $activityLog->user_id = 0;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $sql = "DELETE FROM supplier WHERE id = '$value'";
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

    /**
     * Finds the Supplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Supplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supplier::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLogs()
    {   
        if(Yii::$app->user->can('_VIEW-LOGS')){
            $model = ActivityLog::find()->where(['module'=>'SUPPLIER'])->all();
            return $this->renderAjax('logs', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
