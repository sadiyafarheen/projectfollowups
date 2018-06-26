<?php
/* @var $this yii\web\View */
//print_r($blogs);
$formatter = \Yii::$app->formatter;
?>
<h1>Latest Blog</h1>
<hr />
	<div class="container">
		<?php
		foreach ($blogs as $blog) {
		?>
        <div class="row">
          <div class="col-md-12">
            <h3 style="background: #e0e0e0; line-height: 45px; padding-left: 10px; color: #2e6da4;"><?php echo $blog->title;?></h3>
            <div style="padding-left: 10px">
			  <input type="checkbox" class="read-more-state" id="<?php echo $blog->id;?>" />
			  <p class="read-more-wrap"><?php echo substr($blog->content, 0, 250);?> <span class="read-more-target"><?php echo substr($blog->content, 250);?></span></p>
			  
			  <label for="<?php echo $blog->id;?>" class="read-more-trigger"></label>
			  <p style="text-align: right;"><i>Posted By <b>Admin</b> on <?php echo $formatter->asDate($blog->update_time, 'long'); ?></i></p>
			</div>
            <hr />
          </div>
        </div>
        <?php } ?>
	</div>
