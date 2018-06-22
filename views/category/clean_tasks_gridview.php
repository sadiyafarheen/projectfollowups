<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 3/29/2017
 * Time: 1:48 PM
 */
use app\models\Tasks;
use kartik\date\DatePicker;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'title',
        'editableOptions' => function ($model, $key, $index) {
            return [
                'formOptions' => [
                    'id' => 'igl1_' . 'igl_' . $model->id,
                ],
                'options' => [
                    'id' => 'igl1_' . $index . '_' . $model->id,
                ]
            ];
        },
        'pageSummary' => true
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'assigned_to',
        'editableOptions' => function ($model, $key, $index) {
            return [
                'formOptions' => [
                    'id' => 'igl2_' . 'igl_' . $model->id,
                ],
                'options' => [
                    'id' => 'igl2_' . $index . '_' . $model->id,
                ]
            ];
        },
        'pageSummary' => true
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'more_info',
        'value' => function ($url, $model) {
            if (!empty($model->more_info)) {
                return $model->more_info;
            }
            return NULL;
        },
        'editableOptions' => function ($model, $key, $index) {
            return [
                'formOptions' => [
                    'id' => 'igl8_' . 'igl_' . $model->id,
                ],
                'options' => [
                    'id' => 'igl8_' . $index . '_' . $model->id,
                ],

            ];
        },
        'pageSummary' => true
    ],
    //'custom_field',
    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{delete}',
        'buttons' => [
            'delete' => function ($url, $model) {
                return Html::a('<span class="fa fa-trash"></span>', ['task/delete', 'id' => base64_encode($model->id), 'type' => 2], [
                    'class' => '',
                    'data' => [
                        'confirm' => 'Are you absolutely sure? You will lose all the information about this task with this action.',
                        'method' => 'post',
                    ],
                ]);
            },
        ],
    ],
]; ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'summary' => false,
    'toolbar' => [
        [
            'content' =>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                    'type' => 'button',
                    'title' => 'Add a Task',
                    'class' => 'btn btn-primary',
                    'data-toggle' => 'modal',
                    'data-target' => '#add-task-' . $model->id,

                ]) . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['clean-view', 'id' => base64_encode($model->category->id)], [
                    'class' => 'btn btn-default',
                    'title' => 'Reset Projects'
                ]),
        ],
    ],
    'toggleDataContainer' => ['class' => 'btn-group-sm'],
    'exportContainer' => ['class' => 'btn-group-sm'],
    'responsive' => true,
    'hover' => true,
    'resizableColumns' => true,
    'pjax' => true,
    'pjaxSettings' => [
        'neverTimeout' => true,
    ],
    'panel' => [
        'type' => GridView::TYPE_DEFAULT
    ],
]); ?>


<!-- Modal -->
<div id="add-task-<?= $model->id ?>" class="modal fade" role="dialog" style="margin-top: 50px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add a New Task</h4>
            </div>
            <div class="modal-body">
                <?php
                $tmodel = new Tasks();
                $form = ActiveForm::begin(
                    [
                        'id' => 'form-profile' . $model->id,
                        'action' => Yii::$app->urlManager->createUrl(["task/create"]),
                    ]
                ); ?>

                <div class="row">
                    <?= $form->field($tmodel, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

                    <?= $form->field($tmodel, 'project_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($tmodel, 'title')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($tmodel, 'assigned_to')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($tmodel, 'phase')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($tmodel, 'status')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($tmodel, 'start_date')->widget(
                                DatePicker::className(), [
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'mm/dd/yyyy'
                                ],
                                'options' => [
                                    'id' => 'dp1' . $model->id,
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($tmodel, 'end_date')->widget(
                                DatePicker::className(), [
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'mm/dd/yyyy'
                                ],
                                'options' => [
                                    'id' => 'dp2' . $model->id,
                                ]
                            ]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <?= $form->field($tmodel, 'more_info')->textarea(['rows' => 6]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="form-group">
                            <?= Html::submitButton('Add', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </center>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>