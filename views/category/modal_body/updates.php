<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 24/05/2017
 * Time: 02:59 PM
 */
use app\components\ConversionHelper;
use app\models\ProjectUpdates;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<div class="modal-dialog" style="width: 95%">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Updates</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <form id="update-form<?= $model->id ?>"
                      action="<?= Yii::$app->urlManager->createUrl(['update/new']) ?>" method="post">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                           value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                    <input type="hidden" value="<?= $model->id ?>" name="project"/>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="new-accomplishment<?= $model->id ?>" class="form-control"
                                       placeholder="Enter Accomplishment"
                                       name="accomplishment"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="new-concern<?= $model->id ?>" class="form-control"
                                       placeholder="Enter Concern"
                                       name="concern"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="new-decision<?= $model->id ?>" class="form-control"
                                       placeholder="Enter Decision"
                                       name="decision"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="new-followup<?= $model->id ?>" class="form-control"
                                       placeholder="Enter Follow Up"
                                       name="followup"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" id="new-assigned-to<?= $model->id ?>" class="form-control"
                                       placeholder="Enter Assigned To"
                                       name="assigned_to"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?=
                                DatePicker::widget([
                                    'id' => 'dd' . $model->id,
                                    'name' => 'due_date',
                                    'options' => ['placeholder' => 'Any Due Date?'],
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
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="new-followup2<?= $model->id ?>" class="form-control"
                                       placeholder="Enter Action Item"
                                       name="followup2"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" id="new-assigned-to2<?= $model->id ?>" class="form-control"
                                       placeholder="Enter Assigned To"
                                       name="assigned_to2"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?=
                                DatePicker::widget([
                                    'id' => 'dd2' . $model->id,
                                    'name' => 'due_date2',
                                    'options' => ['placeholder' => 'Any Due Date?'],
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
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="new-followup3<?= $model->id ?>" class="form-control"
                                       placeholder="Enter Follow Up"
                                       name="followup3"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" id="new-assigned-to3<?= $model->id ?>" class="form-control"
                                       placeholder="Enter Assigned To"
                                       name="assigned_to3"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?=
                                DatePicker::widget([
                                    'id' => 'dd3' . $model->id,
                                    'name' => 'due_date3',
                                    'options' => ['placeholder' => 'Any Due Date?'],
                                    'pluginOptions' => [
                                        'format' => 'mm/dd/yyyy',
                                        'autoclose' => true,
                                        'todayHighlight' => true
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" style="width: 100%" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="update-fields<?= $model->id ?>">
                    <div class="col-md-12">
                        <?php $i = uniqid();
                        $id = $model->id;
                        if (!empty($model->pupdates)) {
                            ?>
                            <hr style="margin-top: 0; margin-bottom: 2px !important;"/>
                            <center><h4>PREVIOUS UPDATES</h4></center>
                            <hr style="margin-top: 2px !important"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <select class="form-control" name="filter_assigned_to" id="filter_assigned_to<?=$id?>">
                                            <option value="">Filter By Assigned To</option>
                                            <?php
                                            foreach ($model->pupdates as $item) {
                                                if (!empty($item->update->assigned_to)) {
                                                    ?>
                                                    <option value="<?= $item->update->assigned_to ?>">
                                                        <?= $item->update->assigned_to ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" name="filter_is_close" id="filter_is_close<?=$id?>">
                                            <option value="">Filter by Status</option>
                                            <option value="0">Open</option>
                                            <option value="1">Closed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <?= DatePicker::widget([
                                            'id' => 'filter_due_date'. $id,
                                            'name' => 'filter_due_date'. $id,
                                            'options' => ['placeholder' => 'Filter By Due Date'],
                                            'pluginOptions' => [
                                                'format' => 'mm/dd/yyyy',
                                                'autoclose' => true,
                                                'todayHighlight' => true
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-1">
                                        <center>
                                            <button type="button" id="filter-search-button"
                                                    class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </center>
                                    </div>
                                </div>
                                <script>
                                    $('#filter-search-button').click(function () {
                                        var a = $("#filter_assigned_to<?= $id?>").val();
                                        var c = $("#filter_is_close<?= $id?>").val();
                                        var d = $("#filter_due_date<?= $id?>").val();
                                        var params = {id : <?=$model->id?>, assigned_to : a, is_close:c, due_date:d};
                                        var url = jQuery.param( params );
                                        $('#update-fields<?=$model->id?>').load("aucontent?"+url);
                                    });
                                </script>
                            </div>
                            <hr/>

                        <?php
                        $pupdates = ProjectUpdates::find()
                            ->joinWith(['update'])
                            ->select(['*'])
                            ->where(['user_id' => $model->user_id, 'project_id' => $model->id])
                            ->groupBy('updates.id')
                            ->orderBy([
                                'updates.is_close' => SORT_ASC,
                                'project_updates.id' => SORT_DESC
                            ])
                            ->all();
                        foreach ($pupdates as $pupdate) {
                        if (!empty($pupdate->update)) {
                        $uform = ActiveForm::begin(
                            [
                                'id' => 'update-edit' . $i,
                                'action' => Yii::$app->urlManager->createUrl(["update/edit", 'id' => base64_encode($pupdate->update->id)]),
                            ]
                        );
                        ?>
                            <div class="row" id="update-record-<?= $pupdate->id ?>">
                                <div class="col-md-12">
                                    <div class="col-md-9" style="width: 77%">
                                        <div class="col-md-2" style="width: 11%">
                                            <b style="font-size: 14px"><?= $pupdate->update->update_type ?></b>
                                        </div>
                                        <div class="col-md-10" style="width: 88.333333%">
                                            <?= $uform->field($pupdate->update, 'update_text')->textInput(['id' => 'update_text' . $pupdate->id, 'title' => $pupdate->update->update_text, 'placeholder' => 'Enter ' . $pupdate->update->update_type])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width: 14.666667%">
                                        <center>
                                            <?php if (!empty($pupdate->update->due_date)) { ?>
                                                <span class="date-day">
                                                    <b style="color: red">Due By : </b>
                                                    <b><?= ConversionHelper::getDate($pupdate->update->due_date) ?></b>
                                                </span>
                                                <br/>
                                            <?php } ?>
                                            <div style="padding-top: 7px;">
                                                <p>
                                                    <b style="color: gold">Is Closed?</b>
                                                    <?php if ($pupdate->update->is_close == 0) { ?>
                                                        <input class="style-checkbox" name="is_close"
                                                               type="checkbox"
                                                               id="test<?= $i ?>"/>
                                                        <label for="test<?= $i ?>">&nbsp;</label>
                                                    <?php } else { ?>
                                                        <input class="style-checkbox" name="is_close"
                                                               type="checkbox"
                                                               id="test<?= $i ?>"
                                                               checked/>
                                                        <label for="test<?= $i ?>">&nbsp;</label>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                        </center>
                                    </div>
                                    <div class="col-md-1">
                                        <center>
                                            <button type="submit" id="update-button<?= $pupdate->id ?>"
                                                    class="btn btn-success">
                                                <i class="fa fa-save"></i>
                                            </button>
                                        </center>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-9" style="width: 77%">
                                        <div class="col-md-2" style="width: 11%">
                                            <span class="date-day">
                                                <b><?= ConversionHelper::getDate($pupdate->update->date) ?></b><br/>
                                                <b><?= $pupdate->user->username ?></b>
                                            </span>
                                        </div>
                                        <div class="col-md-10" style="width: 88.333333%">
                                            <?= $uform->field($pupdate->update, 'response')->textarea(['id' => 'response' . $pupdate->id, 'title' => $pupdate->update->response, 'placeholder' => 'Enter Response', 'rows' => 3, 'style' => 'resize: vertical;'])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width: 14.666667%; padding: 0">
                                        <center>
                                            <b class="date-day" style="color: dodgerblue">Assigned To </b>
                                            <br/>
                                            <?= $uform->field($pupdate->update, 'assigned_to')->textInput(['id' => 'assigned_to' . $pupdate->id, 'style' => 'margin-top:10px', 'title' => $pupdate->update->assigned_to, 'placeholder' => 'Enter Assigned To'])->label(false) ?>
                                        </center>
                                    </div>
                                    <div class="col-md-1">
                                        <center>
                                            <button id="delete-update<?= $pupdate->id ?>"
                                                    type="button"
                                                    class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </center>
                                        <script>
                                            $("#delete-update<?=$pupdate->id?>").click(function () {
                                                var result = confirm("Are you sure you want to Delete this?");
                                                if (result) {
                                                    $.ajax({
                                                        url: "<?=Url::to(['update/delete', 'id' => base64_encode($pupdate->id)])?>",
                                                        success: function (result) {
                                                            $('#update-record-<?= $pupdate->id ?>').hide();
                                                            $('#update-record-br-<?= $pupdate->id ?>').hide();
                                                        }
                                                    });
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        <hr style="margin-top: 0" id="update-record-br-<?= $pupdate->id ?>"/>
                        <?php
                        ActiveForm::end();
                        ?>
                            <script>
                                $('#update-edit<?=$i?>').submit(function () {
                                    var form = $(this);
                                    if (form.find('.has-error').length) {
                                        return false;
                                    }
                                    $.ajax({
                                        url: form.attr('action'),
                                        type: 'post',
                                        data: form.serialize(),
                                        success: function (data) {
                                            $('#update-edit<?=$i?>').hide().fadeIn('fast');
                                        },
                                        error: function () {
                                            alert("Something went wrong");
                                        }
                                    });
                                    return false;
                                });
                            </script>
                            <?php
                            $i++;
                        }
                        }
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
        jQuery(function ($) {
        var inputs = $(
            'input[name=accomplishment],' +
            'input[name=concern],' +
            'input[name=decision],' +
            'input[name=followup],' +
            'input[name=followup2],' +
            'input[name=followup3]'
        );
        inputs.on('input', function () {
            // Set the required property of the other input to false if this input is not empty.
            inputs.not(this).prop('required', !$(this).val().length);
        });
    });
JS;
$this->registerJs($script);
?>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('#update-form<?=$model->id?>').submit(function () {
        var form = $(this);
        if (form.find('.has-error').length) {
            return false;
        }
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function (data) {
                $('#update-fields<?=$model->id?>').load("aucontent?id=<?=$model->id?>");
                $('#new-accomplishment<?=$model->id?>').val('');
                $('#new-decision<?=$model->id?>').val('');
                $('#new-concern<?=$model->id?>').val('');
                $('#new-followup<?=$model->id?>').val('');
                $('#new-followup2<?=$model->id?>').val('');
                $('#new-followup3<?=$model->id?>').val('');
                $('#dd<?=$model->id?>').val('');
                $('#dd2<?=$model->id?>').val('');
                $('#dd3<?=$model->id?>').val('');
            },
            error: function () {
                alert("Something went wrong");
            }
        });

        return false;
    });
</script>