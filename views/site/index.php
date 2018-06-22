<?php

/* @var $this yii\web\View */

$this->title = 'Project FollowUps';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Project Follow Ups</h1>

        <p class="lead">An easy way to get traction on your Action Items, Follow Ups and Projects</p>

        <p><a class="btn btn-lg btn-success" href="<?= Yii::$app->urlManager->createUrl(['category/create'])?>">Add a New Topic</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Topic Tabs</h2>

                <p>Create Topic Tabs in the top menu header Hover over the tabs to add an action item.</p>

                <p><a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl(['category/index'])?>">Categories &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Get Project Traction</h2>

                <p>Track Action Items, Follow ups, Decisions and Accomplishments.</p>

                <!--<p><a class="btn btn-default" href="<?/*= Yii::$app->urlManager->createUrl(['project/index'])*/?>">Projects &raquo;</a></p>-->
            </div>
            <div class="col-lg-4">
                <h2>Projects</h2>

                <p>Easily add Tasks, Follow ups and related project info such as milestones, meeting notes and decisions</p>

                <!--<p><a class="btn btn-default" href="<?/*= Yii::$app->urlManager->createUrl(['task/index'])*/?>">Tasks &raquo;</a></p>-->
            </div>
        </div>

    </div>
</div>
