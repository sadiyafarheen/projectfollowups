<?php

namespace app\controllers;

use app\components\QueryHelper;
use app\models\Projects;
use app\models\ProjectSearch;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ProjectController implements the CRUD actions for Projects model.
 */
class ProjectController extends Controller
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
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (QueryHelper::isAllowed($model->category_id)) {
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
                if (empty($model->custom_field)) {
                    $model->custom_field = "TBD";
                }
                if (empty($model->assigned_to)) {
                    $model->assigned_to = "Myself";
                }
                if (empty($model->priority)) {
                    $model->priority = "Medium";
                }
                if (empty($model->stake_holder)) {
                    $model->stake_holder = "TBD";
                }
                if ($model->save()) {
                    Yii::$app->session->set('new', base64_encode($model->id));
                    Yii::$app->session->set('expand', 1);
                    return $this->redirect(['category/view', 'id' => base64_encode($model->category_id)]);
                }
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $type = 1)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        $cat_id = $model->category_id;
        if (QueryHelper::isAllowed($model->category_id)) {
            if ($type == 1) {
                $model->delete();
                return $this->redirect(['category/view', 'id' => base64_encode($cat_id)]);
            } else if ($type == 2) {
                $model->delete();
                return $this->redirect(['category/notes-view', 'id' => base64_encode($cat_id)]);
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdates($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if (!empty($model)) {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChangeFocus($id)
    {
        $model = $this->findModel($id);
        if ($model->is_focus) {
            $model->is_focus = 0;
        } else {
            $model->is_focus = 1;
        }
        $model->save(false);
    }

    public function actionAllCheckFocus()
    {
        $user = User::findOne(Yii::$app->user->id);
        foreach ($user->projects as $project) {
            $project->is_focus = 1;
            $project->save(false);
        }
    }

    public function actionAllUncheckFocus()
    {
        $user = User::findOne(Yii::$app->user->id);
        foreach ($user->projects as $project) {
            $project->is_focus = 0;
            $project->save(false);
        }
    }

    public function actionSaveInfo($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save(false)){
                return $this->redirect(['category/clean-view', 'id' => base64_encode($model->category_id)]);
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
