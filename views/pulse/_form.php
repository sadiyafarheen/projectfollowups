<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pulse */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="row">
        <div class="content1">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            Great<br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Great">
                        </div>
                        <div class="col-md-2">
                            Fabulous<br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Fabulous">
                        </div>
                        <div class="col-md-2">
                            Positive<br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Positive">
                        </div>
                        <div class="col-md-2">
                            Determined<br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Determined">
                        </div>
                        <div class="col-md-2">
                            Overwhelmed<br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Overwhelmed">
                        </div>
                        <div class="col-md-2">
                            Confused<br /><input type="checkbox" name="Pulse[how_you_feel][]" value="Confused">
                        </div>
                    </div>
                    <?php //echo $form->field($model, 'how_you_feel[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>



<div class="pulse-form">

    

    <?php $form->field($model, 'user_id')->textInput() ?>

    

    <?= $form->field($model, 'about_project_health')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'any_notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'action_taken')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_agenda')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    

</div>
