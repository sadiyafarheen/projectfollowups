<?php

namespace app\controllers;

use app\components\EmailHelper;
use app\components\QueryHelper;
use app\models\Discussions;
use app\models\User;
use app\models\UserCategoryPermissions;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii2fullcalendar\models\Event;

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
        /*$events = QueryHelper::getUserUpdates(Yii::$app->user->id);*/
        $events = array();
        $shared_categories_perms = UserCategoryPermissions::find()->where(['user_id' => Yii::$app->user->id])->all();
        if (!empty($shared_categories_perms)) {
            foreach ($shared_categories_perms as $scp) {
                $events = array_merge($events, QueryHelper::getCategoryUpdates($scp->category));
            }
        }

        return $this->render('/user/calendar', ['events' => $events]);
    }

    /*public function actionGetProjects()
    {
        $user = User::findOne(Yii::$app->user->id);
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
    }*/
}
