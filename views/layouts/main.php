<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\components\CategoryMenuHelper;
use app\models\Categories;
use app\models\UserCategoryPermissions;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/jquery.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/extensions/tinymce/js/tinymce/tinymce.min.js"></script>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $categories = Categories::find()->where(['user_id' => Yii::$app->user->id])->all();
    $shared_categories = UserCategoryPermissions::find()->where(['user_id' => Yii::$app->user->id])->all();
    $tabs = array();
    if (!Yii::$app->user->isGuest) {
        $submycats = array();
        $subshcats = array();
        foreach ($categories as $category) {
            $tabs[] = [
                'label' => $category->name,
                'items' => CategoryMenuHelper::getItems($category)
            ];
        }
        foreach ($shared_categories as $shared_category) {
            if ($shared_category->category->user_id != Yii::$app->user->id) {
                $subshcats[] = [
                    'label' => $shared_category->category->name,
                    'items' => CategoryMenuHelper::getItems($shared_category->category)
                ];
            }
        }
        if (!empty($subshcats)) {
            $tabs[] = ['label' => '<i class="fa fa-share"></i>  Shared Categories', 'items' => $subshcats];
        }
    }
    $tabs[] = ['label' => '<i class="fa fa-calendar"></i>', 'url' => ['/calendar']];

    if (Yii::$app->user->isGuest) {
        $tabs[] = ['label' => '<i class="fa fa-sign-in"></i> Login', 'url' => ['/user/login']];
    }
    $tabs[] = Yii::$app->user->isGuest ? (
    ['label' => '<i class="fa fa-chevron-circle-up"></i> Register', 'url' => ['/user/register']]
    ) : '';
    if (!Yii::$app->user->isGuest) {
        if(Yii::$app->user->id==30) {
            $tabs[] = [
            'label' => '<i class="fa fa-cog"></i>', 'url' => ['/site/index'],
            'items' => [
                ['label' => '<i class="fa fa-home"></i> Home', 'url' => ['/site/index']],
                ['label' => '<i class="fa fa-plus-circle"></i> Create a New Tab', 'url' => ['/category/create']],
                ['label' => '<i class="fa fa-bookmark"></i> Manage Categories', 'url' => ['/category']],
                ['label' => '<i class="fa fa-user-circle"></i> Profile', 'url' => ['/user/settings/account']],
                ['label' => '<i class="fa fa-newspaper-o"></i> Reports', 'url' => ['/report/updates']],
                ['label' => '<i class="fa fa-rss-square" aria-hidden="true"></i> Manage Blog Post', 'url' => ['/post']],
                ['label' => '<i class="fa fa-file-text" aria-hidden="true"></i> Blog', 'url' => ['/blog']],
                ['label' => '<i class="fa fa-sign-out"></i> Logout', 'url' => ['/user/logout'], 'linkOptions' => ['data-method' => 'post']],
            ],
        ];
        } else {
            $tabs[] = [
            'label' => '<i class="fa fa-cog"></i>', 'url' => ['/site/index'],
            'items' => [
                ['label' => '<i class="fa fa-home"></i> Home', 'url' => ['/site/index']],
                ['label' => '<i class="fa fa-plus-circle"></i> Create a New Tab', 'url' => ['/category/create']],
                ['label' => '<i class="fa fa-bookmark"></i> Manage Categories', 'url' => ['/category']],
                ['label' => '<i class="fa fa-user-circle"></i> Profile', 'url' => ['/user/settings/account']],
                ['label' => '<i class="fa fa-newspaper-o"></i> Reports', 'url' => ['/report/updates']],
                ['label' => '<i class="fa fa-file-text" aria-hidden="true"></i> Blog', 'url' => ['/blog']],
                ['label' => '<i class="fa fa-sign-out"></i> Logout', 'url' => ['/user/logout'], 'linkOptions' => ['data-method' => 'post']],
            ],
        ];
        }
        
    }
    NavBar::begin([
        'brandLabel' => 'Project FollowUps ',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'items' => $tabs,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Project FollowUps <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<script>
    function saveFocus(id) {
        $.ajax({
            url: "<?=Url::to(['project/change-focus'])?>",
            data: 'id=' + id,
            success: function (result) {
            }
        });
    }
    function saveAllFocus(Control) {
        if (Control.checked) {
            $.ajax({
                url: "<?=Url::to(['project/all-check-focus'])?>",
                success: function (result) {
                }
            });
        }
        else {
            $.ajax({
                url: "<?=Url::to(['project/all-uncheck-focus'])?>",
                success: function (result) {
                }
            });
        }
    }
</script>
</body>
</html>
<?php $this->endPage() ?>
