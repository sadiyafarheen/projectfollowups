<?php

use app\models\Projects;
use app\models\TaskSearch;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model app\models\Categories */


$this->title = $model->name;

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="categories-view">
    <?php
    $expandCol = [
        'class' => '\kartik\grid\ExpandRowColumn',
        'value' => function ($model, $key, $index) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index) {
            $sm = new TaskSearch();
            $dp = $sm->search(Yii::$app->request->queryParams, $model->id);

            return Yii::$app->controller->renderPartial('viewonly_tasks_gridview', [
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
            $expandCol,
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'title',
            ],
            [
                'attribute' => 'assigned_to',
            ],
            [
                'attribute' => 'phase',
            ],
            [
                'attribute' => 'percentage_complete',
            ],
            [
                'attribute' => 'status',
            ],
            [
                'attribute' => 'start_date',
                'format' => ['date', 'php:m/d/Y'],
            ],
            [
                'attribute' => 'end_date',
                'format' => ['date', 'php:m/d/Y'],
            ],
            [
                'attribute' => 'custom_field',
            ],
            [
                'attribute' => 'priority',
            ],
            [
                'attribute' => 'stake_holder',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'min-width:80px'],
                'template' => '<span style="margin-left: 3px">{message}</span>  
                               <span style="margin-left: 2px">{givestars}</span>  
                               <span style="margin-left: 2px">{updates}</span>  
                               <span style="margin-left: 3px">{moreinfo}</span>  
                               <span style="margin-left: 5px">{custom}</span>
                               ',
                'buttons' => [
                    'message' => function ($url, $model) {
                        $modal_type = 'view-discussions' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'viewonly_modal_body/discussions.php']);
                        return '<a href="#' . $modal_type . '" data-toggle="modal" data-id="' . $model->id . '" title="View Discussions" >
                                    <span class="fa fa-comments"></span>
                                </a>';
                    },
                    'givestars' => function ($url, $model) {
                        $modal_type = 'view-givestars' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'viewonly_modal_body/ratings.php']);
                        return '<a href="#' . $modal_type . '" data-toggle="modal" data-id="' . $model->id . '" title="View Ratings" >
                                    <span class="fa fa-star"></span>
                                </a>';
                    },
                    'updates' => function ($url, $model) {
                        $modal_type = 'view-updates' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'viewonly_modal_body/updates.php']);
                        return '<a href="#' . $modal_type . '" data-toggle="modal" data-id="' . $model->id . '" title="View Updates" >
                                    <span class="fa fa-bars"></span>
                                </a>';
                    },
                    'moreinfo' => function ($url, $model) {
                        $modal_type = 'view-info' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'viewonly_modal_body/moreinfo.php']);
                        return '<a href="#' . $modal_type . '" data-toggle="modal" data-id="' . $model->id . '" title="More Info" >
                                    <span class="fa fa-info-circle"></span>
                                </a>';
                    },
                    'custom' => function ($url, $model) {
                        $modal_type = 'view-custom' . $model->id;
                        echo $this->render('_modals', ['model' => $model, 'modal_type' => $modal_type, 'file' => 'viewonly_modal_body/custom.php']);
                        return '<a href="#' . $modal_type . '" data-toggle="modal" data-id="' . $model->id . '" title="Custom Field" >
                                    <span class="fa fa-plus-circle"></span>
                                </a>';
                    },
                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'resizableColumns' => true,
        'pjax' => true,
        'pjaxSettings' => [
            'neverTimeout' => true,
        ],
        'toolbar' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => $model->name,
        ],
    ]);
    ?>
</div>
