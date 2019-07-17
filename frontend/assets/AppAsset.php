<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/template.css',
        'https://use.fontawesome.com/releases/v5.8.1/css/all.css',
        'css/animate.min.css',
        'css/cropper.min.css',
    ];
    public $js = [
        //'jquery-3.3.1.min.js',
        'js/script.js',
        'js/wow.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
        'js/jquery.maskedinput.min.js',
        'js/jquery-ui.min.js',
        'js/cropper.min.js',
        'js/typed.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
