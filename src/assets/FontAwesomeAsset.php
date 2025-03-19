<?php

namespace potime\adminlte3\assets;

use yii\web\AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package potime\adminlte3\assets
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@npm/fortawesome--fontawesome-free';

    public $css = [
        'css/all.min.css',
    ];
}