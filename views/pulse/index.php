<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pulses';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?php Html::a('Create Pulse', ['create'], ['class' => 'btn btn-success']) ?>
</p>


<p>
    Select Time Frame: 
<button type="button" class="btn btn-light">Last 7 Days</button>
<button type="button" class="btn btn-light">Last 30 days</button>
<button type="button" class="btn btn-light">Current Year</button>
<button type="button" class="btn btn-primary">All</button>
</p>

<p>                          
                            
 
        <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('#lstFruits').multiselect({
                includeSelectAllOption: true
            });
            $('#btnSelected').click(function () {
                var selected = $("#lstFruits option:selected");
                var message = "";
                selected.each(function () {
                    message += $(this).text() + " " + $(this).val() + "\n";
                });
                alert(message);
            });
        });
    </script>
    <span class="multiselect-native-select" style="float: left;
    padding: 0 22px 0 0px;">Select Project(s): <select id="lstFruits" multiple="multiple">
        <option value="1">Team mtg</option>
        <option value="2">Test Cases</option>
        <option value="3">Stories</option>
        <option value="4">Phase 2</option>
        <option value="5">Daily Sync</option>
    </select><div class="btn-group"><button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="None selected"><span class="multiselect-selected-text">All selected</span> <b class="caret"></b></button><ul class="multiselect-container dropdown-menu"><li class="multiselect-item multiselect-all"><a tabindex="0" class="multiselect-all"><label class="checkbox"><input type="checkbox" value="multiselect-all">  Select all</label></a></li><li class=""><a tabindex="0"><label class="checkbox" title="Team mtg"><input type="checkbox" value="1"> Team mtg</label></a></li><li class=""><a tabindex="0"><label class="checkbox" title="Test Cases"><input type="checkbox" value="2"> Test Cases</label></a></li><li class=""><a tabindex="0"><label class="checkbox" title="Stories"><input type="checkbox" value="3"> Stories</label></a></li><li class=""><a tabindex="0"><label class="checkbox" title="Phase 2"><input type="checkbox" value="4"> Phase 2</label></a></li><li class=""><a tabindex="0"><label class="checkbox" title="Daily Sync"><input type="checkbox" value="5"> Daily Sync</label></a></li></ul></div></span>
    
                            
                        
</p>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>

<!--<div class="pulse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'how_you_feel:ntext',
            'about_project_health:ntext',
            'any_notes:ntext',
            // 'action_taken:ntext',
            // 'is_agenda',
            // 'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>-->
