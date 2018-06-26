<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php if($model->isNewRecord) { ?>
        <p><span style="color: #5cb85c">Sign up </span>to start getting traction on your projects.</p>
    <?php } else { ?>
        <p><span style="color: red">Note : </span>If you do not want to Change Password. Keep password fields blank</p>
    <?php } ?>
    <br/>
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-md-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-md-1 control-label'],
        ],
    ]); ?>

    <?php if($model->isNewRecord) { ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
    <?php } ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value' => '']) ?>

    <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true, 'style' => 'margin-top : 10px']) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton($model->isNewRecord ? 'Sign Up' : 'Save',
                [
                    'class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success'
                ]
            ) ?>
        </div>
    </div>

    <?php
    if (Yii::$app->session->hasFlash('emailSent')) {
        echo '<div class="alert">' . Yii::$app->session->getFlash('emailSent') . '</div>';
    }
    ?>

    <?php ActiveForm::end(); ?>

</div>
