<?php

namespace potime\adminlte3\assets;

use yii\web\AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package potime\adminlte3\assets
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/fontawesome-free';

    public $css = [
        'css/all.min.css',
    ];
}