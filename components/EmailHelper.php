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

class EmailHelper
{
    static public function Send($to, $from, $sub, $html)
    {
        Yii::$app->mailer->compose()
            ->setTo($to)
            ->setFrom($from)
            ->setSubject($sub)
            ->setHtmlBody($html)
            ->send();
    }
}