<?php
use app\components\ConversionHelper;
use app\models\Projects;
use app\models\Ratings;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<!-- Modal -->
<div id="<?= $modal_type?>" class="modal fade" role="dialog" style="margin-top: 50px">
    <?= $this->render($file, ['model' => $model]); ?>
</div>

<script>
    $(document).ready(function () {
        $('#<?= $modal_type?>').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
        });
    });
</script>