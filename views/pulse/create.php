<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pulse */

$this->title = 'Create Pulse';
$this->params['breadcrumbs'][] = ['label' => 'Pulses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pulse-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listData' => $listData
    ]) ?>

</div>
