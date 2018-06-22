<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 24/05/2017
 * Time: 02:59 PM
 */
use app\components\ConversionHelper;
use app\models\CategoryUpdates;
use app\models\ProjectUpdates;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<div class="modal-dialog" style="width: 100%">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" style="padding-left: 15px; color: #2e6da4">
                Enter Updates for <?= $model->name ?> <!--- Add a New Update&nbsp;-->
                <span class="header1">
                    <button id="icon1" class="btn btn-primary accordion-button-right">
                        <i class="fa fa-minus"></i>
                    </button>
                </span>
                <a href="<?= Url::to(['category/clean-view', 'id' => base64_encode($model->id)]) ?>" title="Go Back"
                   style="float: right; margin-right: 5px"
                   class="btn btn-success">
                    <i class="fa fa-reply"></i>
                </a>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="content1">
                    <form id="update-form<?= $model->id ?>"
                          action="<?= Yii::$app->urlManager->createUrl(['update/category-new']) ?>" method="post">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                               value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                        <input type="hidden" value="<?= $model->id ?>" name="category"/>
                        <div class="col-md-12">
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
                        <!--<div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="new-concern<?= $model->id ?>" class="form-control"
                                           placeholder="Enter Concern"
                                           name="concern"/>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-12">
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
                        <!--<div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="new-followup<?= $model->id ?>" class="form-control"
                                           placeholder="Enter Action Item"
                                           name="followup"/>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-12">
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
                                           placeholder="Whom to Follow Up with"
                                           name="assigned_to"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?=
                                    DatePicker::widget([
                                        'id' => 'dd' . $model->id,
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
                        <!--<div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea  id="new-notes<?= $model->id ?>" class="form-control"
                                           placeholder="Enter Notes"
                                           name="notes"></textarea>
                                </div>
                            </div>
                        </div>-->
                        <!--<div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="new-followup2<? /*= $model->id */ ?>" class="form-control"
                                           placeholder="Enter Follow Up"
                                           name="followup2"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" id="new-assigned-to2<? /*= $model->id */ ?>" class="form-control"
                                           placeholder="Enter Follow up with"
                                           name="assigned_to2"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <? /*=
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
                                    */ ?>
                                </div>
                            </div>
                        </div>-->
                        <!--<div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="new-followup3<? /*= $model->id */ ?>" class="form-control"
                                           placeholder="Enter Follow Up"
                                           name="followup3"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" id="new-assigned-to3<? /*= $model->id */ ?>" class="form-control"
                                           placeholder="Enter Follow up with"
                                           name="assigned_to3"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <? /*=
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
                                    */ ?>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button id="button1" type="submit" class="btn btn-primary" value="Submit and close page">Submit and close page
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" value="Submit and add
                                        more info">Submit and add
                                        more info
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div id="update-fields<?= $model->id ?>">
                    <?php $i = uniqid(); ?>
                    <div class="col-md-12">
                        <?php
                        $id = $model->id;
                        if (!empty($model->cupdates)) {
                            ?>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="col-md-8" style="background: #e0e0e0; line-height: 45px;">
                                            <span class="previous-heading" style="color: #2e6da4">Previous Updates</span>
                                        </div>
                                        <div class="col-md-4" style="background: #e0e0e0; padding:6px 0 6px 20px">
                                            <span class="header2">
                                                <button id="icon2" class="btn btn-primary accordion-button-right">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                            <button type="button" title="Clear Filters" id="filter-clear-button"
                                                    class="btn btn-warning accordion-button-right-left">
                                                <i class="fa fa-ban"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-1" style="padding:20px 0 0 20px">
                                        Filter By:
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0 0 10px">
                                        <select class="form-control" name="filter_assigned_to" id="filter_assigned_to<?= $id ?>">
                                            <option value="">Note Type
                                            </option>
                                            <?php
                                            foreach ($model->cupdates as $item) {
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
                                    <div class="col-md-3" style="padding:10px 0 0 10px">
                                        <input type="text" class="form-control" name="keyword<?= $id ?>" placeholder="Keyword in description or response">
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0 0 10px">
                                        <?php echo DatePicker::widget([
                                            'id' => 'filter_due_date' . $i,
                                            'name' => 'filter_due_date' . $i,
                                            'options' => ['placeholder' => 'Due Date'],
                                            'pluginOptions' => [
                                                'format' => 'mm/dd/yyyy',
                                                'autoclose' => true,
                                                'todayHighlight' => true
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-1" style="padding:10px 0 0 10px">
                                        <select class="form-control" name="filter_is_close" id="filter_is_close<?= $id ?>">
                                            <option value="">Status</option>
                                            <option value="0">Open</option>
                                            <option value="1">Closed</option>
                                            <option value="2">Critical</option>
                                            <option value="3">Request more info</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0 0 10px">
                                        <select class="form-control" name="filter_assigned_to" id="filter_assigned_to<?= $id ?>">
                                            <option value="">Assigned To
                                            </option>
                                            <?php
                                            foreach ($model->cupdates as $item) {
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
                                    <div class="col-md-1" style="padding:10px 0 0 0px">
                                        <center>
                                            <button type="button" id="filter-search-button"
                                                    class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </center>
                                    </div>
                                    <script>
                                        $('#filter-search-button').click(function () {
                                            var a = $("#filter_assigned_to<?= $id?>").val();
                                            var c = $("#filter_is_close<?= $id?>").val();
                                            var d = $("#filter_due_date<?= $i?>").val();
                                            var t = $("#filter_due_by<?= $id?>").val();
                                            var params = {
                                                id: <?=$model->id?>,
                                                assigned_to: a,
                                                is_close: c,
                                                due_date: d,
                                                due: t
                                            };
                                            var url = jQuery.param(params);
                                            $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                        });
                                        $('#filter-clear-button').click(function () {
                                            var params = {id: <?=$model->id?>};
                                            var url = jQuery.param(params);
                                            $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                        });
                                    </script>
                                    <!--<div class="col-md-9">
                                        <div class="col-md-9" style="padding:10px">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <select class="form-control" name="filter_assigned_to"
                                                                        id="filter_assigned_to<?= $id ?>">
                                                                    <option value="">Filter By Whom to Follow Up with
                                                                    </option>
                                                                    <?php
                                                                    foreach ($model->cupdates as $item) {
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
                                                            <div class="col-md-3">
                                                                <select class="form-control" name="filter_is_close"
                                                                        id="filter_is_close<?= $id ?>">
                                                                    <option value="">Filter by Status</option>
                                                                    <option value="0">Open</option>
                                                                    <option value="1">Closed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding:10px">
                                            <?php /* DatePicker::widget([
                                            'id' => 'filter_due_date' . $i,
                                            'name' => 'filter_due_date' . $i,
                                            'options' => ['placeholder' => 'Filter By Due Date'],
                                            'pluginOptions' => [
                                                'format' => 'mm/dd/yyyy',
                                                'autoclose' => true,
                                                'todayHighlight' => true
                                            ],
                                        ]);
                                        */ ?>
                                            <select class="form-control" name="filter_due_by"
                                                    id="filter_due_by<?= $id ?>">
                                                <option value="">Any Due Date</option>
                                                <option value="today">Due Today</option>
                                                <option value="tomorrow">Due Tomorrow</option>
                                                <option value="week">Next Week</option>
                                                <option value="over">Over Due</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1" style="padding:10px">
                                            <center>
                                                <button type="button" id="filter-search-button"
                                                        class="btn btn-info">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </center>
                                        </div>
                                        <script>
                                            $('#filter-search-button').click(function () {
                                                var a = $("#filter_assigned_to<?= $id?>").val();
                                                var c = $("#filter_is_close<?= $id?>").val();
                                                var d = $("#filter_due_date<?= $i?>").val();
                                                var t = $("#filter_due_by<?= $id?>").val();
                                                var params = {
                                                    id: <?=$model->id?>,
                                                    assigned_to: a,
                                                    is_close: c,
                                                    due_date: d,
                                                    due: t
                                                };
                                                var url = jQuery.param(params);
                                                $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                            });
                                            $('#filter-clear-button').click(function () {
                                                var params = {id: <?=$model->id?>};
                                                var url = jQuery.param(params);
                                                $('#update-fields<?=$model->id?>').load("../category/aucontent?" + url);
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2" style="padding:10px 0">
                                        Assigned To
                                    </div>-->
                                </div>
                            </div>
                            <hr/>
                            <div class="content2">
                            <div class="container" style="width: 99%; margin: 0 auto;">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                      <thead style="background: #e0e0e0">
                                        <tr>
                                          <th style="text-align: center;">Note Type</th>
                                          <th>Description</th>
                                          <th>Response</th>
                                          <th>Due By</th>
                                          <th>Status</th>
                                          <th>Assigned To</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $cupdates = CategoryUpdates::find()
                                            ->joinWith(['update'])
                                            ->select(['*'])
                                            ->where(['user_id' => $model->user_id, 'category_id' => $model->id])
                                            ->groupBy('updates.id')
                                            ->orderBy([
                                                'updates.is_close' => SORT_ASC,
                                                'category_updates.id' => SORT_DESC
                                            ])
                                            ->all();
                                        foreach ($cupdates as $cupdate) {
                                            if (!empty($cupdate->update)) {
                                                $uform = ActiveForm::begin(
                                                    [
                                                        'id' => 'update-edit' . $i,
                                                        'action' => Yii::$app->urlManager->createUrl(["update/edit", 'id' => base64_encode($cupdate->update->id)]),
                                                    ]
                                                );
                                                ?>
                                        <tr>
                                          <td style="text-align: center;"><span style="color: #2e6da4; font-weight: bold;"><?= $cupdate->update->update_type ?></span><br />
                                          <span style="font-size: 12px;"><?= ConversionHelper::getDate($cupdate->update->date) ?><br/><?= $cupdate->user->username ?></span></td>
                                          <td><?= $uform->field($cupdate->update, 'update_text')->textarea(['id' => 'update_text' . $cupdate->id, 'title' => $cupdate->update->update_text, 'placeholder' => 'Enter ' . $cupdate->update->update_type, 'rows' => 4, 'style' => 'resize: vertical;'])->label(false) ?></td>
                                          <td><?= $uform->field($cupdate->update, 'response')->textarea(['id' => 'response' . $cupdate->id, 'title' => $cupdate->update->response, 'placeholder' => 'Enter Response', 'rows' => 4, 'style' => 'resize: vertical;'])->label(false) ?></td>
                                          <td style="text-align: center; width: 16%"><?php if (!empty($cupdate->update->due_date)) { ?>
                                                            <span class="date-day" style=" color: #2e6da4">
                                                    <?php $due_date = ConversionHelper::getDate($cupdate->update->due_date) ?>
                                                    
                                                    <?php echo DatePicker::widget([
                                                        'id' => 'filter_due_date' . $cupdate->id,
                                                        'name' => 'filter_due_date' . $cupdate->id,
                                                        'value' => $due_date,
                                                        'options' => ['placeholder' => 'Due Date'],
                                                        'pluginOptions' => [
                                                            'format' => 'mm/dd/yyyy',
                                                            'autoclose' => true,
                                                            'todayHighlight' => true
                                                        ],
                                                    ]);
                                                    ?>
                                                </span>
                                                            <br/>
                                                        <?php } ?></td>
                                          <td style="font-weight: normal; width: 15%">
                                              <input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="0" /> <label style="font-weight: normal;" for="test<?= $i ?>">Close</label><br /><input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="1" /> <label style="font-weight: normal;" for="test<?= $i ?>">Open</label><br />
                                              <input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="2" /> <label style="font-weight: normal;" for="test<?= $i ?>">Critical</label><br /><input class="style-checkbox" name="is_close" type="radio" id="test<?= $i ?>" value="3" /> <label style="font-weight: normal;" for="test<?= $i ?>">Request more info</label>
                                          </td>
                                          <td style="text-align: center; width: 10%"><?= $uform->field($cupdate->update, 'assigned_to')->textInput(['id' => 'assigned_to' . $cupdate->id, 'style' => 'margin-top:10px', 'title' => $cupdate->update->assigned_to, 'placeholder' => 'Whom to Follow Up with'])->label(false) ?></td>
                                          <td style="text-align: center;">
                                                                <center>
                                                                <div>
                                                                <button type="submit" id="update-button<?= $cupdate->id ?>"
                                                                class="btn btn-success">
                                                            <i class="fa fa-save"></i>
                                                        </button>
                                                        </div>
                                                        <div style="padding-top: 10px">
                                                        <button id="delete-update<?= $cupdate->id ?>"
                                                                type="button"
                                                                class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        </div>
                                                        </center>
                                                        <script>
                                                        $("#delete-update<?=$cupdate->id?>").click(function () {
                                                            var result = confirm("Are you sure you want to Delete this?");
                                                            if (result) {
                                                                $.ajax({
                                                                    url: "<?=Url::to(['update/delete-category-update', 'id' => base64_encode($cupdate->id)])?>",
                                                                    success: function (result) {
                                                                        $('#update-record-<?= $cupdate->id ?>').hide();
                                                                        $('#update-record-br-<?= $cupdate->id ?>').hide();
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    </script>
                                            </td>
                                        </tr>
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
                                    ?>
                                      </tbody>
                                    </table>
                                  </div><!--end of .table-responsive-->
                                </div>
                              </div>
                            </div>
                                
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
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
                
                $('#update-fields<?=$model->id?>').load("acucontent?id=<?=$model->id?>");
                $('#new-accomplishment<?=$model->id?>').val('');
                $('#new-decision<?=$model->id?>').val('');
                $('#new-concern<?=$model->id?>').val('');
                $('#new-followup<?=$model->id?>').val('');
                $('#new-assigned-to<?=$model->id?>').val('');
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

    /*$(document).ready(function () {
     $header = $("header1");
     //getting the next element
     $content = $(".content1");
     //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
     $content.slideToggle(200, function () {
     //execute this after slideToggle is done
     //change text of header based on visibility of content div
     $header.html(function () {
     //change text based on condition
     return $content.is(":visible") ? '<button id="icon1" class="btn btn-success accordion-button-right"><i class="fa fa-plus"></i></button>' : '<button id="icon1" class="btn btn-primary"><i class="fa fa-minus"></i></button>';
     });
     });
     });*/


    $(".header1").click(function () {

        $header = $(this);
        //getting the next element
        $content = $(".content1");
        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        $content.slideToggle(200, function () {
            //execute this after slideToggle is done
            //change text of header based on visibility of content div
            $header.html(function () {
                //change text based on condition
                return $content.is(":visible") ? '<button id="icon1" class="btn btn-primary accordion-button-right"><i class="fa fa-minus"></i></button>' : '<button id="icon1" class="btn btn-primary accordion-button-right"><i class="fa fa-plus"></i></button>';
            });
        });

    });

    $(".header2").click(function () {

        $header = $(this);
        //getting the next element
        $content = $(".content2");
        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        $content.slideToggle(200, function () {
            //execute this after slideToggle is done
            //change text of header based on visibility of content div
            $header.html(function () {
                //change text based on condition
                return $content.is(":visible") ? '<button id="icon2" class="btn btn-primary accordion-button-right"><i class="fa fa-minus"></i></button>' : '<button id="icon2" class="btn btn-primary accordion-button-right"><i class="fa fa-plus"></i></button>';
            });
        });

    });
</script>