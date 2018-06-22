<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 22/05/2017
 * Time: 03:04 AM
 */
use app\components\ConversionHelper;
use app\models\Discussions;
use yii\bootstrap\ActiveForm;

?>

    <!-- Discussions -->
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Discussions</h4>
            </div>
            <center>
                <div class="modal-body">
                    <div class="row">
                        <div id="discussion-fields<?= $model->id ?>">
                            <?php
                            if (!empty($model->discussions)) {
                                foreach ($model->discussions as $discussion) {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <b><?= $discussion->user->username ?></b>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?= $discussion->text ?></p>
                                        </div>
                                        <div class="col-md-3">
                                    <span class="date-day"><?= ConversionHelper::getTime($discussion->time) ?>
                                        , <?= ConversionHelper::getDate($discussion->date) ?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "There are currently no Discussions for this Project";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </center>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

<?php
$script = <<< JS
        $('#discussion-new{$model->id}').on('beforeSubmit', function(event, jqXHR, settings) {
            var form = $(this);
            if(form.find('.has-error').length) {
                return false;
            }

            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function(data) {
                    $('#discussion-fields{$model->id}').load(location.href + " #discussion-fields{$model->id}");
                    $('#discussion-content{$model->id}').val('');
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