<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TagihanSiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tagihan-siswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idtagihan_siswa') ?>

    <?= $form->field($model, 'idtagihan') ?>

    <?= $form->field($model, 'idsiswa') ?>

    <?= $form->field($model, 'tahun_ajaran') ?>

    <?= $form->field($model, 'nama_tagihan') ?>

    <?php // echo $form->field($model, 'besaran') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'user_create') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
