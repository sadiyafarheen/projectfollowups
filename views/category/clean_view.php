<?php

use app\models\Projects;
use app\models\TaskSearch;
use kartik\date\DatePicker;
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

            return Yii::$app->controller->renderPartial('clean_tasks_gridview', [
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
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'title',
                'editableOptions' => [
                    'header' => 'Title',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    //'class' => 'toHide title-align',
                ],
                'pageSummary' => true,
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
                'attribute' => 'custom_field',
                'editableOptions' => [
                    'header' => 'Custom',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                ],
                'pageSummary' => true
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'max-width:100px'],
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
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['clean-view', 'id' => base64_encode($model->id), 'due' => $due], [
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
            'options'=>[
                'id'=>'clean-view-pgrid',
            ]
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'before' => Html::a('<i class="fa fa-compress"></i>', [
                    'clean-view',
                    'id' => base64_encode($model->id),
                    'due' => $due
                ], [
                    'class' => 'btn btn-success',
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

<?= $this->render('_modals', ['model' => $model, 'modal_type' => 'add-project', 'file' => 'modal_body/add_project.php']); ?>