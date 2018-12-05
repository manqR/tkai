<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KelasGroup */

$this->title = 'Create Kelas Group';
$this->params['breadcrumbs'][] = ['label' => 'Kelas Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
	<div class="card">
		<?= $this->render('_form', [
			'model' => $model,
		]) ?>
	</div>
</div>
