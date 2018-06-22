<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 22/05/2017
 * Time: 03:04 AM
 */
?>

<!-- Permissions -->
<div class="modal-dialog" style="width: 800px">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Permissions</h4>
        </div>
        <center>
            <div class="modal-body">
                <div class="row">
                    <div id="col-md-12">
                        <b>Copy View Only URL </b>
                    </div>
                    <div class="col-md-12">
                        <?= "http://projectstatusboard.com/index.php/category/view-only?id=" . $model->viewPermissionsUrl->url; ?>
                    </div>
                </div>
        </center>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>