<?php

use app\models\Projects;
use app\models\ProjectUpdatesSearch;
use app\models\TaskSearch;
use app\models\Updates;
use app\models\UpdatesSearch;
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


$this->title = "Update Reports";

$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$pid = base64_decode(Yii::$app->session->get('new'));
$expand = Yii::$app->session->get('expand');
Yii::$app->session->set('new', 0);
Yii::$app->session->set('expand', 0);
?>

<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            $sm = new UpdatesSearch();
            $dp = $sm->search(Yii::$app->request->queryParams, $model->id);

            return Yii::$app->controller->renderPartial('update_reports_gridview', [
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
                    'id'=>'allFocus',
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
                'attribute' => 'rating',
                'editableOptions' => [
                    'header' => 'Custom',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
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
                'attribute' => 'is_hide',
                'editableOptions' => [
                    'header' => 'Hide',
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => ['Yes' => 'Yes', 'No' => 'No']
                ],
                'pageSummary' => true
            ],
        ],
        'toolbar' => [
            [
                'content' =>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['updates'], [
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
            'type' => GridView::TYPE_PRIMARY,
        ],
    ]);
    ?>
</div>