<?php

namespace app\controllers;

use app\models\Tasks;
use app\models\TaskSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TaskController implements the CRUD actions for Tasks model.
 */
class TaskController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();
        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->start_date) || empty($model->end_date)) {
                if (empty($model->start_date)) {
                    $model->start_date = date("Y-m-d");
                } else {
                    $model->start_date = date("Y-m-d", strtotime($model->start_date));
                }
                if (empty($model->end_date)) {
                    $model->end_date = date("Y-m-d", strtotime("$model->start_date +14 days"));
                } else {
                    $model->end_date = date("Y-m-d", strtotime("$model->end_date"));
                }
            } else {
                $model->start_date = date("Y-m-d", strtotime($model->start_date));
                $model->end_date = date("Y-m-d", strtotime($model->end_date));
            }
            if (empty($model->status)) {
                $model->status = "New";
            }
            if (empty($model->phase)) {
                $model->phase = "TBD";
            }
            if (empty($model->assigned_to)) {
                $model->assigned_to = "Myself";
            }
            if (empty($model->more_info)) {
                $model->more_info = "None";
            }
            if ($model->save()) {
                Yii::$app->session->set('new', base64_encode($model->project_id));
                Yii::$app->session->set('expand', 1);
                return $this->redirect(['category/view', 'id' => base64_encode($model->project->category_id)]);
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $type = 1)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        $cat_id = $model->project->category_id;
        if ($type == 1) {
            $model->delete();
            return $this->redirect(['category/view', 'id' => base64_encode($cat_id)]);
        } else if ($type == 2) {
            $model->delete();
            return $this->redirect(['category/notes-view', 'id' => base64_encode($cat_id)]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
