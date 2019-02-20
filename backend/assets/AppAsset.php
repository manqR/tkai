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
        'vendors/select2/select2.css',
        'vendors/bootstrap/dist/css/bootstrap.css',
        'vendors/pace/themes/blue/pace-theme-minimal.css',
        'vendors/font-awesome/css/font-awesome.css',
        'vendors/animate.css/animate.css',
        'vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker.css',
        'styles/app.css',
        'styles/app.skins.css',        
        'vendors/datatables/media/css/dataTables.bootstrap4.css',
        'vendors/sweetalert/dist/sweetalert.css',        
       
        
    ];
    public $js = [
		// 'vendor/jquery/dist/jquery.js',
		'vendors/pace/pace.js',
		'vendors/tether/dist/js/tether.js',
		'vendors/bootstrap/dist/js/bootstrap.js',
        'vendors/fastclick/lib/fastclick.js',
        'vendors/datatables/media/js/jquery.dataTables.js',
        'vendors/bootstrap-datepicker/js/bootstrap-datepicker.js',
        'vendors/datatables/media/js/dataTables.bootstrap4.js',
        'vendors/sweetalert/dist/sweetalert.min.js',
        'vendors/select2/select2.js',
        'scripts/constants.js',
        'scripts/forms/plugins.js',
		'scripts/main.js',
		'inc/apiTable.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
