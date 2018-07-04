<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Pulse */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="container">
    <div class="row">
      <?php $form = ActiveForm::begin(); ?>
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label class="control-label" for="pulse-how_you_feel" style="font-weight: normal;">Tell me how you are feeling about the project at this time?</label>
            <div class="col-md-12">
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/great.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Great</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Great">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/happy.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Happy</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Happy">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/fabulous.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Fabulous</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Fabulous">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/curious.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Curious</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Curious">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/blah.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Blah</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Blah">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/down.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Down</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Down">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px; margin-bottom: 40px">
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/positive.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Positive</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Positive">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/sad.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Sad</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Sad">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/shocked.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Shocked</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Shocked">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/wonderful.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Wonderful</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Wonderful">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/worried.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Worried</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Worried">
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/heartbroken.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Heartbroken</i><br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Heartbroken">
                        </div>
                    </div>
                    </div>
                </div>
        </div>
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label class="control-label" for="pulse-about_project_health" style="font-weight: normal;">What is your feeling about the health of the project at this time?</label>
            <div class="col-md-12">
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-2" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/thumbsup.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Thumbs up</i><br /><input type="checkbox" name="Pulse[about_project_health][]" value="Great">
                        </div>
                        <div class="col-md-3" style="text-align: center;">
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/images/thumbsdown.png" width="30"><br /><i style="color:#337AB7; font-size:12px">Thumbs down</i><br /><input type="checkbox" name="Pulse[about_project_health][]" value="Happy">
                        </div>
                    </div>
                    </div>
                </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-md-12">
            <?= $form->field($model, 'any_notes')->textarea(['rows' => 6, 'placeholder'=> 'Any Notes?'])->label(false); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="new-accomplishment<?= $model->id ?>" class="form-control"
                           placeholder="Enter Accomplishment"
                           name="accomplishment"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="new-concern<?= $model->id ?>" class="form-control"
                           placeholder="Enter Concern"
                           name="concern"/>
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="new-decision<?= $model->id ?>" class="form-control"
                           placeholder="Enter Decision"
                           name="decision"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="new-notes<?= $model->id ?>" class="form-control"
                           placeholder="Enter Next Steps or Notes"
                           name="notes"/>
                    
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="new-followup<?= $model->id ?>" class="form-control"
                           placeholder="Enter Action Item"
                           name="followup"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" id="new-assigned-to<?= $model->id ?>" class="form-control"
                           placeholder="Follow up with"
                           name="assigned_to"/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?=
                    DatePicker::widget([
                        'id' => 'due_date',
                        'name' => 'due_date',
                        'options' => ['placeholder' => 'Due Date'],
                        'pluginOptions' => [
                            'format' => 'mm/dd/yyyy',
                            'autoclose' => true,
                            'todayHighlight' => true
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-md-12">
            <?= $form->field($model, 'is_agenda')->checkbox(array(
                    'label'=>'&nbsp;&nbsp;&nbsp;&nbsp;Check the box if you want this item to be added as an agenda item',
                    'labelOptions'=>array('style'=>'padding:10px; font-weight:normal'),
                    'disabled'=>true
                    ))
                    ->label(false); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-md-12">
            <?= $form->field($model, 'action_taken')->textarea(['rows' => 6, 'placeholder' => 'Based on your feeling about the project what action would you like taken and by when?'])->label(false); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="col-md-12">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    <div class="clearfix"></div>

    <br /><br />
    </div>