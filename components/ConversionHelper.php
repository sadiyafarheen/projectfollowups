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

class ConversionHelper
{
    static public function getDate($d)
    {
        return date('m/d/y', strtotime($d));
    }
    static public function getTime($t)
    {
        return date("h:i a", strtotime($t));
    }
}