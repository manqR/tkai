<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PencatatanKeuangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-block">

    <?php $form = ActiveForm::begin(); ?>
    

    
    <?= $form->field($model, 'kategori')->dropDownList(['pengeluaran' => 'Pengeluaran', 'pemasukan' => 'Pemasukan']); ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
