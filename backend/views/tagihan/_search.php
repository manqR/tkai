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

    <?= $form->field($model, 'idjurusan') ?>

    <?= $form->field($model, 'idkelas') ?>

    <?= $form->field($model, 'administrasi') ?>

    <?= $form->field($model, 'pengembangan') ?>

    <?php // echo $form->field($model, 'praktik') ?>

    <?php // echo $form->field($model, 'semester_a') ?>

    <?php // echo $form->field($model, 'semester_b') ?>

    <?php // echo $form->field($model, 'lab_inggris') ?>

    <?php // echo $form->field($model, 'lks') ?>

    <?php // echo $form->field($model, 'perpustakaan') ?>

    <?php // echo $form->field($model, 'osis') ?>

    <?php // echo $form->field($model, 'mpls') ?>

    <?php // echo $form->field($model, 'asuransi') ?>

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
