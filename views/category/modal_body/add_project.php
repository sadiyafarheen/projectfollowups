<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 19/08/2017
 * Time: 05:19 PM
 */
use app\models\Projects;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add a New Project</h4>
        </div>
        <div class="modal-body">
            <?php
            $pmodel = new Projects();
            $form = ActiveForm::begin(
                [
                    'id' => 'form-profile123',
                    'action' => Yii::$app->urlManager->createUrl(["project/create"]),
                ]
            ); ?>
            <div class="row">
                <?= $form->field($pmodel, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
                <?= $form->field($pmodel, 'category_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <?= $form->field($pmodel, 'title')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($pmodel, 'assigned_to')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <?= $form->field($pmodel, 'phase')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($pmodel, 'status')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <?= $form->field($pmodel, 'start_date')->widget(
                            DatePicker::className(), [
                            'pluginOptions' => [
                                'format' => 'mm/dd/yyyy',
                                'autoclose' => true,
                                'todayHighlight' => true
                            ]
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($pmodel, 'end_date')->widget(
                            DatePicker::className(), [
                            'pluginOptions' => [
                                'format' => 'mm/dd/yyyy',
                                'autoclose' => true,
                                'todayHighlight' => true
                            ]
                        ]); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <?= $form->field($pmodel, 'stake_holder')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($pmodel, 'priority')->dropDownList(['High' => 'High', 'Medium' => 'Medium', 'Low' => 'Low'], ['prompt' => '-- select --']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <?= $form->field($pmodel, 'more_info')->textarea(['rows' => 2]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <center>
                    <div class="form-group">
                        <?= Html::submitButton('Add', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </center>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
