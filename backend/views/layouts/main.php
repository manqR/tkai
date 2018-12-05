<?php

/* @var $this \yii\web\View */
/* @var $content string */

	use backend\assets\AppAsset;
	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use common\widgets\Alert;

	
	 if (Yii::$app->controller->action->id === 'login'){ 

        echo $this->render(
            'main-login',
            ['content' => $content]
        );
    } else {
		
		AppAsset::register($this);
		$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@web/backend/layout');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	
	<body>
		<?php $this->beginBody() ?>
			<div class="app">
				<?= $this->render(
                    'left.php',
                    ['directoryAsset' => $directoryAsset]) 
				?>
				<!-- content panel -->
				<div class="main-panel">
					
					
					<?= $this->render(
						'header.php',
						['directoryAsset' => $directoryAsset]) 
					?>
					
					<!-- main area -->
					<div class="main-content">
						<div class="content-view">
							<?= $content ?> <!-- Content Area -->						
						</div>
						
						<?= $this->render(
							'footer.php',
							['directoryAsset' => $directoryAsset]) 
						?>
					</div>
					<!-- /main area -->
				</div>
				<!-- /content panel -->
											
			</div>			
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>
<?php } ?>
