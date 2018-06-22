<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 22/05/2017
 * Time: 03:04 AM
 */
use yii\helpers\Url;

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
                    <div class="col-md-12">
                        <b>View Only URL </b>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="url">
                                http://<?= Yii::$app->params['siteUrl'] ?>/category/view-only?id=<?= $model->viewPermissionsUrl->url; ?>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <button onclick="copyToClipboard('#url')" type="button" class="btn btn-info">Copy URL</button>
                        </div>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="row">
                    <div id="col-md-12">
                        <b>Full Permissions URL </b>
                    </div>
                    <br/>
                    <form action="<?= Url::to(['category/full-permission-send']) ?>" method="post">
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                        <input type="hidden" name="category" value="<?= base64_encode($model->id) ?>"/>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" name="name" type="text" style="width: 50%"
                                       placeholder="Enter Recipient's Name" required/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="email" type="email" style="width: 50%"
                                       placeholder="Enter Recipient's Email Address" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Send URL via Email</button>
                        </div>
                    </form>
                </div>
        </center>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
