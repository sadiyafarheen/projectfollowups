<?php

namespace app\controllers;

use app\components\EmailHelper;
use app\components\QueryHelper;
use app\models\Discussions;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * DiscussionController implements the CRUD actions for Projects model.
 */
class CalendarController extends Controller
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
        return $this->render('/user/calendar');
    }

    public function actionGetProjects()
    {
        $user = User::findOne(Yii::$app->user->id);
        /*{
            "date":"1999-12-31",
            "badge":true,
            "title":"Tonight",
            "body":"<p class=\"lead\">Party<\/p><p>Like it's 1999.<\/p>",
            "footer":"At Paisley Park",
            "classname":"purple-event"
          },
        */
        $category_action_items = $user->categoryUpdates;
        $project_action_items = $user->projectUpdates;
        $data = array();
        $i = 0;
        foreach ($category_action_items as $item) {
            if (!empty($item->update->due_date)) {
                if (in_array($item->update->due_date, array_column($data, 'date'))) {
                    $key = array_search($item->update->due_date, array_column($data, 'date'));
                    $data[$key]['body'] .= "<hr/>
                        <p><b>Action Item &nbsp;: </b> &nbsp;&nbsp;" . $item->update->update_text . "</p>
                        <p><b>Assigned To : </b> &nbsp;&nbsp;" . $item->update->assigned_to . "</p>
                        <p><b>Against &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;" . $item->category->name . " (Topic)</p>
                        ";
                } else {
                    $data[$i]['date'] = $item->update->due_date;
                    $data[$i]['badge'] = true;
                    $data[$i]['title'] = "Action Items";
                    $data[$i]['body'] = "
                        <p><b>Action Item &nbsp;: </b> &nbsp;&nbsp;" . $item->update->update_text . "</p>
                        <p><b>Assigned To : </b> &nbsp;&nbsp;" . $item->update->assigned_to . "</p>
                        <p><b>Against &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;" . $item->category->name . " (Topic)</p>
                        ";
                    $data[$i]['footer'] = "Due By : &nbsp;&nbsp;" . $item->update->due_date;
                    $i++;
                }
            }
        }
        foreach ($project_action_items as $item) {
            if (!empty($item->update->due_date)) {
                if (in_array($item->update->due_date, array_column($data, 'date'))) {
                    $key = array_search($item->update->due_date, array_column($data, 'date'));
                    $data[$key]['body'] .= "<hr/>
                        <p><b>Action Item &nbsp;: </b> &nbsp;&nbsp;" . $item->update->update_text . "</p>
                        <p><b>Assigned To : </b> &nbsp;&nbsp;" . $item->update->assigned_to . "</p>
                        <p><b>Against &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;" . $item->project->title . " (Project) under " . $item->project->category->name. " (Topic)</p>
                        ";
                } else {
                    $data[$i]['date'] = $item->update->due_date;
                    $data[$i]['badge'] = true;
                    $data[$i]['title'] = "Action Items";
                    $data[$i]['body'] = "
                        <p><b>Action Item &nbsp;: </b> &nbsp;&nbsp;" . $item->update->update_text . "</p>
                        <p><b>Assigned To : </b> &nbsp;&nbsp;" . $item->update->assigned_to . "</p>
                        <p><b>Against &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;" . $item->project->title . " (Project) under " . $item->project->category->name. " (Topic)</p>
                        ";
                    $data[$i]['footer'] = "Due By : &nbsp;&nbsp;" . $item->update->due_date;
                    $i++;
                }
            }
        }
        $data = json_encode($data);
        echo $data;
    }
}
