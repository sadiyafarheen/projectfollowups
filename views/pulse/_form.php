<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Pulse */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
	.toggle{
		display:inline-block;
		background:url("<?php echo Yii::$app->request->BaseUrl;?>/images/arrow-down.png");
		background-size: 20px 20px;
		background-repeat: no-repeat;
		background-position: left;
	}
	.toggle.expanded{
	  	background:url("<?php echo Yii::$app->request->BaseUrl;?>/images/arrow-up.png");
		background-size: 20px 20px;
		background-repeat: no-repeat;
		background-position: left;
	}
</style>
<div class="pulse-form">
	<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'project_id')->hiddenInput(['value'=>$_GET['id']])->label(false); ?>
	<div class="row">
	    <div class="col-sm-12">
	    	<div class="col-sm-6">
	    		<div class="row">
	    		<?php echo '<b>Tell me how you are feeling about the project at this time (select all that apply)</b><br />';?>
				    <div class="col-sm-12" style="text-align: center;">
				    	<div class="col-sm-2">
				    	<?php
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/great.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Great',
						]);
						?>
				    	</div>
				    	<div class="col-sm-2">
				    	<?php
					   	
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/happy.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Happy',
						]);
						?>
				    	</div>
				    	<div class="col-sm-2">
				    	<?php
					   	
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/curious.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Curious',
						]);
						?>
				    	</div>
				    	<div class="col-sm-2">
				    	<?php
					   	
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/blah.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Blah',
						]);
						?>
				    	</div>
				    	<div class="col-sm-4">
				    	<?php
					   	
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/down.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Down',
						]);
						?>
				    	</div>
				    </div>
				    <div class="col-sm-12" style="text-align: center; margin-top: 20px">
				    	<div class="col-sm-2">
				    	<?php
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/positive.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Positive',
						]);
						?>
				    	</div>
				    	<div class="col-sm-2">
				    	<?php
					   	
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/sad.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Sad',
						]);
						?>
				    	</div>
				    	<div class="col-sm-2">
				    	<?php
					   	
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/shocked.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Shocked',
						]);
						?>
				    	</div>
				    	<div class="col-sm-2">
				    	<?php
					   	
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/heartbroken.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Heartbroken',
						]);
						?>
				    	</div>
				    	<div class="col-sm-4">
				    	<?php
					   	
						echo '<label class="cbx-label" for="how_you_feel" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/fabulous.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'how_you_feel[]',
						    'value'=>'Anxious',
						]);
						?>
				    	</div>
				    </div>
				</div>
	    	</div>
	    	<div class="col-sm-6">
	    		<div class="row">
	    		<?php echo '<b>What is your feeling about the health of the project at this time (Select all that apply)</b><br />';?>
				    <div class="col-sm-12" style="text-align: center;">
				    	<div class="col-sm-2">
				    	<?php
						echo '<label class="cbx-label" for="about_project_health" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/thumbsup.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'about_project_health[]',
						    'value'=>'Thumbsup',
						]);
						?>
				    	</div>
				    	<div class="col-sm-2">
				    	<?php
					   	
						echo '<label class="cbx-label" for="about_project_health" style="margin-bottom:8px"><img src="'.\Yii::$app->request->BaseUrl.'/images/thumbsdown.png" width="30"></label><br />';
						echo CheckboxX::widget([
						    'name'=>'about_project_health[]',
						    'value'=>'Thumbsdown',
						]);
						?>
				    	</div>
				    </div>
				</div>
	    	</div>
	    </div>
	</div>
    <div style="clear: both;"></div>
    <br />
    
    <div class="toggle" style="cursor: pointer; color: #337AB7; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Detailed Feedback</div>
	<div class="content">
		<div class="row">
		    <div class="col-sm-12">
	    		<?= $form->field($model, 'any_notes')->textarea(['rows' => 6]) ?>
	    	</div>
	   	</div>
	   	<div class="row">
	    <div class="col-sm-12" style="padding: 0">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Accomplishment" name="accomplishment"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Concern" name="concern"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
	            <div class="col-sm-12">
	                <div class="col-sm-6">
	                    <div class="form-group">
	                        <input type="text" class="form-control" placeholder="Enter Decision" name="decision"/>
	                    </div>
	                </div>
	                <div class="col-sm-6">
	                    <div class="form-group">
	                        <input type="text" class="form-control" placeholder="Enter Next Steps or Notes" name="notes"/>
	                        
	                    </div>
	                </div>
	            </div>
            </div>
            <div class="row">
	            <div class="col-sm-12">
	                <div class="col-sm-6">
	                    <div class="form-group">
	                        <input type="text" class="form-control" placeholder="Enter Action Item" name="followup"/>
	                    </div>
	                </div>
	                <div class="col-sm-4">
	                    <div class="form-group">
	                        <input type="text" class="form-control" placeholder="Follow up with" name="assigned_to"/>
	                    </div>
	                </div>
	                <div class="col-sm-2">
	                    <div class="form-group">
	                        <?=
	                        DatePicker::widget([
	                            'id' => 'due_date',
	                            'name' => 'due_date',
	                            'options' => ['placeholder' => 'Due Date'],
	                            'pluginOptions' => [
	                                'format' => 'mm/dd/yyyy',
	                                'autoclose' => true,
	                                'todayHighlight' => true
	                            ]
	                        ]);
	                        ?>
	                    </div>
	                </div>
	            </div>
            </div>
        </div>
    </div>
    <div class="row">
	    <div class="col-sm-12">
	    	<?= $form->field($model, 'action_taken')->textarea(['rows' => 6])->label('Based on your feeling about the project what action would you like taken and by when  '); ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-12">
	    	<?php
				echo '<label class="cbx-label" for="is_agenda">Check the box if you want this item to be added as an agenda item</label>';
				echo CheckboxX::widget([
				    'name'=>'is_agenda',
				    'value' => 'yes',
				    'options'=>['id'=>'is_agenda'],
				    'pluginOptions'=>['threeState'=>false]
				]);
			?>
	    </div>
	</div>
	</div>

    <br /><br />
	<div class="row">
	    <div class="col-sm-12">
	    	<?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	</div>
    

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$(document).ready(function(){
  var jQuerycontent = jQuery(".content").hide();
  $(".toggle").on("click", function(e){
    $(this).toggleClass("expanded");
    jQuerycontent.slideToggle();
  });
});
JS;
$this->registerJs($script);
?>
