<?php

namespace app\controllers;

use app\components\ConversionHelper;
use app\components\EmailHelper;
use app\components\QueryHelper;
use app\models\Categories;
use app\models\CategorySearch;
use app\models\CategoryUpdates;
use app\models\LoginForm;
use app\models\Notes;
use app\models\Projects;
use app\models\ProjectSearch;
use app\models\ProjectUpdates;
use app\models\Ratings;
use app\models\Tasks;
use app\models\UserCategoryPermissions;
use app\models\User;
use app\models\ViewPermissionUrls;
use dektrium\user\helpers\Password;
use kartik\date\DatePicker;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CategoryController implements the CRUD actions for Categories model.
 */
class CategoryController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $due = 0)
    {
        $id = base64_decode($id);
        if (empty($id)) {
            return $this->redirect(['site/index']);
        }
        $model = $this->findModel($id);

        if (QueryHelper::isAllowed($model->id)) {
            $searchModel = new ProjectSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id, $due);
            // validate if there is a editable input saved via AJAX
            if (Yii::$app->request->post('hasEditable')) {
                // instantiate your book model for saving
                $projectId = Yii::$app->request->post('editableKey');
                $model1 = Projects::findOne($projectId);
                if (!empty($model1)) {
                    $out = Json::encode(['output' => '', 'message' => '']);
                    if (isset($_POST['Projects'])) {
                        $posted = current($_POST['Projects']);
                        $post = ['Projects' => $posted];
                        $output = '';
                        if ($model1->load($post)) {
                            $model1->save(false);
                            if (isset($posted['start_date'])) {
                                $output = Yii::$app->formatter->asDate($model1->start_date, 'M/d/Y');
                            }
                            if (isset($posted['end_date'])) {
                                $output = Yii::$app->formatter->asDate($model1->end_date, 'M/d/Y');
                            }
                            if (isset($posted['rating'])) {
                                $rating = Ratings::find()->where(['user_id' => Yii::$app->user->id])
                                    ->andWhere(['project_id' => $model1->id])
                                    ->one();
                                if (!empty($rating)) {
                                    $rating->rating = $model1->rating;
                                    $rating->date = date('Y-m-d');
                                    $rating->save(false);
                                } else {
                                    $r = new Ratings();
                                    $r->user_id = Yii::$app->user->id;
                                    $r->project_id = $model1->id;
                                    $r->rating = $model1->rating;
                                    $r->date = date('Y-m-d');
                                    $r->save();
                                }

                            }
                            $out = Json::encode(['output' => $output, 'message' => '']);
                        }
                        echo $out;
                        return;
                    } else {
                        $taskId = Yii::$app->request->post('editableKey');
                        $model2 = Tasks::findOne($taskId);
                        $output = '';
                        $out = Json::encode(['output' => '', 'message' => '']);
                        $posted2 = current($_POST['Tasks']);
                        if (isset($_POST['Tasks'])) {
                            $post2 = ['Tasks' => $posted2];
                            if ($model2->load($post2)) {
                                $model2->save(false);
                                if (isset($posted2['start_date'])) {
                                    $output = Yii::$app->formatter->asDate($model2->start_date, 'M/d/Y');
                                }
                                if (isset($posted2['end_date'])) {
                                    $output = Yii::$app->formatter->asDate($model2->end_date, 'M/d/Y');
                                }
                                $out = Json::encode(['output' => $output, 'message' => '']);
                            }
                            echo $out;
                            return;
                        }
                    }
                } else {
                    $taskId = Yii::$app->request->post('editableKey');
                    $model2 = Tasks::findOne($taskId);
                    $output = '';
                    $out = Json::encode(['output' => '', 'message' => '']);
                    $posted2 = current($_POST['Tasks']);
                    if (isset($_POST['Tasks'])) {
                        $post2 = ['Tasks' => $posted2];
                        if ($model2->load($post2)) {
                            $model2->save(false);
                            if (isset($posted2['start_date'])) {
                                $output = Yii::$app->formatter->asDate($model2->start_date, 'M/d/Y');
                            }
                            if (isset($posted2['end_date'])) {
                                $output = Yii::$app->formatter->asDate($model2->end_date, 'M/d/Y');
                            }
                            $out = Json::encode(['output' => $output, 'message' => '']);
                        }
                        echo $out;
                        return;
                    }
                }
            }

            return $this->render('view', [
                'model' => $model,
                'due' => $due,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionCleanView($id, $due = 0)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if (QueryHelper::isAllowed($model->id)) {
            $searchModel = new ProjectSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id, $due, 1);
            if (Yii::$app->request->post('hasEditable')) {
                $projectId = Yii::$app->request->post('editableKey');
                $model1 = Projects::findOne($projectId);
                if (!empty($model1)) {
                    $out = Json::encode(['output' => '', 'message' => '']);
                    if (isset($_POST['Projects'])) {
                        $posted = current($_POST['Projects']);
                        $post = ['Projects' => $posted];
                        $output = '';
                        if ($model1->load($post)) {
                            $model1->save(false);
                            $out = Json::encode(['output' => $output, 'message' => '']);
                        }
                        echo $out;
                        return;
                    } else {
                        $taskId = Yii::$app->request->post('editableKey');
                        $model2 = Tasks::findOne($taskId);
                        $output = '';
                        $out = Json::encode(['output' => '', 'message' => '']);
                        $posted2 = current($_POST['Tasks']);
                        if (isset($_POST['Tasks'])) {
                            $post2 = ['Tasks' => $posted2];
                            if ($model2->load($post2)) {
                                $model2->save(false);
                                $out = Json::encode(['output' => $output, 'message' => '']);
                            }
                            echo $out;
                            return;
                        }
                    }
                } else {
                    $taskId = Yii::$app->request->post('editableKey');
                    $model2 = Tasks::findOne($taskId);
                    $output = '';
                    $out = Json::encode(['output' => '', 'message' => '']);
                    $posted2 = current($_POST['Tasks']);
                    if (isset($_POST['Tasks'])) {
                        $post2 = ['Tasks' => $posted2];
                        if ($model2->load($post2)) {
                            $model2->save(false);
                            $out = Json::encode(['output' => $output, 'message' => '']);
                        }
                        echo $out;
                        return;
                    }
                }
            }

            return $this->render('clean_view', [
                'model' => $model,
                'due' => $due,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFullView($id, $due = 0)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if (QueryHelper::isAllowed($model->id)) {
            $searchModel = new ProjectSearch();

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id, $due, 1);
            if (Yii::$app->request->post('hasEditable')) {
                $projectId = Yii::$app->request->post('editableKey');
                $model1 = Projects::findOne($projectId);
                if (!empty($model1)) {
                    $out = Json::encode(['output' => '', 'message' => '']);
                    if (isset($_POST['Projects'])) {
                        $posted = current($_POST['Projects']);
                        $post = ['Projects' => $posted];
                        $output = '';
                        if ($model1->load($post)) {
                            $model1->save(false);
                            if (isset($posted['start_date'])) {
                                $output = Yii::$app->formatter->asDate($model1->start_date, 'M/d/Y');
                            }
                            if (isset($posted['end_date'])) {
                                $output = Yii::$app->formatter->asDate($model1->end_date, 'M/d/Y');
                            }
                            if (isset($posted['rating'])) {
                                $rating = Ratings::find()->where(['user_id' => Yii::$app->user->id])
                                    ->andWhere(['project_id' => $model1->id])
                                    ->one();
                                if (!empty($rating)) {
                                    $rating->rating = $model1->rating;
                                    $rating->date = date('Y-m-d');
                                    $rating->save(false);
                                } else {
                                    $r = new Ratings();
                                    $r->user_id = Yii::$app->user->id;
                                    $r->project_id = $model1->id;
                                    $r->rating = $model1->rating;
                                    $r->date = date('Y-m-d');
                                    $r->save();
                                }

                            }
                            $out = Json::encode(['output' => $output, 'message' => '']);
                        }
                        echo $out;
                        return;
                    } else {
                        $taskId = Yii::$app->request->post('editableKey');
                        $model2 = Tasks::findOne($taskId);
                        $output = '';
                        $out = Json::encode(['output' => '', 'message' => '']);
                        $posted2 = current($_POST['Tasks']);
                        if (isset($_POST['Tasks'])) {
                            $post2 = ['Tasks' => $posted2];
                            if ($model2->load($post2)) {
                                $model2->save(false);
                                if (isset($posted2['start_date'])) {
                                    $output = Yii::$app->formatter->asDate($model2->start_date, 'M/d/Y');
                                }
                                if (isset($posted2['end_date'])) {
                                    $output = Yii::$app->formatter->asDate($model2->end_date, 'M/d/Y');
                                }
                                $out = Json::encode(['output' => $output, 'message' => '']);
                            }
                            echo $out;
                            return;
                        }
                    }
                } else {
                    $taskId = Yii::$app->request->post('editableKey');
                    $model2 = Tasks::findOne($taskId);
                    $output = '';
                    $out = Json::encode(['output' => '', 'message' => '']);
                    $posted2 = current($_POST['Tasks']);
                    if (isset($_POST['Tasks'])) {
                        $post2 = ['Tasks' => $posted2];
                        if ($model2->load($post2)) {
                            $model2->save(false);
                            if (isset($posted2['start_date'])) {
                                $output = Yii::$app->formatter->asDate($model2->start_date, 'M/d/Y');
                            }
                            if (isset($posted2['end_date'])) {
                                $output = Yii::$app->formatter->asDate($model2->end_date, 'M/d/Y');
                            }
                            $out = Json::encode(['output' => $output, 'message' => '']);
                        }
                        echo $out;
                        return;
                    }
                }
            }

            return $this->render('full_view', [
                'model' => $model,
                'due' => $due,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionViewOnly($id)
    {
        $vpu = ViewPermissionUrls::find()->where(['url' => $id])->one();
        $model = $vpu->category;
        if (!empty($model)) {
            $searchModel = new ProjectSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model->id);
            return $this->render('view_only', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionShare($category, $new)
    {
        $category = base64_decode($category);
        $ucp = UserCategoryPermissions::findOne($category);
        if (!empty($ucp)) {
            $user = User::findOne($ucp->user_id);
            if (!empty($user)) {
                if (Yii::$app->getUser()->login($user, 0)) {
                    if ($new) {
                        return $this->redirect(['/user/settings/account']);
                    }
                    return $this->redirect(['clean-view', 'id' => base64_encode($ucp->category_id)]);
                }
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFullPermissionSend()
    {
        if (Yii::$app->request->post()) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $cat_id = base64_decode($_POST['category']);
            QueryHelper::shareCategory($name, $email, $cat_id);
            return $this->redirect(['clean-view', 'id' => base64_encode($cat_id)]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'clean-view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                for ($i = 1; $i < 6; $i++) {
                    $project = new Projects();
                    $project->category_id = $model->id;
                    $project->user_id = Yii::$app->user->id;
                    $project->title = "Project {$i}";
                    $project->start_date = date("Y-m-d");
                    $project->end_date = date("Y-m-d", strtotime("$project->start_date +14 days"));
                    $project->custom_field = "TBD";
                    $project->save();
                }

                $cp_model = new UserCategoryPermissions();
                $cp_model->user_id = Yii::$app->user->id;
                $cp_model->category_id = $model->id;
                $cp_model->is_allowed = 1;
                $cp_model->save();
            }
            return $this->redirect(['clean-view', 'id' => base64_encode($model->id)]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'clean-view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['clean-view', 'id' => base64_encode($model->id)]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionNotes($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        $notes_model = array();
        if (!empty($model->note)) {
            $notes_model = $model->note;
        } else {
            $notes_model = new Notes();
        }
        if (QueryHelper::isAllowed($model->id)) {
            return $this->render('notes', [
                'model' => $model,
                'notes_model' => $notes_model,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEditNotes($id, $user, $cat, $text)
    {
        if (QueryHelper::isAllowed($cat)) {
            $model = Notes::findOne($id);
            if (empty($model)) {
                $model = new Notes();
                $model->user_id = $user;
                $model->category_id = $cat;
            }
            $model->text = $text;
            if ($model->save()) {
                return;
            }
        }
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->id) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAucontent($id, $assigned_to = null, $is_close = null, $due_date = null, $due = null, $utype = null)
    {
        $due_date_pattern = null;
        if (!empty($due_date)) {
            $due_date_pattern = date('Y-m-d', strtotime($due_date));
        }
        $due_query = 1;
        if (!empty($due)) {
            if ($due == "today") {
                $due_query = 'CURDATE() = due_date';
            } else if ($due == "tomorrow") {
                $due_query = 'date_add(CURDATE(), INTERVAL 1 DAY) = due_date';
            } else if ($due == "week") {
                $due_query = 'due_date BETWEEN DATE_ADD(CURDATE(), INTERVAL 2 DAY) AND DATE_ADD(CURDATE(), INTERVAL 8 DAY)';
            } else if ($due == "over") {
                $due_query = 'CURDATE() > due_date';
            }
        }

        
        $model = $this->findModel($id);
        //print_r($model->cupdates); die();
        $i = uniqid();
        //$model = Projects::find()->where(['id'=>$id]);
        //echo $model->createCommand()->sql;
        ?>

        <div class="col-md-12">
            <?php
            $id = $model->id;
            if (!empty($model->cupdates)) {
                            ?>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="col-md-8" style="background: #e0e0e0; line-height: 45px;">
                                            <span class="previous-heading" style="color: #2e6da4">Previous Updates</span>
                                        </div>
                                        <div class="col-md-4" style="background: #e0e0e0; padding:6px 0 6px 20px">
                                            <span class="header2">
                                                <button id="icon2" class="btn btn-primary accordion-button-right">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                            <button type="button" title="Clear Filters" id="filter-clear-button"
                                                    class="btn btn-warning accordion-button-right-left">
                                                <i class="fa fa-ban"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-1" style="padding:20px 0 0 20px">
                                        Filter By:
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0 0 10px">
                                        <select class="form-control" name="filter_assigned_to" id="filter_assigned_to<?= $id ?>">
                                            <option value="">Note Type
                                            </option>
                                            <?php
                                            foreach ($model->cupdates as $item) {
                                                if (!empty($item->update->assigned_to)) {
                                                    ?>
                                                    <option value="<?= $item->update->assigned_to ?>">
                                                        <?= $item->update->assigned_to ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3" style="padding:10px 0 0 10px">
                                        <input type="text" class="form-control" name="keyword<?= $id ?>" placeholder="Keyword in description or response">
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0 0 10px">
                                        <?php echo DatePicker::widget([
                                            'id' => 'filter_due_date' . $i,
                                            'name' => 'filter_due_date' . $i,
                                            'options' => ['placeholder' => 'Due Date'],
                                            'pluginOptions' => [
                                                'format' => 'mm/dd/yyyy',
                                                'autoclose' => true,
                                                'todayHighlight' => true
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-1" style="padding:10px 0 0 10px">
                                        <select class="form-control" name="filter_is_close" id="filter_is_close<?= $id ?>">
                                            <option value="">Status</option>
                                            <option value="0">Open</option>
                                            <option value="1">Closed</option>
                                            <option value="2">Critical</option>
                                            <!--<option value="3">Request more info</option>-->
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0 0 10px">
                                        <select class="form-control" name="filter_assigned_to" id="filter_assigned_to<?= $id ?>">
                                            <option value="">Follow up with
                                            </option>
                                            <?php
                                            foreach ($model->cupdates as $item) {
                                                if (!empty($item->update->assigned_to)) {
                                                    ?>
                                                    <option value="<?= $item->update->assigned_to ?>">
                                                        <?= $item->update->assigned_to ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-1" style="padding:10px 0 0 0px">
                                        <center>
                                            <button type="button" id="filter-search-button"
                                                    class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </center>
                                    </div>
                                    <script>
                                        $('#filter-search-button').click(function () {
                                            var a = $("#filter_assigned_to<?= $id?>").val();
                                            var c = $("#filter_is_close<?= $id?>").val();
                                            var d = $("#filter_due_date<?= $i?>").val();
                                            var t = $("#filter_due_by<?= $id?>").val();
                                            var params = {
                                                id: <?=$model->id?>,
                                                assigned_to: a,
                                                is_close: c,
                                                due_date: d,
                                                due: t
                                            };
                                            var url = jQuery.param(params);
                                            $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                        });
                                        $('#filter-clear-button').click(function () {
                                            var params = {id: <?=$model->id?>};
                                            var url = jQuery.param(params);
                                            $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                        });
                                    </script>
                                    <!--<div class="col-md-9">
                                        <div class="col-md-9" style="padding:10px">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <select class="form-control" name="filter_assigned_to"
                                                                        id="filter_assigned_to<?= $id ?>">
                                                                    <option value="">Filter By Follow up with
                                                                    </option>
                                                                    <?php
                                                                    foreach ($model->cupdates as $item) {
                                                                        if (!empty($item->update->assigned_to)) {
                                                                            ?>
                                                                            <option value="<?= $item->update->assigned_to ?>">
                                                                                <?= $item->update->assigned_to ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select class="form-control" name="filter_is_close"
                                                                        id="filter_is_close<?= $id ?>">
                                                                    <option value="">Filter by Status</option>
                                                                    <option value="0">Open</option>
                                                                    <option value="1">Closed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding:10px">
                                            <?php /* DatePicker::widget([
                                            'id' => 'filter_due_date' . $i,
                                            'name' => 'filter_due_date' . $i,
                                            'options' => ['placeholder' => 'Filter By Due Date'],
                                            'pluginOptions' => [
                                                'format' => 'mm/dd/yyyy',
                                                'autoclose' => true,
                                                'todayHighlight' => true
                                            ],
                                        ]);
                                        */ ?>
                                            <select class="form-control" name="filter_due_by"
                                                    id="filter_due_by<?= $id ?>">
                                                <option value="">Any Due Date</option>
                                                <option value="today">Due Today</option>
                                                <option value="tomorrow">Due Tomorrow</option>
                                                <option value="week">Next Week</option>
                                                <option value="over">Over Due</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1" style="padding:10px">
                                            <center>
                                                <button type="button" id="filter-search-button"
                                                        class="btn btn-info">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </center>
                                        </div>
                                        <script>
                                            $('#filter-search-button').click(function () {
                                                var a = $("#filter_assigned_to<?= $id?>").val();
                                                var c = $("#filter_is_close<?= $id?>").val();
                                                var d = $("#filter_due_date<?= $i?>").val();
                                                var t = $("#filter_due_by<?= $id?>").val();
                                                var params = {
                                                    id: <?=$model->id?>,
                                                    assigned_to: a,
                                                    is_close: c,
                                                    due_date: d,
                                                    due: t
                                                };
                                                var url = jQuery.param(params);
                                                $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                            });
                                            $('#filter-clear-button').click(function () {
                                                var params = {id: <?=$model->id?>};
                                                var url = jQuery.param(params);
                                                $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0">
                                        Follow up with
                                    </div>-->
                                </div>
                            </div>
                            <hr/>
                            <div class="content2">
                            <div class="container" style="width: 99%; margin: 0 auto;">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                      <thead style="background: #e0e0e0">
                                        <tr>
                                          <th style="text-align: center;">Note Type</th>
                                          <th>Description</th>
                                          <th>Response</th>
                                          <th>Due By</th>
                                          <th>Status</th>
                                          <th>Follow up with</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $cupdates = CategoryUpdates::find()
                                            ->joinWith(['update'])
                                            ->select(['*'])
                                            ->where(['user_id' => $model->user_id, 'category_id' => $model->id])
                                            ->andFilterWhere(['like', 'updates.assigned_to', $assigned_to])
                                            ->andFilterWhere(['like', 'updates.due_date', $due_date_pattern])
                                            ->andFilterWhere(['updates.is_close' => $is_close])
                                            ->andFilterWhere(['like', 'updates.update_type', $utype])
                                            ->groupBy('updates.id')
                                            ->orderBy([
                                                'updates.is_close' => SORT_ASC,
                                                'category_updates.id' => SORT_DESC
                                            ])
                                            ->all();
                                        foreach ($cupdates as $cupdate) {
                                            if (!empty($cupdate->update)) {
                                                $uform = ActiveForm::begin(
                                                    [
                                                        'id' => 'update-edit' . $i,
                                                        'action' => Yii::$app->urlManager->createUrl(["update/edit", 'id' => base64_encode($cupdate->update->id)]),
                                                    ]
                                                );
                                                ?>
                                        <tr>
                                          <td style="text-align: center;"><span style="color: #2e6da4; font-weight: bold;"><?= $cupdate->update->update_type ?></span><br />
                                          <span style="font-size: 12px;"><?= ConversionHelper::getDate($cupdate->update->date) ?><br/><?= $cupdate->user->username ?></span></td>
                                          <td><?= $uform->field($cupdate->update, 'update_text')->textarea(['id' => 'update_text' . $cupdate->id, 'title' => $cupdate->update->update_text, 'placeholder' => 'Enter ' . $cupdate->update->update_type, 'rows' => 4, 'style' => 'resize: vertical;'])->label(false) ?></td>
                                          <td><?= $uform->field($cupdate->update, 'response')->textarea(['id' => 'response' . $cupdate->id, 'title' => $cupdate->update->response, 'placeholder' => 'Enter Response', 'rows' => 4, 'style' => 'resize: vertical;'])->label(false) ?></td>
                                          <td style="text-align: center; width: 16%"><?php if (!empty($cupdate->update->due_date)) { ?>
                                                            <span class="date-day" style=" color: #2e6da4">
                                                    <?php $due_date = ConversionHelper::getDate($cupdate->update->due_date) ?>
                                                    
                                                    <?php  /*DatePicker::widget([
                                                        'id' => 'filter_due_date' . $cupdate->id,
                                                        'name' => 'filter_due_date' . $cupdate->id,
                                                        'value' => $due_date,
                                                        'options' => ['placeholder' => 'Due Date'],
                                                        'pluginOptions' => [
                                                            'format' => 'mm/dd/yyyy',
                                                            'autoclose' => true,
                                                            'todayHighlight' => true
                                                        ],
                                                    ]);*/

                                                  echo  DatePicker::widget([
                                        'id' => 'filter_due_date' . $cupdate->id,
                                        'name' => 'due_date',
                                        'value' => date("d/m/Y", strtotime($due_date)),
                                        'options' => ['placeholder' => 'Due Date'],
                                        'pluginOptions' => [
                                            'format' => 'mm/dd/yyyy',
                                            'autoclose' => true,
                                            'todayHighlight' => true
                                        ]
                                    ]);
                                                    ?>
                                                </span>
                                                            <br/>
                                                        <?php } ?></td>
                                          <td style="font-weight: normal; width: 15%">
                                              <input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="1" <?php if($cupdate->update->is_close==1) { ?> checked <?php } ?> /> <label style="font-weight: normal;" for="test<?= $i ?>">Open</label><br /><input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="0" <?php if($cupdate->update->is_close==0) { ?> checked <?php } ?> /> <label style="font-weight: normal;" for="test<?= $i ?>">Close</label><br />
                                              <input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="2" <?php if($cupdate->update->is_close==2) { ?> checked <?php } ?> /> <label style="font-weight: normal;" for="test<?= $i ?>">Critical</label><!--<br /><input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="3" /> <label style="font-weight: normal;" for="test<?= $i ?>">Request more info</label>-->
                                          </td>
                                          <td style="text-align: center; width: 10%"><?= $uform->field($cupdate->update, 'assigned_to')->textInput(['id' => 'assigned_to' . $cupdate->id, 'style' => 'margin-top:10px', 'title' => $cupdate->update->assigned_to, 'placeholder' => 'Whom to Follow Up with'])->label(false) ?></td>
                                          <td style="text-align: center;">
                                                                <center>
                                                                <div>
                                                                <button type="submit" id="update-button<?= $cupdate->id ?>"
                                                                class="btn btn-success">
                                                            <i class="fa fa-save"></i>
                                                        </button>
                                                        </div>
                                                        <div style="padding-top: 10px">
                                                        <button id="delete-update<?= $cupdate->id ?>"
                                                                type="button"
                                                                class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        </div>
                                                        </center>
                                                        <script>
                                                        $("#delete-update<?=$cupdate->id?>").click(function () {
                                                            var result = confirm("Are you sure you want to Delete this?");
                                                            if (result) {
                                                                $.ajax({
                                                                    url: "<?=Url::to(['update/delete-category-update', 'id' => base64_encode($cupdate->id)])?>",
                                                                    success: function (result) {
                                                                        $('#update-record-<?= $cupdate->id ?>').hide();
                                                                        $('#update-record-br-<?= $cupdate->id ?>').hide();
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    </script>
                                            </td>
                                        </tr>
                                        <?php
                                        ActiveForm::end();
                                        ?>
                                            <script>
                                            $(function () {
    $('#update-edit<?=$i?>').on('submit',function (e) {
var form = $(this);
                                                if (form.find('.has-error').length) {
                                                    return false;
                                                }
              $.ajax({
                                                    url: form.attr('action'),
                                                    type: 'post',
                                                    data: form.serialize(),
                                                    success: function (data) {
                                                        $('#update-edit<?=$i?>').hide().fadeIn('fast');
                                                    },
                                                    error: function () {
                                                        alert("Something went wrong");
                                                    }
                                                });
          e.preventDefault();
        });
});
                                        </script>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                      </tbody>
                                    </table>
                                  </div><!--end of .table-responsive-->
                                </div>
                              </div>
                            </div>
                                
                            </div>
                            <?php
                        }
            ?>
        </div>
        <?php
    }

    public function actionAcucontent($id, $assigned_to = null, $is_close = null, $due_date = null, $due = null, $utype = null)
    {
        $due_date_pattern = null;
        if (!empty($due_date)) {
            $due_date_pattern = date('Y-m-d', strtotime($due_date));
        }
        $due_query = 1;
        if (!empty($due)) {
            if ($due == "today") {
                $due_query = 'CURDATE() = due_date';
            } else if ($due == "tomorrow") {
                $due_query = 'date_add(CURDATE(), INTERVAL 1 DAY) = due_date';
            } else if ($due == "week") {
                $due_query = 'due_date BETWEEN DATE_ADD(CURDATE(), INTERVAL 2 DAY) AND DATE_ADD(CURDATE(), INTERVAL 8 DAY)';
            } else if ($due == "over") {
                $due_query = 'CURDATE() > due_date';
            }
        }

        
        $model = $this->findModel($id);
        //print_r($model->cupdates); die();
        $i = uniqid();
        //$model = Projects::find()->where(['id'=>$id]);
        //echo $model->createCommand()->sql;
        ?>

        <div class="col-md-12">
            <?php
            $id = $model->id;
            if (!empty($model->cupdates)) {
                            ?>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="col-md-8" style="background: #e0e0e0; line-height: 45px;">
                                            <span class="previous-heading" style="color: #2e6da4">Previous Updates</span>
                                        </div>
                                        <div class="col-md-4" style="background: #e0e0e0; padding:6px 0 6px 20px">
                                            <span class="header2">
                                                <button id="icon2" class="btn btn-primary accordion-button-right">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                            <button type="button" title="Clear Filters" id="filter-clear-button"
                                                    class="btn btn-warning accordion-button-right-left">
                                                <i class="fa fa-ban"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-1" style="padding:20px 0 0 20px">
                                        Filter By:
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0 0 10px">
                                        <select class="form-control" name="filter_assigned_to" id="filter_assigned_to<?= $id ?>">
                                            <option value="">Note Type
                                            </option>
                                            <?php
                                            foreach ($model->cupdates as $item) {
                                                if (!empty($item->update->assigned_to)) {
                                                    ?>
                                                    <option value="<?= $item->update->assigned_to ?>">
                                                        <?= $item->update->assigned_to ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3" style="padding:10px 0 0 10px">
                                        <input type="text" class="form-control" name="keyword<?= $id ?>" placeholder="Keyword in description or response">
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0 0 10px">
                                        <?php echo DatePicker::widget([
                                            'id' => 'filter_due_date' . $i,
                                            'name' => 'filter_due_date' . $i,
                                            'options' => ['placeholder' => 'Due Date'],
                                            'pluginOptions' => [
                                                'format' => 'mm/dd/yyyy',
                                                'autoclose' => true,
                                                'todayHighlight' => true
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-1" style="padding:10px 0 0 10px">
                                        <select class="form-control" name="filter_is_close" id="filter_is_close<?= $id ?>">
                                            <option value="">Status</option>
                                            <option value="0">Open</option>
                                            <option value="1">Closed</option>
                                            <option value="2">Critical</option>
                                            <!--<option value="3">Request more info</option>-->
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0 0 10px">
                                        <select class="form-control" name="filter_assigned_to" id="filter_assigned_to<?= $id ?>">
                                            <option value="">Follow up with
                                            </option>
                                            <?php
                                            foreach ($model->cupdates as $item) {
                                                if (!empty($item->update->assigned_to)) {
                                                    ?>
                                                    <option value="<?= $item->update->assigned_to ?>">
                                                        <?= $item->update->assigned_to ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-1" style="padding:10px 0 0 0px">
                                        <center>
                                            <button type="button" id="filter-search-button"
                                                    class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </center>
                                    </div>
                                    <script>
                                        $('#filter-search-button').click(function () {
                                            var a = $("#filter_assigned_to<?= $id?>").val();
                                            var c = $("#filter_is_close<?= $id?>").val();
                                            var d = $("#filter_due_date<?= $i?>").val();
                                            var t = $("#filter_due_by<?= $id?>").val();
                                            var params = {
                                                id: <?=$model->id?>,
                                                assigned_to: a,
                                                is_close: c,
                                                due_date: d,
                                                due: t
                                            };
                                            var url = jQuery.param(params);
                                            $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                        });
                                        $('#filter-clear-button').click(function () {
                                            var params = {id: <?=$model->id?>};
                                            var url = jQuery.param(params);
                                            $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                        });
                                    </script>
                                    <!--<div class="col-md-9">
                                        <div class="col-md-9" style="padding:10px">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <select class="form-control" name="filter_assigned_to"
                                                                        id="filter_assigned_to<?= $id ?>">
                                                                    <option value="">Filter By Follow up with
                                                                    </option>
                                                                    <?php
                                                                    foreach ($model->cupdates as $item) {
                                                                        if (!empty($item->update->assigned_to)) {
                                                                            ?>
                                                                            <option value="<?= $item->update->assigned_to ?>">
                                                                                <?= $item->update->assigned_to ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select class="form-control" name="filter_is_close"
                                                                        id="filter_is_close<?= $id ?>">
                                                                    <option value="">Filter by Status</option>
                                                                    <option value="0">Open</option>
                                                                    <option value="1">Closed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding:10px">
                                            <?php /* DatePicker::widget([
                                            'id' => 'filter_due_date' . $i,
                                            'name' => 'filter_due_date' . $i,
                                            'options' => ['placeholder' => 'Filter By Due Date'],
                                            'pluginOptions' => [
                                                'format' => 'mm/dd/yyyy',
                                                'autoclose' => true,
                                                'todayHighlight' => true
                                            ],
                                        ]);
                                        */ ?>
                                            <select class="form-control" name="filter_due_by"
                                                    id="filter_due_by<?= $id ?>">
                                                <option value="">Any Due Date</option>
                                                <option value="today">Due Today</option>
                                                <option value="tomorrow">Due Tomorrow</option>
                                                <option value="week">Next Week</option>
                                                <option value="over">Over Due</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1" style="padding:10px">
                                            <center>
                                                <button type="button" id="filter-search-button"
                                                        class="btn btn-info">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </center>
                                        </div>
                                        <script>
                                            $('#filter-search-button').click(function () {
                                                var a = $("#filter_assigned_to<?= $id?>").val();
                                                var c = $("#filter_is_close<?= $id?>").val();
                                                var d = $("#filter_due_date<?= $i?>").val();
                                                var t = $("#filter_due_by<?= $id?>").val();
                                                var params = {
                                                    id: <?=$model->id?>,
                                                    assigned_to: a,
                                                    is_close: c,
                                                    due_date: d,
                                                    due: t
                                                };
                                                var url = jQuery.param(params);
                                                $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                            });
                                            $('#filter-clear-button').click(function () {
                                                var params = {id: <?=$model->id?>};
                                                var url = jQuery.param(params);
                                                $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0">
                                        Follow up with
                                    </div>-->
                                </div>
                            </div>
                            <hr/>
                            <div class="content2">
                            <div class="container" style="width: 99%; margin: 0 auto;">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                      <thead style="background: #e0e0e0">
                                        <tr>
                                          <th style="text-align: center;">Note Type</th>
                                          <th>Description</th>
                                          <th>Response</th>
                                          <th>Due By</th>
                                          <th>Status</th>
                                          <th>Follow up with</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $cupdates = CategoryUpdates::find()
                                            ->joinWith(['update'])
                                            ->select(['*'])
                                            ->where(['user_id' => $model->user_id, 'category_id' => $model->id])
                                            ->andFilterWhere(['like', 'updates.assigned_to', $assigned_to])
                                            ->andFilterWhere(['like', 'updates.due_date', $due_date_pattern])
                                            ->andFilterWhere(['updates.is_close' => $is_close])
                                            ->andFilterWhere(['like', 'updates.update_type', $utype])
                                            ->groupBy('updates.id')
                                            ->orderBy([
                                                'updates.is_close' => SORT_ASC,
                                                'category_updates.id' => SORT_DESC
                                            ])
                                            ->all();
                                        foreach ($cupdates as $cupdate) {
                                            if (!empty($cupdate->update)) {
                                                $uform = ActiveForm::begin(
                                                    [
                                                        'id' => 'update-edit' . $i,
                                                        'action' => Yii::$app->urlManager->createUrl(["update/edit", 'id' => base64_encode($cupdate->update->id)]),
                                                    ]
                                                );
                                                ?>
                                        <tr>
                                          <td style="text-align: center;"><span style="color: #2e6da4; font-weight: bold;"><?= $cupdate->update->update_type ?></span><br />
                                          <span style="font-size: 12px;"><?= ConversionHelper::getDate($cupdate->update->date) ?><br/><?= $cupdate->user->username ?></span></td>
                                          <td><?= $uform->field($cupdate->update, 'update_text')->textarea(['id' => 'update_text' . $cupdate->id, 'title' => $cupdate->update->update_text, 'placeholder' => 'Enter ' . $cupdate->update->update_type, 'rows' => 4, 'style' => 'resize: vertical;'])->label(false) ?></td>
                                          <td><?= $uform->field($cupdate->update, 'response')->textarea(['id' => 'response' . $cupdate->id, 'title' => $cupdate->update->response, 'placeholder' => 'Enter Response', 'rows' => 4, 'style' => 'resize: vertical;'])->label(false) ?></td>
                                          <td style="text-align: center; width: 16%"><?php if (!empty($cupdate->update->due_date)) { ?>
                                                            <span class="date-day" style=" color: #2e6da4">
                                                    <?php $due_date = ConversionHelper::getDate($cupdate->update->due_date) ?>
                                                    
                                                    <?php  /*DatePicker::widget([
                                                        'id' => 'filter_due_date' . $cupdate->id,
                                                        'name' => 'filter_due_date' . $cupdate->id,
                                                        'value' => $due_date,
                                                        'options' => ['placeholder' => 'Due Date'],
                                                        'pluginOptions' => [
                                                            'format' => 'mm/dd/yyyy',
                                                            'autoclose' => true,
                                                            'todayHighlight' => true
                                                        ],
                                                    ]);*/

                                                  echo  DatePicker::widget([
                                        'id' => 'filter_due_date' . $cupdate->id,
                                        'name' => 'due_date',
                                        'value' => date("d/m/Y", strtotime($due_date)),
                                        'options' => ['placeholder' => 'Due Date'],
                                        'pluginOptions' => [
                                            'format' => 'mm/dd/yyyy',
                                            'autoclose' => true,
                                            'todayHighlight' => true
                                        ]
                                    ]);
                                                    ?>
                                                </span>
                                                            <br/>
                                                        <?php } ?></td>
                                          <td style="font-weight: normal; width: 15%">
                                              <input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="1" <?php if($cupdate->update->is_close==1) { ?> checked <?php } ?> /> <label style="font-weight: normal;" for="test<?= $i ?>">Open</label><br /><input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="0" <?php if($cupdate->update->is_close==0) { ?> checked <?php } ?> /> <label style="font-weight: normal;" for="test<?= $i ?>">Close</label><br />
                                              <input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="2" <?php if($cupdate->update->is_close==2) { ?> checked <?php } ?> /> <label style="font-weight: normal;" for="test<?= $i ?>">Critical</label><!--<br /><input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="3" /> <label style="font-weight: normal;" for="test<?= $i ?>">Request more info</label>-->
                                          </td>
                                          <td style="text-align: center; width: 10%"><?= $uform->field($cupdate->update, 'assigned_to')->textInput(['id' => 'assigned_to' . $cupdate->id, 'style' => 'margin-top:10px', 'title' => $cupdate->update->assigned_to, 'placeholder' => 'Whom to Follow Up with'])->label(false) ?></td>
                                          <td style="text-align: center;">
                                                                <center>
                                                                <div>
                                                                <button type="submit" id="update-button<?= $cupdate->id ?>"
                                                                class="btn btn-success">
                                                            <i class="fa fa-save"></i>
                                                        </button>
                                                        </div>
                                                        <div style="padding-top: 10px">
                                                        <button id="delete-update<?= $cupdate->id ?>"
                                                                type="button"
                                                                class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        </div>
                                                        </center>
                                                        <script>
                                                        $("#delete-update<?=$cupdate->id?>").click(function () {
                                                            var result = confirm("Are you sure you want to Delete this?");
                                                            if (result) {
                                                                $.ajax({
                                                                    url: "<?=Url::to(['update/delete-category-update', 'id' => base64_encode($cupdate->id)])?>",
                                                                    success: function (result) {
                                                                        $('#update-record-<?= $cupdate->id ?>').hide();
                                                                        $('#update-record-br-<?= $cupdate->id ?>').hide();
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    </script>
                                            </td>
                                        </tr>
                                        <?php
                                        ActiveForm::end();
                                        ?>
                                            <script>
                                            $(function () {
    $('#update-edit<?=$i?>').on('submit',function (e) {
var form = $(this);
                                                if (form.find('.has-error').length) {
                                                    return false;
                                                }
              $.ajax({
                                                    url: form.attr('action'),
                                                    type: 'post',
                                                    data: form.serialize(),
                                                    success: function (data) {
                                                        $('#update-edit<?=$i?>').hide().fadeIn('fast');
                                                    },
                                                    error: function () {
                                                        alert("Something went wrong");
                                                    }
                                                });
          e.preventDefault();
        });
});
                                        </script>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                      </tbody>
                                    </table>
                                  </div><!--end of .table-responsive-->
                                </div>
                              </div>
                            </div>
                                
                            </div>
                            <?php
                        }
            ?>
        </div>
        <?php
    }

    public function actionAccontent($id)
    {
        $i = uniqid();
        $model = Projects::findOne($id);
        ?>

        <div class="col-md-12">
            <hr style="margin-top: 0"/>
            <center><h4>PREVIOUS UPDATES</h4></center>
            <hr/>
            <?php
            foreach ($model->cfields as $cfield) {
                $uform = ActiveForm::begin(
                    [
                        'id' => 'custom-update' . $i,
                        'action' => Url::to(["custom-field/edit", 'id' => base64_encode($cfield->id)]),
                    ]
                );
                ?>
                <div class="row" id="custom-record-<?= $cfield->id ?>">
                    <div class="col-md-12">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?= $uform->field($cfield, 'field_label')->textInput(['id' => 'field_label' . $cfield->id, 'placeholder' => 'Enter Field Label'])->label(false) ?>
                                        </div>
                                        <div class="col-md-9">
                                            <?= $uform->field($cfield, 'field_value')->textInput(['id' => 'field_value' . $cfield->id, 'placeholder' => 'Enter Field Value'])->label(false) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-1"
                                         style="padding-left: 0; padding-right: 0; padding-top: 7px">
                                        <p>
                                            <?php if ($cfield->checkbox == 0) { ?>
                                                <input class="style-checkbox" name="is_checkbox"
                                                       type="checkbox"
                                                       id="chekbox<?= $i ?>"/>
                                                <label for="chekbox<?= $i ?>">&nbsp;</label>
                                            <?php } else { ?>
                                                <input class="style-checkbox" name="is_checkbox"
                                                       type="checkbox"
                                                       id="chekbox<?= $i ?>"
                                                       checked/>
                                                <label for="chekbox<?= $i ?>">&nbsp;</label>
                                            <?php } ?>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $uform->field($cfield, 'dashboard')->dropDownList(['0' => 'Dashboard?(No)', '1' => 'Dashboard?(Yes)'], ['id' => 'dashboard' . $cfield->id])->label(false) ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $uform->field($cfield, 'is_active')->dropDownList(['0' => 'Inactive', '1' => 'Active'], ['id' => 'is_active' . $cfield->id])->label(false) ?>
                                    </div>
                                    <div class="col-md-1">
                                        <center>
                                            <?= Html::submitButton('<i class="fa fa-save"></i>', ['class' => 'btn btn-success']) ?>
                                        </center>
                                    </div>
                                    <div class="col-md-2">
                                        <center>
                                            <span class="date-day"><b><?= $cfield->user->username ?></b> <b><?= ConversionHelper::getDate($cfield->date) ?></b></span>
                                        </center>
                                    </div>
                                    <div class="col-md-1">
                                        <center>
                                            <button id="delete-custom<?= $cfield->id ?>"
                                                    type="button"
                                                    class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </center>
                                        <script>
                                            $("#delete-custom<?=$cfield->id?>").click(function () {
                                                var result = confirm("Are you sure you want to Delete this?");
                                                if (result) {
                                                    $.ajax({
                                                        url: "<?=Url::to(['custom-field/delete', 'id' => base64_encode($cfield->id)])?>",
                                                        success: function (result) {
                                                            $('#custom-record-<?= $cfield->id ?>').hide().fadeOut('fast');
                                                        }
                                                    });
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
                <script>
                    $('#custom-update<?=$i?>').submit(function () {
                        var form = $(this);
                        if (form.find('.has-error').length) {
                            return false;
                        }
                        $.ajax({
                            url: form.attr('action'),
                            type: 'post',
                            data: form.serialize(),
                            success: function (data) {
                                $('#custom-update<?=$i?>').hide().fadeIn('slow');
                            },
                            error: function () {
                                alert("Something went wrong");
                            }
                        });
                        return false;
                    });
                </script>
                <?php
                $i++;
            }
            ?>
        </div>
        <?php
    }

    public function actionUpdates($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if (!empty($model)) {
            return $this->render('updates', [
                'model' => $model,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}