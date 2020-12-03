<?php

/* @var $this yii\web\View */
/* @var $content string */

use potime\adminlte3\assets\AdminLteAsset;
use potime\adminlte3\assets\FontAwesomeAsset;
use potime\adminlte3\widgets\Alert;
use yii\helpers\Html;

AdminLteAsset::register($this);
FontAwesomeAsset::register($this);

$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?= $this->render('navbar', ['directoryAsset' => $directoryAsset]) ?>

    <?= $this->render('sidebar', ['directoryAsset' => $directoryAsset]) ?>

    <div class="content-wrapper">

        <?= $this->render('header') ?>

        <section class="content">
            <div class="container-fluid">
                <?= Alert::widget(); ?>
                <?= $content ?>
            </div>
        </section>
    </div>

    <?= $this->render('footer') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>