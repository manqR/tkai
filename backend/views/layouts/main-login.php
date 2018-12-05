<?php
use yii\web\View;
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

// AppAsset::register($this);

/* @ROOT */
$root = '@web';


/* @JS */
$this->registerJsFile($root."/vendors/pace/pace.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/tether/dist/js/tether.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/bootstrap/dist/js/bootstrap.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/fastclick/lib/fastclick.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/scripts/constants.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/scripts/main.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);


$this->registerCss("
	.help-block-error{
		color:#c0392b;
	}
");

?>
<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
		<head>
			<meta charset="<?= Yii::$app->charset ?>"/>			
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="description" content=""/>
			<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
			<meta name="msapplication-tap-highlight" content="no">			
			<meta name="mobile-web-app-capable" content="yes">
			<meta name="application-name" content="Milestone">
			<meta name="apple-mobile-web-app-capable" content="yes">
			<meta name="apple-mobile-web-app-status-bar-style" content="black">
			<meta name="apple-mobile-web-app-title" content="Milestone">
			<meta name="theme-color" content="#4C7FF0">
			<link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.css"/>
			<link rel="stylesheet" href="vendors/pace/themes/blue/pace-theme-minimal.css"/>
			<link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.css"/>
			<link rel="stylesheet" href="vendors/animate.css/animate.css"/>
			<link rel="stylesheet" href="styles/app.css" id="load_styles_before"/>
			<link rel="stylesheet" href="styles/app.skins.css"/>
	
			<?= Html::csrfMetaTags() ?>
			<title><?= $this->title ?></title>
			<?php $this->head() ?>
		</head>
		<body>
			<?php $this->beginBody() ?>
			<div class="app no-padding no-footer layout-static">
				<div class="session-panel">
					<div class="session">
								
						<?= $content ?>
				
						<footer class="text-xs-center p-y-1">
							<p>
								<a href="extra-forgot.html">
									Forgot password?
								</a>
							
							</p>
						</footer>
						
					</div>
				</div>
			</div>
			<?php $this->endBody() ?>
			
		</body>
	</html>
<?php $this->endPage() ?>
