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

    <?= $form->field($model, 'idsiswa') ?>

    <?= $form->field($model, 'idkelas') ?>

    <?= $form->field($model, 'idjurusan') ?>

    <?= $form->field($model, 'nama_lengkap') ?>

    <?= $form->field($model, 'jenis_kelamin') ?>

    <?php // echo $form->field($model, 'nisn') ?>

    <?php // echo $form->field($model, 'no_seri_ijazah_smp') ?>

    <?php // echo $form->field($model, 'no_seri_skhun_smp') ?>

    <?php // echo $form->field($model, 'no_ujian_nasional') ?>

    <?php // echo $form->field($model, 'nik') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'tanggal_lahir') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'kelurahan') ?>

    <?php // echo $form->field($model, 'kecamatan') ?>

    <?php // echo $form->field($model, 'kota') ?>

    <?php // echo $form->field($model, 'provinsi') ?>

    <?php // echo $form->field($model, 'transportasi') ?>

    <?php // echo $form->field($model, 'tlp_rumah') ?>

    <?php // echo $form->field($model, 'hp') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status_kps') ?>

    <?php // echo $form->field($model, 'no_kps') ?>

    <?php // echo $form->field($model, 'tinggi_badan') ?>

    <?php // echo $form->field($model, 'berat_badan') ?>

    <?php // echo $form->field($model, 'jarak_tempat_tinggal') ?>

    <?php // echo $form->field($model, 'waktu_tempuh') ?>

    <?php // echo $form->field($model, 'jml_saudara') ?>

    <?php // echo $form->field($model, 'user_create') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'user_update') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
