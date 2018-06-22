<?php

use app\models\Projects;
use app\models\TaskSearch;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model app\models\Categories */


$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$pid = base64_decode(Yii::$app->session->get('new'));
$expand = Yii::$app->session->get('expand');
Yii::$app->session->set('new', 0);
Yii::$app->session->set('expand', 0);
?>

<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('menu_buttons', ['model' => $model]) ?>

    <?php
    $expandCol = [
        'class' => '\kartik\grid\ExpandRowColumn',
        'value' => function ($model, $key, $index) use ($expand, $pid) {
            if ($key == $pid && $expand) {
                return GridView::ROW_EXPANDED;
            }
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index) {
            $sm = new TaskSearch();
            $dp = $sm->search(Yii::$app->request->queryParams, $model->id);

            return Yii::$app->controller->renderPartial('tasks_gridview', [
                'searchModel' => $sm,
                'dataProvider' => $dp,
                'model' => Projects::findOne($model->id),
            ]);
        },
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn',
                'header' => Html::checkBox('selection_all', false, [
                    'id' => 'allFocus',
                    'onchange' => 'saveAllFocus(this)',
                    'class' => 'focus-checkbox'
                ]),
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return [
                        'id' => $model->id,
                        'checked' => $model->is_focus != 0 ? 'checked' : '',
                        'onchange' => 'saveFocus(this.id)',
                        'class' => 'focus-checkbox'
                    ];
                }
            ],
            $expandCol,
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'title',
                'editableOptions' => [
                    'header' => 'Title',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'editableValueOptions' => [
                        'class' => 'kv-editable-value kv-editable-link content-align'
                    ]
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'assigned_to',
                'editableOptions' => [
                    'header' => 'Assigned To',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'phase',
                'editableOptions' => [
                    'header' => 'Phase',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'percentage_complete',
                'editableOptions' => [
                    'header' => 'Percentage Complete',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'editableOptions' => [
                    'header' => 'Status',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',

                'attribute' => 'start_date',
                'format' => ['date', 'php:m/d/Y'],
                'editableOptions' => function ($model, $key, $index) {
                    return [
                        'header' => '&nbsp;',
                        'size' => 'md',
                        'inputType' => Editable::INPUT_WIDGET,
                        'pluginEvents' => [],
                        'widgetClass' => 'kartik\datecontrol\DateControl',
                        'options' => [
                            'displayFormat' => 'php:m/d/Y',
                            'saveFormat' => 'php:Y-m-d',
                            'type' => DateControl::FORMAT_DATE,
                            'ajaxConversion' => true,
                            'options' => [
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]
                        ]
                    ];
                },
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'end_date',
                'format' => ['date', 'php:m/d/Y'],
                'editableOptions' => function ($model, $key, $index) {
                    return [
                        'header' => '&nbsp;',
                        'size' => 'md',
                        'inputType' => Editable::INPUT_WIDGET,
                        'pluginEvents' => [],
                        'widgetClass' => 'kartik\datecontrol\DateControl',
                        'options' => [
                            'displayFormat' => 'php:m/d/Y',
                            'saveFormat' => 'php:Y-m-d',
                            'type' => DateControl::FORMAT_DATE,
                            'options' => [
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]
                        ]
                    ];
                },
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'custom_field',
                'editableOptions' => [
                    'header' => 'Quick Note',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'editableValueOptions' => [
                        'class' => 'kv-editable-value kv-editable-link content-align'
                    ]
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'priority',
                'editableOptions' => [
                    'header' => 'Priority',
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => ['High' => 'High', 'Medium' => 'Medium', 'Low' => 'Low']
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'stake_holder',
                'editableOptions' => [
                    'header' => 'Stakeholder',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'sort_order',
                'editableOptions' => [
                    'header' => 'Sort Order',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'is_hide',
                'editableOptions' => [
                    'header' => 'Hide',
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => ['Yes' => 'Yes', 'No' => 'No']
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'min-width:80px'],
                'template' => '<span style="margin-left: 3px">{message}</span>  
                               <span style="margin-left: 2px">{givestars}</span>  
                               <span style="margin-left: 2px">{updates}</span>  
                               <span style="margin-left: 3px">{moreinfo}</span>  
                               <span style="margin-left: 5px">{custom}</span>  
                               <span style="margin-left: 3px">{delete}</span>
                               ',
                'buttons' => [
                    'message' => function ($url, $model) {
                        $modal_type = 'view-discussions' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'modal_body/discussions.php']);
                        return '<a href="#' . $modal_type . '" data-toggle="modal" data-id="' . $model->id . '" title="View Discussions" >
                                    <span class="fa fa-comments"></span>
                                </a>';
                    },
                    'givestars' => function ($url, $model) {
                        $modal_type = 'view-givestars' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'modal_body/ratings.php']);
                        return '<a href="#' . $modal_type . '" data-toggle="modal" data-id="' . $model->id . '" title="View Ratings" >
                                    <span class="fa fa-star"></span>
                                </a>';
                    },
                    'updates' => function ($url, $model) {
                        $modal_type = 'view-updates' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'modal_body/updates.php']);
                        return '<a href="' . Url::to(['project/updates', 'id' => base64_encode($model->id)]) . '" title="View Updates" >
                                    <span class="fa fa-bars"></span>
                                </a>';
                    },
                    'moreinfo' => function ($url, $model) {
                        $modal_type = 'view-info' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'modal_body/moreinfo.php']);
                        return '<a href="#' . $modal_type . '" data-toggle="modal" data-id="' . $model->id . '" title="More Info" >
                                    <span class="fa fa-info-circle"></span>
                                </a>';
                    },
                    'custom' => function ($url, $model) {
                        $modal_type = 'view-custom' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'modal_body/custom.php']);
                        return '<a href="#' . $modal_type . '" data-toggle="modal" data-id="' . $model->id . '" title="Custom Field" >
                                    <span class="fa fa-plus-circle"></span>
                                </a>';
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="fa fa-trash"></span>', ['project/delete', 'id' => base64_encode($model->id)], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Are you absolutely sure? You will lose all the information about this project with this action.',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
        'toolbar' => [
            [
                'content' =>
                    Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                        'type' => 'button',
                        'title' => 'Add Project',
                        'class' => 'btn btn-success',
                        'data-toggle' => 'modal',
                        'data-target' => '#add-project',

                    ]) . ' ' .
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['view', 'id' => base64_encode($model->id), 'due' => $due], [
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
            'options' => [
                'id' => 'all-view-pgrid',
            ]
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'before' => Html::a('<i class="fa fa-compress"></i>', [
                    'clean-view',
                    'id' => base64_encode($model->id),
                    'due' => $due
                ], [
                    'class' => 'btn btn-outline-success',
                    'style' => 'border : 1px solid',
                    'title' => 'Clean View'
                ]) . ' ' . Html::a('<i class="fa fa-expand"></i>', [
                    'full-view',
                    'id' => base64_encode($model->id),
                    'due' => $due
                ], [
                    'class' => 'btn btn-outline-success',
                    'style' => 'border : 1px solid',
                    'title' => 'Full View'
                ]),
        ],
    ]);
    ?>
</div>

<!-- Modal -->
<div id="add-project" class="modal fade" role="dialog" style="margin-top: 50px">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add a New Project</h4>
            </div>
            <div class="modal-body">
                <?php
                $pmodel = new Projects();
                $form = ActiveForm::begin(
                    [
                        'id' => 'form-profile123',
                        'action' => Yii::$app->urlManager->createUrl(["project/create"]),
                    ]
                ); ?>
                <div class="row">
                    <?= $form->field($pmodel, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
                    <?= $form->field($pmodel, 'category_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($pmodel, 'title')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($pmodel, 'assigned_to')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($pmodel, 'phase')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($pmodel, 'status')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($pmodel, 'start_date')->widget(
                                DatePicker::className(), [
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'mm/dd/yyyy'
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($pmodel, 'end_date')->widget(
                                DatePicker::className(), [
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'mm/dd/yyyy'
                                ]
                            ]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <?= $form->field($pmodel, 'more_info')->textarea(['rows' => 6]) ?>
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
