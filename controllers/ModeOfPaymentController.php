<?php

namespace app\controllers;

use Yii;
use app\models\ModeOfPayment;
use app\models\ModeOfPaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\BaseModel;
use app\models\ActivityLog;

/**
 * ModeOfPaymentController implements the CRUD actions for ModeOfPayment model.
 */
class ModeOfPaymentController extends Controller
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
     * Lists all ModeOfPayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('_CREATE-MODE-OF-PAYMENT')){
            $success_counter = 0;

            $searchModel = new ModeOfPaymentSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $model = new ModeOfPayment();

            if ($model->load(Yii::$app->request->post())) {

                $model->name = TRIM($model->name);
                $model->description = TRIM($model->description);
                $model->flag = 1;

                if ($model->save()){
                    $activityLog = new ActivityLog();
                    $activityLog->module = "MODE-OF-PAYMENT";
                    $activityLog->action = 'added mode of payment : ' . $model->id . ' ' . $model->name . ' ' . $model->description;
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
                        'message' => 'Mode of payment successfully created!',
                        'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error',[
                        'type' => 'error',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Mode of payment not updated! Common cause: Duplicate Name/Description.',
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
     * Displays a single ModeOfPayment model.
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
     * Creates a new ModeOfPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new ModeOfPayment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing ModeOfPayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('_EDIT-MODE-OF-PAYMENT')){
            $success_counter = 0;

            $oldModel = $this->findModel($id);
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {

                $model->name = TRIM($model->name);
                $model->description = TRIM($model->description);

                if ($model->save()) {

                    $activityLog = new ActivityLog();
                    $activityLog->module = "MODE-OF-PAYMENT";
                    $activityLog->action = 'old data : ' . $oldModel->id . ' ' . $oldModel->name . ' ' . $oldModel->description . ' ' . '\nnew data : ' . $model->id . ' ' . $model->name . ' ' . $model->description;
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
                        'message' => 'Mode of payment successfully updated!',
                        'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error',[
                        'type' => 'error',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Mode of payment not updated! Common cause: Duplicate Name/Description.',
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
     * Deletes an existing ModeOfPayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('_DELETE-MODE-OF-PAYMENT')){
            $success_counter = 0;

            $model = $this->findModel($id);

            if($this->findModel($id)->delete()){

                $activityLog = new ActivityLog();
                $activityLog->module = "MODE-OF-PAYMENT";
                $activityLog->action = 'deleted mode of payment : ' . $model->id . ' ' . $model->name . ' ' . $model->description;
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
                    'message' => 'Mode of payment successfully deleted!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('error',[
                    'type' => 'error',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Mode of payment not deleted!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['index']);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ModeOfPayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModeOfPayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModeOfPayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeletemultiple() {
        if(Yii::$app->user->can('_DELETE-MULTIPLE-MODE-OF-PAYMENT')){
            $success_counter = 0;

            $pk = Yii::$app->request->post('row_id');

            foreach ($pk as $key => $value)
            {
                $model = $this->findModel($value);

                $activityLog = new ActivityLog();
                $activityLog->module = "MODE-OF-PAYMENT";
                $activityLog->action = 'deleted mode of payment : ' . $model->id . ' ' . $model->name . ' ' . $model->description;
                $activityLog->user_id = 0;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $sql = "DELETE FROM mode_of_payment WHERE id = '$value'";
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
            $model = ActivityLog::find()->where(['module'=>'MODE-OF-PAYMENT'])->all();
            return $this->renderAjax('logs', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
