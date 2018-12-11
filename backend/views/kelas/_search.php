<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KelasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'idkategori') ?>

    <?= $form->field($model, 'idcabang') ?>

    <?= $form->field($model, 'tahun_ajaran') ?>

    <?= $form->field($model, 'wali_kelas') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <?php // echo $form->field($model, 'key_') ?>

    <?php // echo $form->field($model, 'urutan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
