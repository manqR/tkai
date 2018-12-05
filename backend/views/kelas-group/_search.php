<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KelasGroupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-group-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idgroup') ?>

    <?= $form->field($model, 'idkelas') ?>

    <?= $form->field($model, 'idjurusan') ?>

    <?= $form->field($model, 'wali_kelas') ?>

    <?= $form->field($model, 'tahun_ajaran') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
