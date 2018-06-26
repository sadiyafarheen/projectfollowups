<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Forgot Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Forgot Password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please enter you Email Address in the following field</p>

    <?php $form = ActiveForm::begin([
        'id' => 'forgot-password-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <div class="col-md-4">
        <div class="form-group">
            <?= Html::textInput('email_address', '', ['placeholder' => 'Enter Email', 'class' => 'form-control']) ?>
        </div>
        </div>

    <div class="form-group">
        <div class="col-lg-11">
            <?= Html::submitButton('Send Password', ['class' => 'btn btn-primary', 'name' => 'send-password-button']) ?>
        </div>
    </div>

    <?php
    if (Yii::$app->session->hasFlash('passwordSent')) {
        echo '<div class="alert">' . Yii::$app->session->getFlash('passwordSent') . '</div>';
    }
    ?>

    <?php ActiveForm::end(); ?>

</div>
