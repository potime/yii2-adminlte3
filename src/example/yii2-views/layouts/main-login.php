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
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>
<div class="login-box">
    <div class="login-logo">
        <?= Html::a('<b>Admin</b>LTE', ['/site/login']); ?>
    </div>
    <?= Alert::widget(); ?>
    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>