<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 24/05/2017
 * Time: 02:59 PM
 */
use app\components\ConversionHelper;
use app\models\ProjectUpdates;

?>

<div class="modal-dialog" style="width: 90%">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Updates</h4>
        </div>
        <div class="modal-body">
            <center>
                <div class="row">
                    <div id="update-fields<?= $model->id ?>">
                        <div class="col-md-12">
                            <?php
                            $i = rand() . time();
                            $pupdates = ProjectUpdates::find()->joinWith(['update'])
                                ->select(['*'])
                                ->where(['project_id' => $model->id])
                                ->groupBy('updates.id')
                                ->orderBy([
                                    'updates.is_close' => SORT_ASC,
                                    'project_updates.id' => SORT_DESC
                                ])
                                ->all();
                            if (!empty($model->pupdates)) {
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-7">
                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <b style="font-size: 14px">Update Type</b>
                                                </div>
                                                <div class="col-md-5">
                                                    <b style="font-size: 14px">Update Text</b>
                                                </div>
                                                <div class="col-md-5">
                                                    <b style="font-size: 14px">Response</b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <b style="font-size: 14px">Status</b>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <b style="font-size: 14px">Created Date</b>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <b style="font-size: 14px">Due Date</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <?php
                                foreach ($pupdates as $pupdate) {
                                    if (!empty($pupdate->update)) { ?>
                                        <div class="row" id="update-record-<?= $pupdate->id ?>">
                                            <div class="col-md-12">
                                                <div class="col-md-7">
                                                    <div class="col-md-12">
                                                        <div class="col-md-2">
                                                            <?= $pupdate->update->update_type ?>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <?= $pupdate->update->update_text ?>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <?= !empty($pupdate->update->response) ? $pupdate->update->response : "N/A" ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-4">
                                                                <p>
                                                                    <?php if ($pupdate->update->is_close == 0) { ?>
                                                                        Inactive
                                                                    <?php } else { ?>
                                                                        Active
                                                                    <?php } ?>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="date-day"><b><?= $pupdate->user->username ?></b> <b><?= ConversionHelper::getDate($pupdate->update->date) ?></b></span><br/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="date-day">
                                                                    <b><?= !empty($pupdate->update->due_date) ? ConversionHelper::getDate($pupdate->update->due_date) : "N/A" ?></b>
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
                                }
                            } else {
                                echo 'There are currently no Updates for this Project';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </center>
            <div class="modal-footer" style="border-top: none">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>