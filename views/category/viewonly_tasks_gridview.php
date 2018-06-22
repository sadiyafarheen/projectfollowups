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
        'attribute' => 'title',
    ],
    [
        'attribute' => 'assigned_to',
    ],
    [
        'attribute' => 'phase',
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
        'attribute' => 'more_info',
        'value' => function ($url, $model) {
            if (!empty($model->more_info)) {
                return $model->more_info;
            }
            return NULL;
        },
    ],
]; ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'summary' => false,
    'toolbar' => false,
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