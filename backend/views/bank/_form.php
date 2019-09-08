<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Bank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-form card card-block">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'flag')->dropDownList(['1' => 'Aktif', '0' => 'Tidak Aktif'])->label('Status'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
