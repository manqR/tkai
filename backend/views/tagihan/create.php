<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Tagihan */

$this->title = 'Setup Billing';
$this->params['breadcrumbs'][] = ['label' => 'Tagihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


	<?= $this->render('_form', [
		'model' => $model,
		'spp' => $spp
	]) ?>

