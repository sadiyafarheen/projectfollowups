<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 22/05/2017
 * Time: 02:24 AM
 */
use app\components\ConversionHelper;
?>

<?php
$avgRating = 0;
$sumRating = 0;
$countRating = 0;
if (!empty($model->ratings)) {
    foreach ($model->ratings as $rating){
        $sumRating = $sumRating + $rating->rating;
        $countRating++;
    }
    $avgRating = $sumRating / $countRating;
}
?>
<!-- Ratings -->
<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Rating</h4>
        </div>
        <center>
            <div class="modal-body">
                <div class="row">
                    <?php if (!empty($model->ratings)) { ?>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <b>Average Rating</b>
                            </div>
                            <div class="col-md-6">
                                <?php for ($x = 1; $x <= $avgRating; $x++) { ?>
                                    <i class="fa fa-star" style="color: gold"></i>
                                <?php }
                                if (strpos($avgRating, '.')) { ?>
                                    <i class="fa fa-star-half-o" style="color: gold"></i>
                                    <?php $x++;
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr style="color: #000; width: 75%;"/>
                        </div>
                        <?php foreach ($model->ratings as $rating) { ?>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <b><?= $rating->user->username ?></b>
                                </div>
                                <div class="col-md-5">
                                    <?php for ($x = 1; $x <= $rating->rating; $x++) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php }
                                    if (strpos($rating->rating, '.')) { ?>
                                        <i class="fa fa-star-half-o"></i>
                                        <?php $x++;
                                    } ?>
                                </div>
                                <div class="col-md-3">
                                    <span class="date-day"><?= ConversionHelper::getDate($rating->date) ?></span>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo 'There are currently no rating for this Project';
                    }
                    ?>
                </div>
            </div>
        </center>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>