<?php

namespace app\controllers;

use Yii;
use app\models\Pulse;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Categories;
use app\models\UserCategoryPermissions;
use yii\helpers\ArrayHelper;
use app\models\PulseUpdates;
use app\models\Updates;
use app\components\QueryHelper;

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
        $model = Pulse::find()->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
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

        $categories = Categories::find()->where(['user_id' => Yii::$app->user->id])->all();
        $listData=ArrayHelper::map($categories,'id','name');
        $uid = Yii::$app->user->id;
        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
                //var_dump($post);
                //die();
                $model->user_id = Yii::$app->user->id;
                $model->how_you_feel = 'Great';
                $model->about_project_health = 'Up';
                $model->is_agenda = '1';
                $model->date = date('Y-m-d');
                if($model->save()) {
                    $pulseid = $model->id;
                } else {
                    var_dump($model->errors);
                }
                //$model->save();
                
            //die();
            /****/
            if (!empty($post['accomplishment'])) {
                $model_up = new Updates();
                $model_up->update_type = 'Accomplishment';
                $model_up->update_text = $post['accomplishment'];
                $model_up->date = date('Y-m-d');
                if ($model_up->save()) {
                    $cu_model = new PulseUpdates();
                    $cu_model->pulse_id = $pulseid;
                    $cu_model->user_id = $uid;
                    $cu_model->update_id = $model_up->id;
                    $cu_model->save();
                }
            }
            if (!empty($post['concern'])) {
                $model_up = new Updates();
                $model_up->update_type = 'Concern';
                $model_up->update_text = $post['concern'];
                $model_up->date = date('Y-m-d');
                if ($model_up->save()) {
                    $cu_model = new PulseUpdates();
                    $cu_model->pulse_id = $pulseid;
                    $cu_model->user_id = $uid;
                    $cu_model->update_id = $model_up->id;
                    $cu_model->save();
                }
            }
            if (!empty($post['decision'])) {
                $model_up = new Updates();
                $model_up->update_type = 'Decision';
                $model_up->update_text = $post['decision'];
                $model_up->is_close = 1;
                $model_up->date = date('Y-m-d');
                if ($model_up->save()) {
                    $cu_model = new PulseUpdates();
                    $cu_model->pulse_id = $pulseid;
                    $cu_model->user_id = $uid;
                    $cu_model->update_id = $model_up->id;
                    $cu_model->save();
                }
            }
            if (!empty($post['followup'])) {
                $model_up = new Updates();
                $model_up->update_type = 'Action Item';
                $model_up->update_text = $post['followup'];
                if (!empty($post['due_date'])) {
                    $model_up->due_date = date('Y-m-d', strtotime($post['due_date']));
                }
                if (!empty($post['assigned_to'])) {
                    $model_up->assigned_to = $post['assigned_to'];
                    preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $model_up->assigned_to, $emails);
                    foreach ($emails[0] as $email){
                        QueryHelper::shareCategory("", $email, $pulseid);
                    }
                }
                $model_up->date = date('Y-m-d');

                if ($model_up->save()) {
                    $cu_model = new PulseUpdates();
                    $cu_model->pulse_id = $pulseid;
                    $cu_model->user_id = $uid;
                    $cu_model->update_id = $model_up->id;
                    if ($cu_model->save()) {
                        $perms = QueryHelper::getAllowedUsers($cu_model->pulse_id);
                        /*foreach ($perms as $perm) {
                            $sub = $cu_model->user->username . '  has added or Updated a follow up to the Topic ' . $cu_model->category->name;
                            $html = "";
                            if(!empty($model_up->due_date)){
                                $html = "'<i>{$model_up->update_text}</i>' Due by <b>" . date('m/d/Y', strtotime($model_up->due_date)) . "</b><br/>";
                            }else{
                                $html = "'<i>{$model_up->update_text}</i>'<br/>";
                            }
                            $html = $html . "<a href='http://" . Yii::$app->params['siteUrl'] . "/category/clean-view?id=" . base64_encode($cu_model->pulse_id)."'>
                                        Click here to access the projects in the {$cu_model->category->name} Topic
                                     </a>";
                            EmailHelper::Send($perm->user->email, Yii::$app->params['adminEmail'], $sub, $html);
                        }*/
                    }
                }
            }

            if (!empty($post['notes'])) {
                $model_up = new Updates();
                $model_up->update_type = 'Notes';
                $model_up->update_text = $post['notes'];
                $model_up->date = date('Y-m-d');
                if ($model->save()) {
                    $pu_model = new PulseUpdates();
                    $pu_model->pulse_id = $pulseid;
                    $pu_model->user_id = $uid;
                    $pu_model->update_id = $model_up->id;
                    $pu_model->save();
                }
            }

            
            /****/


            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'listData' => $listData
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
