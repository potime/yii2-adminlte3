<?php

/* @var $this yii\web\View */

use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Inflector;

?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <?php if (isset($this->blocks['content-header'])) { ?>
                    <h1><?= $this->blocks['content-header']; ?></h1>
                <?php } else { ?>
                    <h1>
                        <?php
                        if ($this->title !== null) {
                            echo Html::encode($this->title);
                        } else {
                            echo Inflector::camel2words(Inflector::id2camel($this->context->module->id));
                            echo ($this->context->module->id !== Yii::$app->id) ? '<small>Module</small>' : '';
                        } ?>
                    </h1>
                <?php } ?>
            </div>

            <div class="col-sm-6">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => [
                        'class' => 'float-sm-right'
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</section>