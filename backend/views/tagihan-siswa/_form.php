<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TagihanSiswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tagihan-siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idtagihan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idsiswa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_ajaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_tagihan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'besaran')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_create')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
