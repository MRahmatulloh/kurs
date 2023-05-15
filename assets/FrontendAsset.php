<?php

namespace app\assets;

use yii\web\AssetBundle;

class FrontendAsset extends AssetBundle
{
    // The files are not web directory accessible, therefore we need
    // to specify the sourcePath property. Notice the @vendor alias used.
//    public $sourcePath = '/appAssets/fontAwesome';
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/front/assets/dist/css/bootstrap.min.cs',
        '/front/assets/dist/css/cover.css',
    ];
}