<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */

$this->title = 'Update Register : ' . $model->nis;
$this->params['breadcrumbs'][] = ['label' => 'Registrasi Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nis, 'url' => ['view', 'id' => $model->no_registrasi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siswa-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
