<?php

namespace app\controllers;

use app\components\EmailHelper;
use app\components\QueryHelper;
use app\models\Discussions;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * DiscussionController implements the CRUD actions for Projects model.
 */
class DiscussionController extends Controller
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

    public function actionCreate()
    {
        $model = new Discussions();
        if ($model->load(Yii::$app->request->post())) {
            $date = $model->date;
            $model->date = date('Y-m-d');
            $model->time = date('H:i:s');
            if ($model->save()) {
                $perms = QueryHelper::getAllowedUsers($model->project->category_id);
                foreach ($perms as $perm) {
                    $sub = $model->user->username . ' has posted a discussion message for the project ' . $model->project->title;
                    $html = "<p>'<i>{$model->text}</i>' by <b><i>{$model->user->username}</i></b> on <b>" . date('d/m/y', strtotime($model->date)) . "</b></p>
                            <br/><br/>
                             <a href='" . Url::to(['category/view', 'id' => base64_encode($model->project->category_id)]) . "'>
                                (Click here to access the project(s) in the {$model->project->category->name} category)
                             </a>";
                    EmailHelper::Send($perm->user->email, Yii::$app->params['adminEmail'], $sub, $html);
                }
            }
        }
    }

    protected function findModel($id)
    {
        if (($model = Discussions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
