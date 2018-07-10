<?php
/**
 * Created by PhpStorm.
 * User: umairawan
 * Date: 31/12/16
 * Time: 3:54 PM
 */
// ---

namespace app\components;

use app\models\Project;
use app\models\Ratings;
use app\models\UserProjects;
use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class CategoryMenuHelper
{
    static public function getItems($category)
    {
        return [
            ['label' => '<i class="fa fa-bookmark"></i> Project Page', 'url' => ['/category/clean-view', 'id' => base64_encode($category->id)]],
            ['label' => '<i class="fa fa-bars"></i> Action Items & Accomplishments', 'url' => ['/category/updates', 'id' => base64_encode($category->id)]],
            ['label' => '<i class="fa fa-paperclip"></i> Notes', 'url' => ['/category/notes', 'id' => base64_encode($category->id)]],
            ['label' => '<i class="fa fa-share"></i> Share Projects', 'url' => ['/category/view', 'id' => base64_encode($category->id), '#' => 'permissions']],
            //['label' => '<i class="fa fa-bookmark"></i> Recognize Someone', 'url' => ['/pulse/create', 'id' => '']],
            ['label' => '<i class="fa fa-smile-o" aria-hidden="true"></i> Gut Feeling', 'url' => ['/pulse/create/', 'id' => base64_encode($category->id)]],
            ['label' => '<i class="fa fa-object-group" aria-hidden="true"></i> Meeting', 'url' => ['#', 'id' => '']],
            ['label' => '<i class="fa fa-list-ul" aria-hidden="true"></i> Action Items', 'url' => ['#', 'id' => '']],
            ['label' => '<i class="fa fa-columns" aria-hidden="true"></i> Pulse Dashboard', 'url' => ['#', 'id' => base64_encode($category->id)]],
            ['label' => '<i class="fa fa-table" aria-hidden="true"></i> Worksheet', 'url' => ['#', 'id' => '']],
            ['label' => '<i class="fa fa-users" aria-hidden="true"></i> Team Members', 'url' => ['#', 'id' => '']],
            //['label' => '<i class="fa fa-bookmark"></i> Project Goals and Objectives (future)', 'url' => ['#', 'id' => '']],
        ];
    }
}