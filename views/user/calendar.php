<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 2/6/2017
 * Time: 1:40 AM
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

$this->title = 'Calendar';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("@web/js/jquery.js");

$JSEventRender = <<<EOF
        function(event, el) {
            if ((!el.hasClass('fc-start') && !el.hasClass('fc-end')) || !el.hasClass('fc-start')) {
                el.find('.fc-title').text("");
                el.find('.fc-title').css("padding" , "11px");
            }
        }
EOF;
$JSEventClick = <<<EOF
        function(calEvent, jsEvent, view) {
            $('#modalTitle').text(calEvent.title);
            $('#field1').text(calEvent.nonstandard.field1);
            $('#field2').text(calEvent.nonstandard.field2);
            $('#field3').text(calEvent.nonstandard.field3);
            $('#field4').text(calEvent.nonstandard.field4);
            $('#calendarModal').modal('show'); 
        }
EOF;
?>

<div class="calendar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Topic', ['category/create'], ['class' => 'btn btn-success']) ?>
    </p>
    <br/>
    <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
        'clientOptions' => [
            'eventClick' => new JsExpression($JSEventClick),
            'eventRender' => new JsExpression($JSEventRender),
            'header' => [
                'left' => 'prev',
                'center' => 'title',
                'right' => 'next',
            ]
        ],
        'events' => $events,
    )); ?>

    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div id="modalBody" class="modal-body">
                    <p><b>Action Item &nbsp;: </b> &nbsp;&nbsp; <span id="field1"></span></p>
                    <p><b>Assigned To : </b> &nbsp;&nbsp; <span id="field2"></span></p>
                    <p><b>Against &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp; <span id="field3"></span></p>
                    <p><b>Due By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp; <span id="field4"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>