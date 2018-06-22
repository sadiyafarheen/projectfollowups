<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 3/29/2017
 * Time: 1:48 PM
 */
use app\models\Tasks;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'update_type',
        'editableOptions' => function ($model, $key, $index) {
            return [
                'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data' => ['Accomplishment' => 'Accomplishment', 'Concern' => 'Concern', 'Decision' => 'Decision', 'Follow Up' => 'Follow Up'],
                'formOptions' => [
                    'id' => 'igl1_' . 'igl_' . $model->id,
                ],
                'options' => [
                    'id' => 'igl1_' . $index . '_' . $model->id,
                ]
            ];
        },
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'update_text',
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
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'response',
        'editableOptions' => function ($model, $key, $index) {
            return [
                'formOptions' => [
                    'id' => 'igl4_' . 'igl_' . $model->id,
                ],
                'options' => [
                    'id' => 'igl4_' . $index . '_' . $model->id,
                ]
            ];
        },
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'is_close',
        'editableOptions' => function ($model, $key, $index) {
            return [
                'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data' => ['0' => 'No', '1' => 'Yes'],
                'formOptions' => [
                    'id' => 'igl99_' . 'ig99_' . $model->id,
                ],
                'options' => [
                    'id' => 'igl99_' . $index . '_' . $model->id,
                ]
            ];
        },
        'value' => function ($model, $key, $index) {
            return ($model->is_close) ? "Yes" : "No";
        }
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'due_date',
        'format' => ['date', 'php:m/d/Y'],
        'editableOptions' => function ($model, $key, $index) {
            return [
                'formOptions' => [
                    'id' => 'igl5_' . 'igl_' . $model->id,
                ],
                'header' => '&nbsp;',
                'size' => 'md',
                'inputType' => Editable::INPUT_WIDGET,
                'pluginEvents' => [],
                'widgetClass' => 'kartik\datecontrol\DateControl',
                'options' => [
                    'id' => 'igl5_' . $index . '_' . $model->id,
                    'displayFormat' => 'php:m/d/Y',
                    'saveFormat' => 'php:Y-m-d',
                    'type' => DateControl::FORMAT_DATE,
                    'ajaxConversion' => true,
                    'options' => [
                        'id' => 'igl1asd_' . $index . '_' . $model->id,
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
        'attribute' => 'date',
        'label' => 'Created At',
        'format' => ['date', 'php:m/d/Y'],
        'editableOptions' => function ($model, $key, $index) {
            return [
                'formOptions' => [
                    'id' => 'igl6_' . 'igl_' . $model->id,
                ],
                'header' => '&nbsp;',
                'size' => 'md',
                'inputType' => Editable::INPUT_WIDGET,
                'pluginEvents' => [],
                'widgetClass' => 'kartik\datecontrol\DateControl',
                'options' => [
                    'id' => 'igl6_' . $index . '_' . $model->id,
                    'displayFormat' => 'php:m/d/Y',
                    'saveFormat' => 'php:Y-m-d',
                    'type' => DateControl::FORMAT_DATE,
                    'ajaxConversion' => true,
                    'options' => [
                        'id' => 'igl1qwe_' . $index . '_' . $model->id,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]
                ]
            ];
        },
    ],
    [
        'attribute' => 'projectUpdate.user.username',
        'label' => 'Created By'
    ],
    /*[
        'class' => 'yii\grid\ActionColumn',
        'template' => '{delete}',
        'buttons' => [
            'delete' => function($url, $model){
                return Html::a('<span class="fa fa-trash"></span>', ['task/delete', 'id' => base64_encode($model->id)], [
                    'class' => '',
                    'data' => [
                        'confirm' => 'Are you absolutely sure? You will lose all the information about this task with this action.',
                        'method' => 'post',
                    ],
                ]);
            },
        ],
    ],*/
]; ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'summary' => false,
    'toolbar' => [
        [
            'content' => '',
        ],
    ],
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