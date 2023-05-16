<?php

namespace app\assets;

use yii\web\AssetBundle;

class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '/front/assets/dist/css/bootstrap.min.cs',
        '/front/assets/dist/css/cover.css',
    ];

    public $js = [
        '/front/assets/dist/js/bootstrap.bundle.min.js'
    ];
}