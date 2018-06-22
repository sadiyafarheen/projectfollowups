<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 24/05/2017
 * Time: 02:59 PM
 */
use app\components\ConversionHelper;

?>

<div class="modal-dialog" style="width: 95%">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Custom Fields</h4>
        </div>
        <div class="modal-body">
            <center>
                <div class="row">
                    <div id="custom-fields<?= $model->id ?>">
                        <div class="col-md-12">
                            <?php
                            $i = rand() . time();
                            if (!empty($model->cfields)) {
                                ?>
                                <div class="row" id="custom-record">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <b style="font-size: 14px">Field Label</b>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <b style="font-size: 14px">Field Value</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <b style="font-size: 14px">Checkbox</b>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <b style="font-size: 14px">Dashboard</b>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <b style="font-size: 14px">Status</b>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <b style="font-size: 14px">Created Date</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <?php
                                foreach ($model->cfields as $cfield) {
                                    ?>
                                    <div class="row" id="custom-record-<?= $cfield->id ?>">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <?= $cfield->field_label ?>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <?= $cfield->field_value ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                            <p>
                                                                <?php if ($cfield->checkbox) { ?>
                                                                    Checked
                                                                <?php } else { ?>
                                                                    Unchecked
                                                                <?php } ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>
                                                                <?php if ($cfield->dashboard) { ?>
                                                                    Yes
                                                                <?php } else { ?>
                                                                    No
                                                                <?php } ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>
                                                                <?php if ($cfield->is_active) { ?>
                                                                    Active
                                                                <?php } else { ?>
                                                                    Inactive
                                                                <?php } ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="date-day">
                                                                <b><?= $cfield->user->username ?></b>
                                                                <b><?= ConversionHelper::getDate($cfield->date) ?></b>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <?php
                                }
                            } else {
                                echo 'There are currently no Custom Fields for this Project';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </center>
        </div>
        <div class="modal-footer" style="border-top: none">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>