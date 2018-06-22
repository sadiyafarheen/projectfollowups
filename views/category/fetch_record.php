<?php
//Include database connection
use app\models\Projects;
use app\models\Ratings;

if ($_POST['projectId']) {
    $id = $_POST['projectId']; //escape string
    $project = Ratings::find()->where(['project_id' => $id])->all();
    echo json_encode($project);
}
?>