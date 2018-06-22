<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 24/05/2017
 * Time: 02:59 PM
 */
use app\components\ConversionHelper;
use app\models\CustomFields;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="modal-dialog" style="width: 95%">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Custom Fields</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <?php
                $cmodel = new CustomFields();
                $form = ActiveForm::begin(
                    [
                        'id' => 'custom-profile' . $model->id,
                        'action' => Url::to(["custom-field/new"]),
                    ]
                ); ?>
                <?= $form->field($cmodel, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
                <?= $form->field($cmodel, 'project_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?= $form->field($cmodel, 'field_label')->textInput(['id' => 'new-field-label' . $model->id, 'placeholder' => 'Enter Field Label'])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <?= $form->field($cmodel, 'field_value')->textInput(['id' => 'new-field-value' . $model->id, 'placeholder' => 'Enter Field Value'])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <?= Html::submitButton('<i class="fa fa-save"></i>', ['class' => 'btn btn-primary', 'style' => 'float:right']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <div id="custom-fields<?= $model->id ?>">
                    <div class="col-md-12">
                        <?php
                        $i = uniqid();
                        if (!empty($model->cfields)) {
                            ?>
                            <hr style="margin-top: 0"/>
                            <center><h4>PREVIOUS UPDATES</h4></center>
                            <hr/>
                            <?php
                            foreach ($model->cfields as $cfield) {
                                $uform = ActiveForm::begin(
                                    [
                                        'id' => 'custom-update' . $i,
                                        'action' => Url::to(["custom-field/edit", 'id' => base64_encode($cfield->id)]),
                                    ]
                                );
                                ?>
                                <div class="row" id="custom-record-<?= $cfield->id ?>">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <?= $uform->field($cfield, 'field_label')->textInput(['id' => 'field_label' . $cfield->id, 'placeholder' => 'Enter Field Label'])->label(false) ?>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <?= $uform->field($cfield, 'field_value')->textInput(['id' => 'field_value' . $cfield->id, 'placeholder' => 'Enter Field Value'])->label(false) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-1"
                                                         style="padding-right: 0; padding-top: 7px">
                                                        <p>
                                                            <?php if ($cfield->checkbox == 0) { ?>
                                                                <input class="style-checkbox" name="is_checkbox"
                                                                       type="checkbox"
                                                                       id="chekbox<?= $i ?>"/>
                                                                <label for="chekbox<?= $i ?>">&nbsp;</label>
                                                            <?php } else { ?>
                                                                <input class="style-checkbox" name="is_checkbox"
                                                                       type="checkbox"
                                                                       id="chekbox<?= $i ?>"
                                                                       checked/>
                                                                <label for="chekbox<?= $i ?>">&nbsp;</label>
                                                            <?php } ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <?= $uform->field($cfield, 'dashboard')->dropDownList(['0' => 'Dashboard?(No)', '1' => 'Dashboard?(Yes)'], ['id' => 'dashboard' . $cfield->id])->label(false) ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?= $uform->field($cfield, 'is_active')->dropDownList(['0' => 'Inactive', '1' => 'Active'], ['id' => 'is_active' . $cfield->id])->label(false) ?>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <center>
                                                            <button id="calendar-edit-custom<?= $cfield->id ?>"
                                                                    type="button"
                                                                    class="btn btn-warning">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </center>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <center>
                                                            <?= Html::submitButton('<i class="fa fa-save"></i>', ['class' => 'btn btn-success']) ?>
                                                        </center>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <center>
                                                            <span class="date-day"><b><?= $cfield->user->username ?></b> <b><?= ConversionHelper::getDate($cfield->date) ?></b></span>
                                                        </center>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <center>
                                                            <button id="delete-custom<?= $cfield->id ?>"
                                                                    type="button"
                                                                    class="btn btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </center>
                                                        <script>
                                                            $("#delete-custom<?=$cfield->id?>").click(function () {
                                                                var result = confirm("Are you sure you want to Delete this?");
                                                                if (result) {
                                                                    $.ajax({
                                                                        url: "<?=Url::to(['custom-field/delete', 'id' => base64_encode($cfield->id)])?>",
                                                                        success: function (result) {
                                                                            $('#custom-record-<?= $cfield->id ?>').hide().fadeOut('fast');
                                                                        }
                                                                    });
                                                                }
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                                <?php
                                $s = <<< JS
                            $('#custom-update{$i}').on('beforeSubmit', function(event, jqXHR, settings) {
                                var form = $(this);
                                if(form.find('.has-error').length) {
                                    return false;
                                }
                                $.ajax({
                                    url: form.attr('action'),
                                    type: 'post',
                                    data: form.serialize(),
                                    success: function(data) {
                                        $('#custom-update{$i}').hide().fadeIn('slow');
                                    },
                                    error: function () {
                                        alert("Something went wrong");
                                    }
                                });
                                return false;
                            });
JS;
                                $this->registerJs($s);
                                $i++;
                            }
                            ?>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>


<?php
$script = <<< JS
        $('#custom-profile{$model->id}').on('beforeSubmit', function(event, jqXHR, settings) {
            var form = $(this);
            if(form.find('.has-error').length) {
                return false;
            }

            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function(data) {
                    $('#custom-fields{$model->id}').load("accontent?id={$model->id}");
                    $('#new-field-label{$model->id}').val('');
                    $('#new-field-value{$model->id}').val('');
                },
                error: function () {
                    alert("Something went wrong");
                }
            });
            
            return false;
        });
JS;
$this->registerJs($script);
?>
