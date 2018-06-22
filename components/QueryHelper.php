<?php
/**
 * Created by PhpStorm.
 * User: umairawan
 * Date: 31/12/16
 * Time: 3:54 PM
 */
// ---

namespace app\components;

use app\models\Categories;
use app\models\Projects;
use app\models\Ratings;
use app\models\UserCategoryPermissions;
use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class QueryHelper
{
    static public function isAllowed($catId)
    {
        $model = UserCategoryPermissions::find()->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['category_id' => $catId])
            ->andWhere(['is_allowed' => 1])
            ->one();
        if(!empty($model)){
            return true;
        }
        return false;
    }

    static public function getAllowedUsers($catId)
    {
        $models = UserCategoryPermissions::find()->where(['category_id' => $catId])->andWhere(['is_allowed' => 1])->all();
        if(!empty($models)){
            return $models;
        }
        return false;
    }

    static public function createDefault($user)
    {
        $category = new Categories();
        $category->user_id = $user->id;
        $category->name = "Getting Started";
        if ($category->save()) {
            for ($i = 1; $i <= 5; $i++) {
                $project = new Projects();
                $project->category_id = $category->id;
                $project->user_id = $user->id;
                $project->title = "Project {$i}";
                $project->start_date = date("Y-m-d");
                $project->end_date = date("Y-m-d", strtotime("$project->start_date +14 days"));
                $project->custom_field = "TBD";
                $project->save();
            }

            $cp_model = new UserCategoryPermissions();
            $cp_model->user_id = $user->id;
            $cp_model->category_id = $category->id;
            $cp_model->is_allowed = 1;
            $cp_model->save();
        }
    }

    static public function shareCategory($name = null, $email, $cat_id)
    {
        $user = User::findOne(Yii::$app->user->id);
        $model = User::find()->where(['email' => $email])->one();
        $new = 0;
        if (empty($model)) {
            $model = new User();
            $model->username = "Anonymous".rand();
            $model->email = $email;
            $model->password_hash = '$2y$12$fMNOqZG97yOE8TvaoZxAFuJlx.DxaCUO.7K3lhRFElxQHHsLpw9MO';
            $model->save();
            $new = 1;
        }
        $ucp_model = UserCategoryPermissions::find()->where(['user_id' => $model->id])->andWhere(['category_id' => $cat_id])->one();
        if (empty($ucp_model)) {
            $ucp_model = new UserCategoryPermissions();
            $ucp_model->user_id = $model->id;
            $ucp_model->category_id = $cat_id;
            $ucp_model->is_allowed = 1;
            $ucp_model->save();

            $sub = $user->username . ' has shared projects with you from the project traction app ' .'<a href="http://' . Yii::$app->params['siteUrl'] . '">projectfollowups.com</a>';
            $html = "";
            if($new){
                $html = "Default Password is : <b>12345678</b>";
            }
            $html = $html . "<br/>
                <a href='http://" . Yii::$app->params['siteUrl'] . "/category/share?category=" . base64_encode($ucp_model->id) . "&new=" . $new . "'>
                    Click here to access the projects in the {$ucp_model->category->name} Topic
                </a>";
            EmailHelper::Send($model->email, Yii::$app->params['adminEmail'], $sub, $html);
        }

        /*$sub = $user->username . ' has shared projects with you from the project traction app ' .'<a href="http://' . Yii::$app->params['siteUrl'] . '">projectfollowups.com</a>';
        $html = "";
        if($new){
            $html = "Default Password is : <b>12345678</b>";
        }
        $html = $html . "<br/>
                <a href='http://" . Yii::$app->params['siteUrl'] . "/category/share?category=" . base64_encode($ucp_model->id) . "&new=" . $new . "'>
                    Click here to access the projects in the {$ucp_model->category->name} Topic
                </a>";*/
    }
}