<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PencatatanKeuanganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pencatatan-keuangan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcatat') ?>

    <?= $form->field($model, 'no_pencatatan') ?>

    <?= $form->field($model, 'kategori') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'nominal') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <?php // echo $form->field($model, 'user_create') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
