<?php

namespace app\controllers;

use Yii;
use app\models\TransactionLabor;
use app\models\TransactionDirectLaborSearch;
use app\models\ActivityLog;
use app\models\BaseModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransactionDirectLaborController implements the CRUD actions for TransactionLabor model.
 */
class TransactionDirectLaborController extends Controller
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
     * Lists all TransactionLabor models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('_CREATE-DIRECT-LABOR')){
            $success_counter = 0;

            $searchModel = new TransactionDirectLaborSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $model = new TransactionLabor();

            if ($model->load(Yii::$app->request->post())) {
                
                $model->date_encoded = date("Y-m-d H:i:s");
                $model->or_number = 'EX-' . strtotime(date("Y-m-d H:i:s"));
                $model->mode = 'DIRECT LABOR';
                $model->flag = 1;

                if ($model->save(false)){
                    $activityLog = new ActivityLog();
                    $activityLog->module = "DIRECT LABOR";
                    $activityLog->action = 'added direct labor : ' . $model->id . ' ' . BaseModel::getAccountTitle1($model->account_title_id) . ' ' . BaseModel::getuserFullName($model->user_id) . ' ' . $model->or_number . ' ' . number_format($model->amount, '2','.',',') . ' ' . BaseModel::getModeOfPayment1($model->mode_of_payment_id) . ' ' . $model->date_encoded . ' ' . $model->remarks;
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
                        'message' => 'Direct labor successfully created.',
                        'title' => 'Well done, ' . Yii::$app->user->identity->username . '!',
                    ]);
                } else {
                    Yii::$app->session->setFlash('danger',[
                        'type' => 'danger',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Direct labor not created',
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
     * Displays a single TransactionLabor model.
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
     * Creates a new TransactionLabor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new TransactionLabor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing TransactionLabor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('_EDIT-DIRECT-LABOR')){
            $success_counter = 0;

            $oldModel = $this->findModel($id);
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {

                if ($model->save()) {

                    $activityLog = new ActivityLog();
                    $activityLog->module = "DIRECT LABOR";
                    $activityLog->action = 'old data : ' . $oldModel->id . ' ' . BaseModel::getAccountTitle1($oldModel->account_title_id) . ' ' . BaseModel::getuserFullName($oldModel->user_id) . ' ' . $oldModel->or_number . ' ' . number_format($oldModel->amount, '2','.',',') . ' ' . BaseModel::getModeOfPayment1($oldModel->mode_of_payment_id) . ' ' . $oldModel->date_encoded . ' ' . $oldModel->remarks . ' ' . '\nnew data : ' . $model->id . ' ' . BaseModel::getAccountTitle1($model->account_title_id) . ' ' . BaseModel::getuserFullName($model->user_id) . ' ' . $model->or_number . ' ' . number_format($model->amount, '2','.',',') . ' ' . BaseModel::getModeOfPayment1($model->mode_of_payment_id) . ' ' . $model->date_encoded . ' ' . $model->remarks;
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
                        'message' => 'Direct labor successfully updated!',
                        'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error',[
                        'type' => 'error',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Direct labor not updated! Common cause: Duplicate Name/Description.',
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
     * Deletes an existing TransactionLabor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('_DELETE-DIRECT-LABOR')){
            $success_counter = 0;

            $model = $this->findModel($id);

            if($this->findModel($id)->delete()){

                $activityLog = new ActivityLog();
                $activityLog->module = "DIRECT LABOR";
                $activityLog->action = 'delete direct labor : ' . $model->id . ' ' . BaseModel::getAccountTitle1($model->account_title_id) . ' ' . BaseModel::getuserFullName($model->user_id) . ' ' . $model->or_number . ' ' . number_format($model->amount, '2','.',',') . ' ' . BaseModel::getModeOfPayment1($model->mode_of_payment_id) . ' ' . $model->date_encoded . ' ' . $model->remarks;
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
                    'message' => 'Direct labor  successfully deleted!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('error',[
                    'type' => 'error',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Direct labor  not deleted!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['index']);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeletemultiple() {
        if(Yii::$app->user->can('_DELETE-MULTIPLE-DIRECT-LABOR')){
            $success_counter = 0;

            $pk = Yii::$app->request->post('row_id');

            foreach ($pk as $key => $value)
            {
                $model = $this->findModel($value);

                $activityLog = new ActivityLog();
                    $activityLog->module = "DIRECT LABOR";
                    $activityLog->action = 'delete direct labor : ' . $model->id . ' ' . BaseModel::getAccountTitle1($model->account_title_id) . ' ' . BaseModel::getuserFullName($model->user_id) . ' ' . $model->or_number . ' ' . number_format($model->amount, '2','.',',') . ' ' . BaseModel::getModeOfPayment1($model->mode_of_payment_id) . ' ' . $model->date_encoded . ' ' . $model->remarks;
                    $activityLog->user_id = 0;
                    $activityLog->user_id_log = Yii::$app->user->identity->id;
                    $activityLog->date = date('Y-m-d m:h:s');
                    $activityLog->save();

                    $success_counter += 1;

                $sql = "DELETE FROM transaction_labor WHERE id = '$value'";
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
     * Finds the TransactionLabor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransactionLabor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransactionLabor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLogs()
    {   
        if(Yii::$app->user->can('_VIEW-LOGS')){
            $model = ActivityLog::find()->where(['module'=>'DIRECT LABOR'])->all();
            return $this->renderAjax('logs', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
