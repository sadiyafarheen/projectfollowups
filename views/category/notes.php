<?php

use app\models\Notes;
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model app\models\Categories */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('menu_buttons', ['model' => $model]) ?>

    <hr/>
    <center><h4>Take Notes</h4></center>
    <hr/>

    <?php
    $form = ActiveForm::begin(
        [
            'id' => 'notes-form',
            /*'action' => Url::to(['category/edit-notes', 'id' => base64_encode($notes_model->id)]),*/
        ]
    ); ?>
    <?= $form->field($notes_model, 'id')->hiddenInput(['id' => 'notes-id', 'value' => $notes_model->id])->label(false) ?>
    <?= $form->field($notes_model, 'user_id')->hiddenInput(['id' => 'notes-user-id', 'value' => Yii::$app->user->id])->label(false) ?>
    <?= $form->field($notes_model, 'category_id')->hiddenInput(['id' => 'notes-category-id', 'value' => $model->id])->label(false) ?>
    <?= $form->field($notes_model, 'text')->textarea(['id' => 'editor'])->label(false); ?>
    <!--<button type="submit" class="btn btn-success" style="width:100%;">Save</button>-->
    <?php ActiveForm::end() ?>
</div>

<?php
$script = <<< JS
        tinyMCE.init({
            selector : 'textarea',
            height : "480",
            plugins : [ 
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste wordcount",
            ],
            setup : function(editor) {
                    editor.on('init', function(e) {
                        editor.execCommand('mceFullScreen');
                    });
                },
            init_instance_callback : function (editor) {
                    editor.on('keypress', function () {
                        var id = $("#notes-id").val();
                        var user = $("#notes-user-id").val();
                        var cat = $("#notes-category-id").val();
                        $.ajax({
                            url: "http://projectfollowups.com/category/edit-notes",
                            data: {id: id, user: user, cat : cat, text: editor.getContent()},
                            /*success: function (data) {
                                alert(data);
                            },*/
                        });
                    });
                    editor.on('change', function () {
                        var id = $("#notes-id").val();
                        var user = $("#notes-user-id").val();
                        var cat = $("#notes-category-id").val();
                        $.ajax({
                            url: "http://projectfollowups.com/category/edit-notes",
                            data: {id: id, user: user, cat : cat, text: editor.getContent()},
                            /*success: function (data) {
                                alert(data);
                            },*/
                        });
                    });
                },
        });
JS;
$this->registerJs($script);
?>
