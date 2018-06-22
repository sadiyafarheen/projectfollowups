<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 2/6/2017
 * Time: 1:40 AM
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Calendar';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/zabuto_calendar.min.css");
$this->registerJsFile("@web/js/jquery.js");
$js = "";
?>

    <div class="calendar-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Topic', ['category/create'], ['class' => 'btn btn-success']) ?>
        </p>


        <center>
            <div id="my-calendar"></div>
        </center>

    </div>

<?php
$js = " var d = new Date();
        $(document).ready(function () {
            $('#my-calendar').zabuto_calendar({
                language: 'en',
                year: d.getFullYear(),
                month: d.getMonth() + 1,
                cell_border: true,
                legend: [
                    {type: 'text', label: 'Action Items', badge: 'x'},
                    /*{type: 'block', label: 'Regular event', classname: 'purple'},
                    {type: 'spacer'},
                    {type: 'text', label: 'Bad'},
                    {type: 'list', list: ['grade-1', 'grade-2', 'grade-3', 'grade-4']},
                    {type: 'text', label: 'Good'}*/
                ],
                ajax: {
                  url: '" . Url::to(['calendar/get-projects']) . "',
                  modal: true
                }
            });
        });
   ";
if (!empty($js)) {
    $this->registerJs($js, View::POS_READY);
}
?>