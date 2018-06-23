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

    public function actionAucontent($id, $assigned_to = null, $is_close = null, $due_date = null, $due = null)
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
        $i = uniqid();
        $model = Projects::findOne($id);
        ?>

        <div class="col-md-12">
            <?php
            $id = $model->id;
            if (!empty($model->pupdates)) {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            Previous Updates
                            <span class="header2">
                            <button id="icon2" class="btn btn-primary" style="float: right; margin-right: 37px">
                                <i class="fa fa-minus"></i>
                            </button>
                        </span>
                            <button type="button" title="Clear Filters" id="filter-clear-button"
                                    style="float: right; margin-right: 5px"
                                    class="btn btn-warning">
                                <i class="fa fa-ban"></i>
                            </button>
                        </h4>
                        <hr style="margin-top: 29px !important"/>
                    </div>
                </div>
                <div class="content2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-9" style="width: 77%">
                                <div class="col-md-2" style="width: 13%">

                                </div>
                                <div class="col-md-10" style="width: 86.333333%">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <select class="form-control" name="filter_assigned_to"
                                                            id="filter_assigned_to<?= $id ?>">
                                                        <option value="">Filter By Follow up with</option>
                                                        <?php
                                                        foreach ($model->pupdates as $item) {
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
                            <div class="col-md-2" style="width: 14.666667%; padding: 0">
                                <?php /*DatePicker::widget([
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
                            <div class="col-md-1">
                                <center>
                                    <button type="button" id="filter-search-button"
                                            class="btn btn-info">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </center>
                            </div>
                        </div>
                        <script>
                            $("#filter_assigned_to<?= $id?>").val("<?= $assigned_to?>");
                            $("#filter_is_close<?= $id?>").val("<?= $is_close?>");
                            $("#filter_due_date<?= $i?>").val("<?= $due_date?>");
                            $("#filter_due_by<?= $id?>").val("<?= $due?>");

                            $('#filter-search-button').click(function () {
                                var a = $("#filter_assigned_to<?= $id?>").val();
                                var c = $("#filter_is_close<?= $id?>").val();
                                var d = $("#filter_due_date<?= $i?>").val();
                                var t = $("#filter_due_by<?= $id?>").val();
                                var params = {id: <?=$model->id?>, assigned_to: a, is_close: c, due_date: d, due: t};
                                var url = jQuery.param(params);
                                $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                            });
                            $('#filter-clear-button').click(function () {
                                var params = {id: <?=$model->id?>};
                                var url = jQuery.param(params);
                                $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                            });

                            $(".header2").click(function () {

                                $header = $(this);
                                //getting the next element
                                $content = $(".content2");
                                //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
                                $content.slideToggle(200, function () {
                                    //execute this after slideToggle is done
                                    //change text of header based on visibility of content div
                                    $header.html(function () {
                                        //change text based on condition
                                        return $content.is(":visible") ? '<button id="icon2" class="btn btn-primary" style="float: right; margin-right: 37px"><i class="fa fa-minus"></i></button>' : '<button id="icon2" class="btn btn-primary" style="float: right; margin-right: 37px"><i class="fa fa-plus"></i></button>';
                                    });
                                });

                            });
                        </script>
                    </div>
                    <hr/>

                    <?php
                    $pupdates = ProjectUpdates::find()
                        ->joinWith(['update'])
                        ->select(['*'])
                        ->where(['user_id' => $model->user_id, 'project_id' => $model->id])
                        ->andFilterWhere(['like', 'updates.assigned_to', $assigned_to])
                        ->andFilterWhere(['like', 'updates.due_date', $due_date_pattern])
                        ->andFilterWhere(['updates.is_close' => $is_close])
                        ->andWhere($due_query)
                        ->groupBy('updates.id')
                        ->orderBy([
                            'updates.is_close' => SORT_ASC,
                            'project_updates.id' => SORT_DESC
                        ])
                        ->all();
                    foreach ($pupdates as $pupdate) {
                        if (!empty($pupdate->update)) {
                            $uform = ActiveForm::begin(
                                [
                                    'id' => 'update-edit' . $i,
                                    'action' => Yii::$app->urlManager->createUrl(["update/edit", 'id' => base64_encode($pupdate->update->id)]),
                                ]
                            );
                            ?>
                            <div class="row" id="update-record-<?= $pupdate->id ?>">
                                <div class="col-md-12">
                                    <div class="col-md-9" style="width: 77%">
                                        <div class="col-md-2" style="width: 13%">
                                            <b style="font-size: 14px"><?= $pupdate->update->update_type ?></b>
                                        </div>
                                        <div class="col-md-10" style="width: 86.333333%">
                                            <?= $uform->field($pupdate->update, 'update_text')->textInput(['id' => 'update_text' . $pupdate->id, 'title' => $pupdate->update->update_text, 'placeholder' => 'Enter ' . $pupdate->update->update_type])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width: 14.666667%">
                                        <center>
                                            <?php if (!empty($pupdate->update->due_date)) { ?>
                                                <span class="date-day">
                                                    <b style="color: red">Due By : </b>
                                                    <b><?= ConversionHelper::getDate($pupdate->update->due_date) ?></b>
                                                </span>
                                                <br/>
                                            <?php } ?>
                                            <div style="padding-top: 7px;">
                                                <p>
                                                    <?php if ($pupdate->update->is_close == 0) { ?>
                                                        <input class="style-checkbox" name="is_close"
                                                               type="checkbox"
                                                               id="test<?= $i ?>"/>
                                                        <label for="test<?= $i ?>">&nbsp;</label>
                                                    <?php } else { ?>
                                                        <input class="style-checkbox" name="is_close"
                                                               type="checkbox"
                                                               id="test<?= $i ?>"
                                                               checked/>
                                                        <label for="test<?= $i ?>">&nbsp;</label>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                        </center>
                                    </div>
                                    <div class="col-md-1">
                                        <center>
                                            <button type="submit" id="update-button<?= $pupdate->id ?>"
                                                    class="btn btn-success">
                                                <i class="fa fa-save"></i>
                                            </button>
                                        </center>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-9" style="width: 77%">
                                        <div class="col-md-2" style="width: 13%">
                                                    <span class="date-day">
                                                        <b><?= ConversionHelper::getDate($pupdate->update->date) ?></b><br/>
                                                        <b><?= $pupdate->user->username ?></b>
                                                    </span>
                                        </div>
                                        <div class="col-md-10" style="width: 86.333333%">
                                            <?= $uform->field($pupdate->update, 'response')->textarea(['id' => 'response' . $pupdate->id, 'title' => $pupdate->update->response, 'placeholder' => 'Enter Response', 'rows' => 3, 'style' => 'resize: vertical;'])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width: 14.666667%; padding: 0">
                                        <center>
                                            <b class="date-day" style="color: dodgerblue">Whom to Followup With </b>
                                            <br/>
                                            <?= $uform->field($pupdate->update, 'assigned_to')->textInput(['id' => 'assigned_to' . $pupdate->id, 'style' => 'margin-top:10px', 'title' => $pupdate->update->assigned_to, 'placeholder' => 'Whom to Follow Up with'])->label(false) ?>
                                        </center>
                                    </div>
                                    <div class="col-md-1">
                                        <center>
                                            <button id="delete-update<?= $pupdate->id ?>"
                                                    type="button"
                                                    class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </center>
                                        <script>
                                            $("#delete-update<?=$pupdate->id?>").click(function () {
                                                var result = confirm("Are you sure you want to Delete this?");
                                                if (result) {
                                                    $.ajax({
                                                        url: "<?=Url::to(['update/delete', 'id' => base64_encode($pupdate->id)])?>",
                                                        success: function (result) {
                                                            $('#update-record-<?= $pupdate->id ?>').hide();
                                                            $('#update-record-br-<?= $pupdate->id ?>').hide();
                                                        }
                                                    });
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: 0" id="update-record-br-<?= $pupdate->id ?>"/>
                        <?php
                        ActiveForm::end();
                        ?>
                            <script>
                                $('#update-edit<?=$i?>').submit(function () {
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
                                    return false;
                                });
                            </script>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    public function actionAcucontent($id, $assigned_to = null, $is_close = null, $due_date = null, $due = null)
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
        $i = uniqid();
        $model = Categories::findOne($id);
        ?>

        <div class="col-md-12">
            <?php
            $id = $model->id;
            if (!empty($model->cupdates)) {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            Previous Updates &nbsp;
                            <span class="header2">
                            <button id="icon2" class="btn btn-primary" style="float: right; margin-right: 37px">
                                <i class="fa fa-minus"></i>
                            </button>
                        </span>
                            <button type="button" title="Clear Filters" id="filter-clear-button"
                                    style="float: right; margin-right: 5px"
                                    class="btn btn-warning">
                                <i class="fa fa-ban"></i>
                            </button>
                        </h4>
                        <hr style="margin-top: 29px !important"/>
                    </div>
                </div>
                <div class="content2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-9" style="width: 77%">
                                <div class="col-md-2" style="width: 13%">

                                </div>
                                <div class="col-md-10" style="width: 86.333333%">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <select class="form-control" name="filter_assigned_to"
                                                            id="filter_assigned_to<?= $id ?>">
                                                        <option value="">Filter By Follow up with</option>
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
                            <div class="col-md-2" style="width: 14.666667%; padding: 0">
                                <?php /*DatePicker::widget([
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
                            <div class="col-md-1">
                                <center>
                                    <button type="button" id="filter-search-button"
                                            class="btn btn-info">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </center>
                            </div>
                        </div>
                        <script>
                            $("#filter_assigned_to<?= $id?>").val("<?= $assigned_to?>");
                            $("#filter_is_close<?= $id?>").val("<?= $is_close?>");
                            $("#filter_due_date<?= $i?>").val("<?= $due_date?>");
                            $("#filter_due_by<?= $id?>").val("<?= $due?>");

                            $('#filter-search-button').click(function () {
                                var a = $("#filter_assigned_to<?= $id?>").val();
                                var c = $("#filter_is_close<?= $id?>").val();
                                var d = $("#filter_due_date<?= $i?>").val();
                                var t = $("#filter_due_by<?= $id?>").val();
                                var params = {id: <?=$model->id?>, assigned_to: a, is_close: c, due_date: d, due: t};
                                var url = jQuery.param(params);
                                $('#update-fields<?=$model->id?>').load("acucontent?" + url);
                            });
                            $('#filter-clear-button').click(function () {
                                var params = {id: <?=$model->id?>};
                                var url = jQuery.param(params);
                                $('#update-fields<?=$model->id?>').load("acucontent?" + url);
                            });

                            $(".header2").click(function () {

                                $header = $(this);
                                //getting the next element
                                $content = $(".content2");
                                //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
                                $content.slideToggle(200, function () {
                                    //execute this after slideToggle is done
                                    //change text of header based on visibility of content div
                                    $header.html(function () {
                                        //change text based on condition
                                        return $content.is(":visible") ? '<button id="icon2" class="btn btn-primary" style="float: right; margin-right: 37px"><i class="fa fa-minus"></i></button>' : '<button id="icon2" class="btn btn-primary" style="float: right; margin-right: 37px"><i class="fa fa-plus"></i></button>';
                                    });
                                });

                            });
                        </script>
                    </div>
                    <hr/>

                    <?php
                    $cupdates = CategoryUpdates::find()
                        ->joinWith(['update'])
                        ->select(['*'])
                        ->where(['user_id' => $model->user_id, 'category_id' => $model->id])
                        ->andFilterWhere(['like', 'updates.assigned_to', $assigned_to])
                        ->andFilterWhere(['like', 'updates.due_date', $due_date_pattern])
                        ->andFilterWhere(['updates.is_close' => $is_close])
                        ->andWhere($due_query)
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
                            <div class="row" id="update-record-<?= $cupdate->id ?>">
                                <div class="col-md-12">
                                    <div class="col-md-9" style="width: 77%">
                                        <div class="col-md-2" style="width: 13%">
                                            <b style="font-size: 14px"><?= $cupdate->update->update_type ?></b>
                                        </div>
                                        <div class="col-md-10" style="width: 86.333333%">
                                            <?= $uform->field($cupdate->update, 'update_text')->textInput(['id' => 'update_text' . $cupdate->id, 'title' => $cupdate->update->update_text, 'placeholder' => 'Enter ' . $cupdate->update->update_type])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width: 14.666667%">
                                        <center>
                                            <?php if (!empty($cupdate->update->due_date)) { ?>
                                                <span class="date-day">
                                                    <b style="color: red">Due By : </b>
                                                    <b><?= ConversionHelper::getDate($cupdate->update->due_date) ?></b>
                                                </span>
                                                <br/>
                                            <?php } ?>
                                            <div style="padding-top: 7px;">
                                                <p>
                                                    <?php if ($cupdate->update->is_close == 0) { ?>
                                                        <input class="style-checkbox" name="is_close"
                                                               type="checkbox"
                                                               id="test<?= $i ?>"/>
                                                        <label for="test<?= $i ?>">&nbsp;</label>
                                                    <?php } else { ?>
                                                        <input class="style-checkbox" name="is_close"
                                                               type="checkbox"
                                                               id="test<?= $i ?>"
                                                               checked/>
                                                        <label for="test<?= $i ?>">&nbsp;</label>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                        </center>
                                    </div>
                                    <div class="col-md-1">
                                        <center>
                                            <button type="submit" id="update-button<?= $cupdate->id ?>"
                                                    class="btn btn-success">
                                                <i class="fa fa-save"></i>
                                            </button>
                                        </center>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-9" style="width: 77%">
                                        <div class="col-md-2" style="width: 13%">
                                                    <span class="date-day">
                                                        <b><?= ConversionHelper::getDate($cupdate->update->date) ?></b><br/>
                                                        <b><?= $cupdate->user->username ?></b>
                                                    </span>
                                        </div>
                                        <div class="col-md-10" style="width: 86.333333%">
                                            <?= $uform->field($cupdate->update, 'response')->textarea(['id' => 'response' . $cupdate->id, 'title' => $cupdate->update->response, 'placeholder' => 'Enter Response', 'rows' => 3, 'style' => 'resize: vertical;'])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width: 14.666667%; padding: 0">
                                        <center>
                                            <b class="date-day" style="color: dodgerblue">Follow up with </b>
                                            <br/>
                                            <?= $uform->field($cupdate->update, 'assigned_to')->textInput(['id' => 'assigned_to' . $cupdate->id, 'style' => 'margin-top:10px', 'title' => $cupdate->update->assigned_to, 'placeholder' => 'Enter Follow up with'])->label(false) ?>
                                        </center>
                                    </div>
                                    <div class="col-md-1">
                                        <center>
                                            <button id="delete-update<?= $cupdate->id ?>"
                                                    type="button"
                                                    class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
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
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: 0" id="update-record-br-<?= $cupdate->id ?>"/>
                        <?php
                        ActiveForm::end();
                        ?>
                            <script>
                                $('#update-edit<?=$i?>').submit(function () {
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
                                    return false;
                                });
                            </script>
                            <?php
                            $i++;
                        }
                    }
                    ?>
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