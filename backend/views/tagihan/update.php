<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tagihan */

$this->title = 'Billing Update';
$this->params['breadcrumbs'][] = ['label' => 'Tagihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtagihan, 'url' => ['view', 'idtagihan' => $model->idtagihan, 'idjurusan' => $model->idjurusan, 'idkelas' => $model->idkelas]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tagihan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'spp' => $spp
    ]) ?>

</div>
