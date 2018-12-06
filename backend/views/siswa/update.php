<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */

$this->title = 'Update Siswa: ' . $model->nis;
$this->params['breadcrumbs'][] = ['label' => 'Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nis, 'url' => ['view', 'nis' => $model->nis, 'kode_siswa' => $model->kode_siswa, 'urutan' => $model->urutan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
