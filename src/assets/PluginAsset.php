<?php

namespace potime\adminlte3\assets;

use yii\web\AssetBundle;

/**
 * Class PluginAsset
 * @package potime\adminlte3\assets
 */
class PluginAsset extends AssetBundle
{
    public $sourcePath = '@potime/adminlte3/dist';

    public $css = [
        'css/styles.min.css',
    ];
}