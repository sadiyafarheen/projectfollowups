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
            <h4 class="modal-title">
                Updates For <?= $model->name ?> - Add a New Update&nbsp;
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
                                           placeholder="Enter Action Item"
                                           name="followup"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" id="new-assigned-to<?= $model->id ?>" class="form-control"
                                           placeholder="Whom to Follow Up with"
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
                                    <input type="text" id="new-notes<?= $model->id ?>" class="form-control"
                                           placeholder="Enter Notes"
                                           name="notes"/>
                                </div>
                            </div>
                        </div>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" style="width: 100%" class="btn btn-primary">Submit and add
                                        more notes
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                    <span class="previous-heading">
                                        Previous Updates
                                    </span>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="col-md-9">
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
                                        <div class="col-md-2">
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
                                        <div class="col-md-1">
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
                                    <div class="col-md-2">
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
                            <div class="content2">
                                <hr/>

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
                                        <div class="row" id="update-record-<?= $cupdate->id ?>">
                                            <div class="col-md-12">
                                                <div class="col-md-9" style="width: 77%">
                                                    <div class="col-md-2" style="width: 13%">
                                                        <b style="font-size: 14px"><?= $cupdate->update->update_type ?></b>
                                                    </div>
                                                    <div class="col-md-10" style="width: 86.333333%">
                                                        <?= $uform->field($cupdate->update, 'update_text')->textInput(['id' => 'update_text' . $cupdate->id, 'title' => $cupdate->update->update_text, 'placeholder' => 'Enter ' . $cupdate->update->update_type])->label(false) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="width: 14.666667%">
                                                    <center>
                                                        <?php if (!empty($cupdate->update->due_date)) { ?>
                                                            <span class="date-day">
                                                    <b style="color: red">Due By : </b>
                                                    <b><?= ConversionHelper::getDate($cupdate->update->due_date) ?></b>
                                                </span>
                                                            <br/>
                                                        <?php } ?>
                                                        <div style="padding-top: 7px;">
                                                            <p>
                                                                <?php if ($cupdate->update->is_close == 0) { ?>
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
                                                        <button type="submit" id="update-button<?= $cupdate->id ?>"
                                                                class="btn btn-success">
                                                            <i class="fa fa-save"></i>
                                                        </button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-9" style="width: 77%">
                                                    <div class="col-md-2" style="width: 13%">
                                                    <span class="date-day">
                                                        <b><?= ConversionHelper::getDate($cupdate->update->date) ?></b><br/>
                                                        <b><?= $cupdate->user->username ?></b>
                                                    </span>
                                                    </div>
                                                    <div class="col-md-10" style="width: 86.333333%">
                                                        <?= $uform->field($cupdate->update, 'response')->textarea(['id' => 'response' . $cupdate->id, 'title' => $cupdate->update->response, 'placeholder' => 'Enter Response', 'rows' => 3, 'style' => 'resize: vertical;'])->label(false) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="width: 14.666667%; padding: 0">
                                                    <center>
                                                        <b class="date-day" style="color: dodgerblue">Whom to Follow Up
                                                            with</b>
                                                        <br/>
                                                        <?= $uform->field($cupdate->update, 'assigned_to')->textInput(['id' => 'assigned_to' . $cupdate->id, 'style' => 'margin-top:10px', 'title' => $cupdate->update->assigned_to, 'placeholder' => 'Whom to Follow Up with'])->label(false) ?>
                                                    </center>
                                                </div>
                                                <div class="col-md-1">
                                                    <center>
                                                        <button id="delete-update<?= $cupdate->id ?>"
                                                                type="button"
                                                                class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
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
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0" id="update-record-br-<?= $cupdate->id ?>"/>
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