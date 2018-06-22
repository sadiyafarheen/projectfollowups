<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 22/05/2017
 * Time: 03:04 AM
 */
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\ActiveForm;

?>

<!-- Discussions -->
<div class="modal-dialog" style="width: 60%;">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">More Information</h4>
        </div>
        <center>
            <div class="modal-body">
                <div class="row">
                    <?php
                    $form = ActiveForm::begin(
                        [
                            'action' => Yii::$app->urlManager->createUrl(["project/save-info", 'id' => base64_encode($model->id)]),
                        ]
                    ); ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'more_info')->widget(TinyMce::className(), [
                                        'options' => ['id' => 'moreinfo' . $model->id, 'rows' => 20],
                                        'language' => 'en',
                                        'clientOptions' => [
                                            'plugins' => [
                                                "advlist autolink lists link charmap print preview anchor",
                                                "searchreplace visualblocks code fullscreen",
                                                "insertdatetime media table contextmenu paste"
                                            ],
                                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                                        ]
                                    ])->label(false); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary form-control"><i
                                                class="fa fa-download"> Save</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </center>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>