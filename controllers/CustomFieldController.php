<?php

namespace app\controllers;

use app\components\QueryHelper;
use app\models\CustomFields;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CustomFieldController implements the CRUD actions for Projects model.
 */
class CustomFieldController extends Controller
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

    public function actionEdit($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if (QueryHelper::isAllowed($model->project->category_id)) {
            if ($model->load(Yii::$app->request->post())) {
                $model->checkbox = (!empty($_POST['is_checkbox']) && ($_POST['is_checkbox'] == 'on')) ? 1 : 0;
                $model->save(false);
            }
        }
    }

    public function actionDelete($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        if (QueryHelper::isAllowed($model->project->category_id)) {
            $model->delete();
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNew()
    {
        $model = new CustomFields();
        if ($model->load(Yii::$app->request->post())) {
            $model->checkbox = 0;
            $model->dashboard = 0;
            $model->is_active = 1;
            $model->date = date('Y-m-d');
            if ($model->validate()) {
                $model->save();
                echo json_encode($model->attributes);
            }
        }
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomFields the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomFields::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}