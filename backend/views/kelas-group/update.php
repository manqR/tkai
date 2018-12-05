<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KelasGroup */

$this->title = 'Update Kelas Group: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Kelas Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idgroup, 'url' => ['view', 'id' => $model->idgroup]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="col-lg-12">
	<div class="card">
		<?= $this->render('_form', [
			'model' => $model,
		]) ?>
	</div>
</div>
