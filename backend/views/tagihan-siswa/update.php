<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TagihanSiswa */

$this->title = 'Update Tagihan Siswa: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tagihan Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtagihan_siswa, 'url' => ['view', 'id' => $model->idtagihan_siswa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tagihan-siswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
