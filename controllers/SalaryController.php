<?php

namespace app\controllers;

use Yii;
use app\models\Salary;
use app\models\SalarySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\BaseModel;
use app\models\ActivityLog;

/**
 * SalaryController implements the CRUD actions for Salary model.
 */
class SalaryController extends Controller
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
     * Lists all Salary models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('_CREATE-SALARY')){
            $success_counter = 0;

            $searchModel = new SalarySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $model = new Salary();

            if ($model->load(Yii::$app->request->post())) {

                $model->name = TRIM($model->name);
                $model->description = TRIM($model->description);
                $model->sg = TRIM($model->sg);
                $model->amount = TRIM($model->amount);
                $model->flag = 1;

                if ($model->save()){
                    $activityLog = new ActivityLog();
                    $activityLog->module = "SALARY";
                    $activityLog->action = 'added salary : ' . $model->id . ' ' . $model->name . ' ' . $model->description . ' ' . $model->sg . ' ' . number_format($model->amount, '2','.',',');
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
                        'message' => 'Salary successfully created!',
                        'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error',[
                        'type' => 'error',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Salary not updated! Common cause: Duplicate Name/Description.',
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
     * Displays a single Salary model.
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
     * Creates a new Salary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Salary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing Salary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('_EDIT-SALARY')){
            $success_counter = 0;

            $oldModel = $this->findModel($id);
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {

                $model->name = TRIM($model->name);
                $model->description = TRIM($model->description);
                $model->sg = TRIM($model->sg);
                $model->amount = TRIM($model->amount);

                if ($model->save()) {

                    $activityLog = new ActivityLog();
                    $activityLog->module = "SALARY";
                    $activityLog->action = 'old data : ' . $oldModel->id . ' ' . $oldModel->name . ' ' . $oldModel->description . ' ' . $oldModel->sg . ' ' . number_format($oldModel->amount, '2','.',',') . ' ' . '\nnew data : ' . $model->id . ' ' . $model->name . ' ' . $model->description . ' ' . $model->sg . ' ' . number_format($model->amount, '2','.',',');
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
                        'message' => 'Salary successfully updated!',
                        'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error',[
                        'type' => 'error',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'message' => 'Salary not updated! Common cause: Duplicate Name/Description.',
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
     * Deletes an existing Salary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('_DELETE-SALARY')){
            $success_counter = 0;

            $model = $this->findModel($id);

            if($this->findModel($id)->delete()){

                $activityLog = new ActivityLog();
                $activityLog->module = "SALARY";
                $activityLog->action = 'deleted salary : ' . $model->id . ' ' . $model->name . ' ' . $model->description . ' ' . $model->sg . ' ' . number_format($model->amount, '2','.',',');
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
                    'message' => 'Salary successfully deleted!',
                    'title' => 'Well done, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            } else {
                Yii::$app->session->setFlash('error',[
                    'type' => 'error',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Salary not deleted!',
                    'title' => 'Please try again, ' .  BaseModel::getUserFullName(Yii::$app->user->identity->id) . '.' ,
                ]);
            }
            return $this->redirect(['index']);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Salary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Salary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Salary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeletemultiple() {
        if(Yii::$app->user->can('_DELETE-MULTIPLE-SALARY')){
            $success_counter = 0;

            $pk = Yii::$app->request->post('row_id');

            foreach ($pk as $key => $value)
            {
                $model = $this->findModel($value);

                $activityLog = new ActivityLog();
                $activityLog->module = "SALARY";
                $activityLog->action = 'deleted salary : ' . $model->id . ' ' . $model->name . ' ' . $model->description . ' ' . $model->sg . ' ' . number_format($model->amount, '2','.',',');
                $activityLog->user_id = 0;
                $activityLog->user_id_log = Yii::$app->user->identity->id;
                $activityLog->date = date('Y-m-d m:h:s');
                $activityLog->save();

                $sql = "DELETE FROM salary WHERE id = '$value'";
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
            $model = ActivityLog::find()->where(['module'=>'SALARY'])->all();
            return $this->renderAjax('logs', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
