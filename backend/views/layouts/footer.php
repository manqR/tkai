<?php

/* @var $this \yii\web\View */
/* @var $content string */

	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use common\widgets\Alert;

?>
<!-- bottom footer -->
<div class="content-footer">

	<nav class="footer-left">
		<ul class="nav">
			<li>
				<a href="javascript:;">
				<span>Copyright</span>				
				&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>
				</a>
			</li>
			<li class="hidden-md-down">
				<a href="javascript:;">Privacy</a>
			</li>
			<li class="hidden-md-down">
				<a href="javascript:;">Terms</a>
			</li>
			<li class="hidden-md-down">
				<a href="javascript:;">help</a>
			</li>
		</ul>
	</nav>
</div>
<!-- /bottom footer -->