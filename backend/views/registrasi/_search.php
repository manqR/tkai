<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nis') ?>

    <?= $form->field($model, 'kode_siswa') ?>

    <?= $form->field($model, 'idcabang') ?>

    <?= $form->field($model, 'idkategori') ?>

    <?= $form->field($model, 'nisn') ?>

    <?php // echo $form->field($model, 'nama_lengkap') ?>

    <?php // echo $form->field($model, 'nama_panggilan') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'jenis_kelamin') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'tanggal_lahir') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'tlp') ?>

    <?php // echo $form->field($model, 'tlp_darurat') ?>

    <?php // echo $form->field($model, 'nama_ayah') ?>

    <?php // echo $form->field($model, 'nama_ibu') ?>

    <?php // echo $form->field($model, 'pekerjaan_ayah') ?>

    <?php // echo $form->field($model, 'pekerjaan_ibu') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'tahun_input') ?>

    <?php // echo $form->field($model, 'tgl_input') ?>

    <?php // echo $form->field($model, 'urutan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
