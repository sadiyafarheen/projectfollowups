<?php

namespace app\controllers\user;

use app\models\User;
use dektrium\user\controllers\RegistrationController as BaseRegistrationController;
use dektrium\user\helpers\Password;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * RegistrationController implements the CRUD actions for Users model.
 */
class RegistrationController extends BaseRegistrationController
{
    public function actionSetPassword($uid, $cid)
    {
        $id = base64_decode($uid);
        $cid = base64_decode($cid);
        $model = User::findOne($id);
        if ($model->id == Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post())) {
                $model->password_hash = Password::hash($model->password_hash);
                if($model->save()){
                    return $this->redirect(['/category/clean-view', 'id' => base64_encode($cid)]);
                }
            } else {
                return $this->render('set-password', [
                    'model' => $model,
                ]);
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
