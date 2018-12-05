<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CartSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cart-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcart') ?>

    <?= $form->field($model, 'idsiswa') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'nominal') ?>

    <?= $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'user_create') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
