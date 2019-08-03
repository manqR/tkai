<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Cabang;
use backend\models\Role;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form card card-block">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role', ['options' => ['tag' => 'false']])-> dropDownList(
        ArrayHelper::map(Role::find()->all(),'idrole','role'),
        ['prompt'=>'- Select -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Role');  
    ?>    
    <?= $form->field($model, 'cabang', ['options' => ['tag' => 'false']])-> dropDownList(
        ArrayHelper::map(Cabang::find()->all(),'idcabang','keterangan'),
        ['prompt'=>'- Select -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Cabang');  
    ?>

    <?php
        if($model->isNewRecord){

        
    ?>
    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true])->label('Password') ?>
        <?php }?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
