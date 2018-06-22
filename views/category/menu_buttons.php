<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 03/06/2017
 * Time: 11:29 AM
 */
use yii\helpers\Url;
?>

<p>
    <a class="btn btn-primary" href="<?= Url::to(['category/clean-view', 'id' => base64_encode($model->id), 'due' => 'focus']) ?>">Focus List</a>
    <a class="btn btn-primary" href="<?= Url::to(['category/clean-view', 'id' => base64_encode($model->id), 'due' => 'today']) ?>">Due Today</a>
    <a class="btn btn-primary" href="<?= Url::to(['category/clean-view', 'id' => base64_encode($model->id), 'due' => 'tomorrow']) ?>">Due Tomorrow</a>
    <a class="btn btn-primary" href="<?= Url::to(['category/clean-view', 'id' => base64_encode($model->id), 'due' => 'week']) ?>">Due NextWeek</a>
    <a class="btn btn-primary" href="<?= Url::to(['category/clean-view', 'id' => base64_encode($model->id), 'due' => 'over']) ?>">Over Due</a>
    <a class="btn btn-primary" href="<?= Url::to(['category/view', 'id' => base64_encode($model->id)]) ?>">All Projects</a>
    <a class="btn btn-primary" href="<?= Url::to(['category/clean-view', 'id' => base64_encode($model->id)]) ?>">Clean View</a>
    <a class="btn btn-primary" href="<?= Url::to(['category/notes', 'id' => base64_encode($model->id)]) ?>">Stand-Alone Notes</a>
    <a href="#permissions" data-toggle="modal" data-id="<?=rand()?>" class="btn btn-primary">Share Projects in this Topic</a>
    <!-- Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])  -->
</p>

<?php
$script = <<< JS
    if(window.location.hash.substring(1) == "permissions") {
    $('#permissions').modal('show');
}
JS;
$this->registerJs($script);
?>

<?= $this->render('_modals', ['model' => $model, 'modal_type' => 'permissions', 'file' => 'modal_body/permissions.php']);?>