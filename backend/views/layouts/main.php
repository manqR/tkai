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

					<!-- <ol class="breadcrumb" style="margin-bottom: 5px;">
						<li class="breadcrumb-item">
							<a href="#">
							Home
							</a>
						</li>
						<li class="breadcrumb-item">
							<a href="#">
							Library
							</a>
						</li>
						<li class="breadcrumb-item active">
							Data
						</li>
					</ol> -->
					

					<div class="main-content">
						
							<!-- <?= Breadcrumbs::widget([
									'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
								]) 
							?> -->
						

						<div class="content-view">
							<?= Alert::widget() ?>
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

<script>
	


   	// const url = 'http://localhost/tkai/api/siswa';
	// fetch(url)
	// .then(response => response.json())
	// .then(json => {                              
	// 	// appendData(json)
		
	// })
	// .catch(error => {
	// 	console.log(error)
	// })

	if ('serviceWorker' in navigator) {
  		navigator.serviceWorker.register('./sw.js').then(() => {
    		console.log('[App] Service Worker Registered')
  		})
	}	

</script>

</html>
<?php $this->endPage() ?>
<?php } ?>
