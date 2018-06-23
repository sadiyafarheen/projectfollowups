<?php

namespace app\controllers;

use app\components\ConversionHelper;
use app\components\EmailHelper;
use app\components\QueryHelper;
use app\models\Categories;
use app\models\CategoryUpdates;
use app\models\Projects;
use app\models\ProjectUpdates;
use app\models\Updates;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

/**
 * UpdateController implements the CRUD actions for Projects model.
 */
class UpdateController extends Controller
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

    public function actionEdit($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->is_close = (!empty($_POST['is_close']) && ($_POST['is_close'] == 'on')) ? 1 : 0;
            $model->save();
        }
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Updates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Updates::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelete($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if ($model->projectUpdates[0]->user_id == Yii::$app->user->id) {
            $model->delete();
        }
    }

    public function actionDeleteCategoryUpdate($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if ($model->categoryUpdates[0]->user_id == Yii::$app->user->id) {
            $category_update = CategoryUpdates::find()->where(['update_id' => $model->id])->one();
            $category_update->delete();
            $model->delete();
        }
    }

    public function actionProjectNew()
    {
        if (Yii::$app->request->post()) {
            $pid = $_POST['project'];
            $uid = Yii::$app->user->id;
            $project = Projects::findOne($pid);
            if (!empty($project)) {
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
                /*if (!empty($_POST['followup2'])) {
                    $model = new Updates();
                    $model->update_type = 'Follow Up';
                    $model->update_text = $_POST['followup2'];
                    if (!empty($_POST['due_date2'])) {
                        $model->due_date = date('Y-m-d', strtotime($_POST['due_date2']));
                    }
                    if (!empty($_POST['assigned_to2'])) {
                        $model->assigned_to = $_POST['assigned_to2'];
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
                                $html = "<p>'<i>{$model->update_text}</i>' Due by <b>" . date('d/m/Y', strtotime($model->due_date)) . "</b></p>
                                         <br/><br/>
                                         <a href='" . Url::to(['category/view', 'id' => base64_encode($pu_model->project->category_id)]) . "'>
                                            (Click here to access the projects in the {$pu_model->project->category->name} Topic)
                                         </a>";
                                EmailHelper::Send($perm->user->email, Yii::$app->params['adminEmail'], $sub, $html);
                            }
                        }
                    }
                }*/
                /*if (!empty($_POST['followup3'])) {
                    $model = new Updates();
                    $model->update_type = 'Follow Up';
                    $model->update_text = $_POST['followup3'];
                    if (!empty($_POST['due_date3'])) {
                        $model->due_date = date('Y-m-d', strtotime($_POST['due_date3']));
                    }
                    if (!empty($_POST['assigned_to3'])) {
                        $model->assigned_to = $_POST['assigned_to3'];
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
                                $html = "<p>'<i>{$model->update_text}</i>' Due by <b>" . date('d/m/Y', strtotime($model->due_date)) . "</b></p>
                                         <br/><br/>
                                         <a href='" . Url::to(['category/view', 'id' => base64_encode($pu_model->project->category_id)]) . "'>
                                            (Click here to access the project(s) in the {$pu_model->project->category->name} category)
                                         </a>";
                                EmailHelper::Send($perm->user->email, Yii::$app->params['adminEmail'], $sub, $html);
                            }
                        }
                    }
                }*/
            }
        }
    }

    public function actionCategoryNew()
    {
        if (Yii::$app->request->post()) {
            $cid = $_POST['category'];
            $uid = Yii::$app->user->id;
            $category = Categories::findOne($cid);
            if (!empty($category)) {
                if (!empty($_POST['accomplishment'])) {
                    $model = new Updates();
                    $model->update_type = 'Accomplishment';
                    $model->update_text = $_POST['accomplishment'];
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $cu_model = new CategoryUpdates();
                        $cu_model->category_id = $cid;
                        $cu_model->user_id = $uid;
                        $cu_model->update_id = $model->id;
                        $cu_model->save();
                    }
                }
                if (!empty($_POST['concern'])) {
                    $model = new Updates();
                    $model->update_type = 'Concern';
                    $model->update_text = $_POST['concern'];
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $cu_model = new CategoryUpdates();
                        $cu_model->category_id = $cid;
                        $cu_model->user_id = $uid;
                        $cu_model->update_id = $model->id;
                        $cu_model->save();
                    }
                }
                if (!empty($_POST['decision'])) {
                    $model = new Updates();
                    $model->update_type = 'Decision';
                    $model->update_text = $_POST['decision'];
                    $model->is_close = 1;
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $cu_model = new CategoryUpdates();
                        $cu_model->category_id = $cid;
                        $cu_model->user_id = $uid;
                        $cu_model->update_id = $model->id;
                        $cu_model->save();
                    }
                }
                if (!empty($_POST['followup'])) {
                    $model = new Updates();
                    $model->update_type = 'Action Item';
                    $model->update_text = $_POST['followup'];
                    if (!empty($_POST['due_date'])) {
                        $model->due_date = date('Y-m-d', strtotime($_POST['due_date']));
                    }
                    if (!empty($_POST['assigned_to'])) {
                        $model->assigned_to = $_POST['assigned_to'];
                        preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $model->assigned_to, $emails);
                        foreach ($emails[0] as $email){
                            QueryHelper::shareCategory("", $email, $cid);
                        }
                    }
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $cu_model = new CategoryUpdates();
                        $cu_model->category_id = $cid;
                        $cu_model->user_id = $uid;
                        $cu_model->update_id = $model->id;
                        if ($cu_model->save()) {
                            $perms = QueryHelper::getAllowedUsers($cu_model->category_id);
                            foreach ($perms as $perm) {
                                $sub = $cu_model->user->username . '  has added or Updated a follow up to the Topic ' . $cu_model->category->name;
                                $html = "";
                                if(!empty($model->due_date)){
                                    $html = "'<i>{$model->update_text}</i>' Due by <b>" . date('m/d/Y', strtotime($model->due_date)) . "</b><br/>";
                                }else{
                                    $html = "'<i>{$model->update_text}</i>'<br/>";
                                }
                                $html = $html . "<a href='http://" . Yii::$app->params['siteUrl'] . "/category/clean-view?id=" . base64_encode($cu_model->category_id)."'>
                                            Click here to access the projects in the {$cu_model->category->name} Topic
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
                        $pu_model = new CategoryUpdates();
                        $pu_model->category_id = $cid;
                        $pu_model->user_id = $uid;
                        $pu_model->update_id = $model->id;
                        $pu_model->save();
                    }
                }

                /*if (!empty($_POST['followup2'])) {
                    $model = new Updates();
                    $model->update_type = 'Follow Up';
                    $model->update_text = $_POST['followup2'];
                    if (!empty($_POST['due_date2'])) {
                        $model->due_date = date('Y-m-d', strtotime($_POST['due_date2']));
                    }
                    if (!empty($_POST['assigned_to2'])) {
                        $model->assigned_to = $_POST['assigned_to2'];
                    }
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $cu_model = new CategoryUpdates();
                        $cu_model->category_id = $cid;
                        $cu_model->user_id = $uid;
                        $cu_model->update_id = $model->id;
                        if ($cu_model->save()) {
                            $perms = QueryHelper::getAllowedUsers($cu_model->category_id);
                            foreach ($perms as $perm) {
                                $sub = $cu_model->user->username . '  has added or Updated a follow up to the project ' . $cu_model->category->name;
                                $html = "<p>'<i>{$model->update_text}</i>' Due by <b>" . date('d/m/Y', strtotime($model->due_date)) . "</b></p>
                                         <br/><br/>
                                         <a href='" . Url::to(['category/view', 'id' => base64_encode($cu_model->category_id)]) . "'>
                                            (Click here to access the project(s) in the {$cu_model->category->name} category)
                                         </a>";
                                EmailHelper::Send($perm->user->email, Yii::$app->params['adminEmail'], $sub, $html);
                            }
                        }
                    }
                }
                if (!empty($_POST['followup3'])) {
                    $model = new Updates();
                    $model->update_type = 'Follow Up';
                    $model->update_text = $_POST['followup3'];
                    if (!empty($_POST['due_date3'])) {
                        $model->due_date = date('Y-m-d', strtotime($_POST['due_date3']));
                    }
                    if (!empty($_POST['assigned_to3'])) {
                        $model->assigned_to = $_POST['assigned_to3'];
                    }
                    $model->date = date('Y-m-d');
                    if ($model->save()) {
                        $cu_model = new CategoryUpdates();
                        $cu_model->category_id = $cid;
                        $cu_model->user_id = $uid;
                        $cu_model->update_id = $model->id;
                        if ($cu_model->save()) {
                            $perms = QueryHelper::getAllowedUsers($cu_model->category_id);
                            foreach ($perms as $perm) {
                                $sub = $cu_model->user->username . '  has added or Updated a follow up to the project ' . $cu_model->category->name;
                                $html = "<p>'<i>{$model->update_text}</i>' Due by <b>" . date('d/m/Y', strtotime($model->due_date)) . "</b></p>
                                         <br/><br/>
                                         <a href='" . Url::to(['category/view', 'id' => base64_encode($cu_model->category_id)]) . "'>
                                            (Click here to access the project(s) in the {$cu_model->category->name} category)
                                         </a>";
                                EmailHelper::Send($perm->user->email, Yii::$app->params['adminEmail'], $sub, $html);
                            }
                        }
                    }
                }*/
            }
        }
    }
}