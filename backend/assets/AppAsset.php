<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendors/bootstrap/dist/css/bootstrap.css',
        'vendors/pace/themes/blue/pace-theme-minimal.css',
        'vendors/font-awesome/css/font-awesome.css',
        'vendors/animate.css/animate.css',
        'styles/app.css',
        'styles/app.skins.css',
    ];
    public $js = [
		// 'vendor/jquery/dist/jquery.js',
		'vendors/pace/pace.js',
		'vendors/tether/dist/js/tether.js',
		'vendors/bootstrap/dist/js/bootstrap.js',
		'vendors/fastclick/lib/fastclick.js',
		'scripts/constants.js',
		'scripts/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
