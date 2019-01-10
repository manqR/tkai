<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TagihanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tagihan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idtagihan') ?>

    <?= $form->field($model, 'idcabang') ?>

    <?= $form->field($model, 'idkategori') ?>

    <?= $form->field($model, 'tahun_ajaran') ?>

    <?= $form->field($model, 'seragam') ?>

    <?php // echo $form->field($model, 'peralatan') ?>

    <?php // echo $form->field($model, 'uang_pangkal') ?>

    <?php // echo $form->field($model, 'uang_bangunan') ?>

    <?php // echo $form->field($model, 'material') ?>

    <?php // echo $form->field($model, 'urutan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
