<?php

namespace app\controllers;

use app\models\Projects;
use app\models\ProjectSearch;
use app\models\Ratings;
use app\models\Updates;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CustomFieldController implements the CRUD actions for Projects model.
 */
class ReportController extends Controller
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

    public function actionUpdates()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new ProjectSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 0, 0, 0, Yii::$app->user->id);
            // validate if there is a editable input saved via AJAX
            if (Yii::$app->request->post('hasEditable')) {
                // instantiate your book model for saving
                $projectId = Yii::$app->request->post('editableKey');
                $model1 = Projects::findOne($projectId);
                if (!empty($model1)) {
                    // store a default json response as desired by editable
                    $out = Json::encode(['output' => '', 'message' => '']);
                    // fetch the first entry in posted data (there should only be one entry
                    // anyway in this array for an editable submission)
                    // - $posted is the posted data for Book without any indexes
                    // - $post is the converted array for single model validation
                    if (isset($_POST['Projects'])) {
                        $posted = current($_POST['Projects']);
                        $post = ['Projects' => $posted];
                        $output = '';
                        // load model like any single model validation
                        if ($model1->load($post)) {
                            // can save model or do something before saving model
                            $model1->save();

                            // custom output to return to be displayed as the editable grid cell
                            // data. Normally this is empty - whereby whatever value is edited by
                            // in the input by user is updated automatically.


                            // specific use case where you need to validate a specific
                            // editable column posted when you have more than one
                            // EditableColumn in the grid view. We evaluate here a
                            // check to see if buy_amount was posted for the Book model
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
                            // similarly you can check if the name attribute was posted as well
                            // if (isset($posted['name'])) {
                            // $output = ''; // process as you need
                            // }
                            $out = Json::encode(['output' => $output, 'message' => '']);
                        }
                        echo $out;
                        return;
                    } else {
                        // instantiate your book model for saving
                        $taskId = Yii::$app->request->post('editableKey');
                        $model2 = Updates::findOne($taskId);
                        $output = '';
                        $out = Json::encode(['output' => '', 'message' => '']);
                        // fetch the first entry in posted data (there should only be one entry
                        // anyway in this array for an editable submission)
                        // - $posted is the posted data for Book without any indexes
                        // - $post is the converted array for single model validation
                        $posted2 = current($_POST['Updates']);
                        if (isset($_POST['Updates'])) {
                            $post2 = ['Updates' => $posted2];

                            // load model like any single model validation
                            if ($model2->load($post2)) {
                                // can save model or do something before saving model
                                $model2->save();

                                // custom output to return to be displayed as the editable grid cell
                                // data. Normally this is empty - whereby whatever value is edited by
                                // in the input by user is updated automatically.
                                $output2 = '';

                                // specific use case where you need to validate a specific
                                // editable column posted when you have more than one
                                // EditableColumn in the grid view. We evaluate here a
                                // check to see if buy_amount was posted for the Book model
                                if (isset($posted2['is_close'])) {
                                    $output = $model2->is_close ? "Yes" : "No";
                                }
                                if (isset($posted2['due_date'])) {
                                    $output = Yii::$app->formatter->asDate($model2->due_date, 'M/d/Y');
                                }
                                if (isset($posted2['date'])) {
                                    $output = Yii::$app->formatter->asDate($model2->date, 'M/d/Y');
                                }
                                $out = Json::encode(['output' => $output, 'message' => '']);
                            }
                            echo $out;
                            return;
                        }
                    }
                } else {
                    // instantiate your book model for saving
                    $taskId = Yii::$app->request->post('editableKey');
                    $model2 = Updates::findOne($taskId);
                    $output = '';
                    $out = Json::encode(['output' => '', 'message' => '']);
                    // fetch the first entry in posted data (there should only be one entry
                    // anyway in this array for an editable submission)
                    // - $posted is the posted data for Book without any indexes
                    // - $post is the converted array for single model validation
                    $posted2 = current($_POST['Updates']);
                    if (isset($_POST['Updates'])) {
                        $post2 = ['Updates' => $posted2];

                        // load model like any single model validation
                        if ($model2->load($post2)) {
                            // can save model or do something before saving model
                            $model2->save();

                            // custom output to return to be displayed as the editable grid cell
                            // data. Normally this is empty - whereby whatever value is edited by
                            // in the input by user is updated automatically.
                            $output2 = '';

                            // specific use case where you need to validate a specific
                            // editable column posted when you have more than one
                            // EditableColumn in the grid view. We evaluate here a
                            // check to see if buy_amount was posted for the Book model
                            if (isset($posted2['is_close'])) {
                                $output = $model2->is_close ? "Yes" : "No";
                            }
                            if (isset($posted2['due_date'])) {
                                $output = Yii::$app->formatter->asDate($model2->due_date, 'M/d/Y');
                            }
                            if (isset($posted2['date'])) {
                                $output = Yii::$app->formatter->asDate($model2->date, 'M/d/Y');
                            }
                            $out = Json::encode(['output' => $output, 'message' => '']);
                        }
                        echo $out;
                        return;
                    }
                }
            }

            return $this->render('updates', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}