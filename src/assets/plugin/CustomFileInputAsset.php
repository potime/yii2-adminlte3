<?php

namespace potime\adminlte3\assets\plugin;

use yii\web\AssetBundle;

/**
 * Class CustomFileInputAsset
 * @package potime\adminlte3\assets\plugin
 */
class CustomFileInputAsset extends AssetBundle
{
    public $sourcePath = '@potime/adminlte3/dist';

    public $js = [
        'js/bs-custom-file-input.min.js',
    ];
}