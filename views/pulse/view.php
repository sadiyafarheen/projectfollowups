<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pulse */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pulses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="pulse-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'project_id',
            'how_you_feel:ntext',
            'about_project_health:ntext',
            'any_notes:ntext',
            'action_taken:ntext',
            'is_agenda',
            'date',
        ],
    ]) ?>

    

</div>
