<?php

namespace app\controllers;
use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BlogController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$blog = Post::find()->where(['status'=>1])->orderBy(['create_time' => SORT_ASC])->all();
        return $this->render('index', ['blogs'=>$blog]);
    }

}
