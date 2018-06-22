<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>All your tasks are shown here.</p>
    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['header' => 'Category Name', 'value' => 'project.category.name'],
            ['header' => 'Project Name', 'value' => 'project.title'],
            'title',
            'assigned_to',
            'phase',
            'status',
            'start_date',
            'end_date',
            'more_info:ntext',
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
