<?php

namespace app\controllers;

use Yii;
use app\models\Pulse;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Updates;
use app\models\ProjectUpdates;

/**
 * PulseController implements the CRUD actions for Pulse model.
 */
class PulseController extends Controller
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
     * Lists all Pulse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pulse::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pulse model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pulse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pulse();

        if ($model->load(Yii::$app->request->post())) {
            //$model->save();
            print_r(Yii::$app->request->post());
            if (!empty($_POST['accomplishment'])) {
                    $model = new Updates();
                    $model->update_type = 'Accomplishment';
                    $model->update_text = $_POST['accomplishment'];
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $pu_model = new ProjectUpdates();
                        $pu_model->project_id = $pid;
                        $pu_model->user_id = $uid;
                        $pu_model->update_id = $model->id;
                        $pu_model->save();
                    }
                }
                if (!empty($_POST['concern'])) {
                    $model = new Updates();
                    $model->update_type = 'Concern';
                    $model->update_text = $_POST['concern'];
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $pu_model = new ProjectUpdates();
                        $pu_model->project_id = $pid;
                        $pu_model->user_id = $uid;
                        $pu_model->update_id = $model->id;
                        $pu_model->save();
                    }
                }
                if (!empty($_POST['decision'])) {
                    $model = new Updates();
                    $model->update_type = 'Decision';
                    $model->update_text = $_POST['decision'];
                    $model->is_close = 1;
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $pu_model = new ProjectUpdates();
                        $pu_model->project_id = $pid;
                        $pu_model->user_id = $uid;
                        $pu_model->update_id = $model->id;
                        $pu_model->save();
                    }
                }
                if (!empty($_POST['followup'])) {
                    $model = new Updates();
                    $model->update_type = 'Follow Up';
                    $model->update_text = $_POST['followup'];
                    if (!empty($_POST['due_date'])) {
                        $model->due_date = date('Y-m-d', strtotime($_POST['due_date']));
                    }
                    if (!empty($_POST['assigned_to'])) {
                        $model->assigned_to = $_POST['assigned_to'];
                        preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $model->assigned_to, $emails);
                        foreach ($emails[0] as $email){
                            QueryHelper::shareCategory("", $email, $project->category_id);
                        }
                    }
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $pu_model = new ProjectUpdates();
                        $pu_model->project_id = $pid;
                        $pu_model->user_id = $uid;
                        $pu_model->update_id = $model->id;
                        if ($pu_model->save()) {
                            $perms = QueryHelper::getAllowedUsers($pu_model->project->category_id);
                            foreach ($perms as $perm) {
                                $sub = $pu_model->user->username . '  has added or Updated a follow up to the project ' . $pu_model->project->title;
                                $html = "";
                                if(!empty($model->due_date)){
                                    $html = "'<i>{$model->update_text}</i>' Due by <b>" . date('m/d/Y', strtotime($model->due_date)) . "</b><br/>";
                                }else{
                                    $html = "'<i>{$model->update_text}</i>'<br/>";
                                }
                                $html = $html . "<a href='http://" . Yii::$app->params['siteUrl'] . "/category/clean-view?id=" . base64_encode($pu_model->project->category_id)."'>
                                            Click here to access the projects in the {$pu_model->project->category->name} Topic
                                         </a>";
                                EmailHelper::Send($perm->user->email, Yii::$app->params['adminEmail'], $sub, $html);
                            }
                        }
                    }
                }
                if (!empty($_POST['notes'])) {
                    $model = new Updates();
                    $model->update_type = 'Notes';
                    $model->update_text = $_POST['notes'];
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $pu_model = new ProjectUpdates();
                        $pu_model->project_id = $pid;
                        $pu_model->user_id = $uid;
                        $pu_model->update_id = $model->id;
                        $pu_model->save();
                    }
                }
            die();
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pulse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pulse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pulse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pulse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pulse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
