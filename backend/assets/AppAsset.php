<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/web';
    public $baseUrl = '@web/web';
    public $css = [
        'css/site.css',
        'css/template.css',
        'https://use.fontawesome.com/releases/v5.8.1/css/all.css',
        'css/animate.min.css',
    ];
    public $js = [
        'js/script.js',
        'js/wow.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
        'js/jquery.maskedinput.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
