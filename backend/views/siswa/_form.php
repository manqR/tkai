<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_siswa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idcabang')->textInput() ?>

    <?= $form->field($model, 'idkategori')->textInput() ?>

    <?= $form->field($model, 'nisn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_panggilan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tlp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tlp_darurat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_ayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_ibu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pekerjaan_ayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pekerjaan_ibu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_input')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_input')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
