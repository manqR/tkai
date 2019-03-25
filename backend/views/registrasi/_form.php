<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;
use backend\models\Cabang;
use backend\models\Kategori;
use backend\models\Agama;

/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs("
$(document).ready(function() {
    $(\".datepicker\").datepicker({ 
        format: 'yyyy-mm-dd'
    });
});
");

?>

<div class="siswa-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-block">
                <h5> Informasi Umum </h5>  
                <?= $form->field($model, 'no_registrasi')->textInput(['value'=>($model->isNewRecord) ? $kode : $model->no_registrasi, 'readonly'=>true]) ?>
                <?= $form->field($model, 'idcabang', ['options' => ['tag' => 'false']])-> dropDownList(
                    ArrayHelper::map(Cabang::find()->all(),'idcabang','keterangan'),
                    ['prompt'=>'- Select -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Cabang');  
                ?>
                <?= $form->field($model, 'idkategori', ['options' => ['tag' => 'false']])-> dropDownList(
                    ArrayHelper::map(Kategori::find()->all(),'idkategori','keterangan'),
                    ['prompt'=>'- Select -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Grade');  
                ?>
                <?= $form->field($model, 'biaya_registrasi')->textInput() ?>
            </div>
            <div class="card card-block">
                <h4> Informasi Siswa </h4>  
                <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'nama_panggilan')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'jenis_kelamin', ['options' => ['tag' => 'false']])-> dropDownList(['L'=>'Laki-Laki','P'=>'Perempuan'],
                    ['prompt'=>'- Select -','class'=>'select2 m-b-1','style' => 'width: 100%']);  
                ?>
                <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true,'style'=>'width:40%'])->label('Tempat & Tanggal Lahir') ?>
                <?= $form->field($model, 'tanggal_lahir', ['options' => ['tag' => 'false']])->textInput(['class'=>'form-control m-b-1 datepicker','data-provide'=>'datepicker','style'=>'display: inline-block;width: 55%;position: absolute;height: 39px;right: 15px;top: 316px;'])->label(false) ?>   
                
                <?= $form->field($model, 'agama', ['options' => ['tag' => 'false']])-> dropDownList(
                    ArrayHelper::map(Agama::find()->all(),'keterangan','keterangan'),
                    ['prompt'=>'- Select -','class'=>'select2 m-b-1','style' => 'width: 100%']);  
                ?>
                <?= $form->field($model, 'alamat')->textArea(['rows' => 5]) ?>
                
            </div>
        </div>

                
        <div class="col-md-6">
            <div class="card card-block">
                <h5>Data Orang Tua</h5>
                
                <?= $form->field($model, 'nama_ayah')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'pekerjaan_ayah')->textArea(['rows' => 2]) ?>
                <?= $form->field($model, 'nama_ibu')->textInput(['maxlength' => true]) ?>           
                <?= $form->field($model, 'pekerjaan_ibu')->textArea(['rows' => 2]) ?>
                <?= $form->field($model, 'tlp')->textInput(['maxlength' => true]) ?>             
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                
            </div>
            <div class="card card-block">
                <h5>Data Orang Dekat yang Dapat dihubungi</h5>
                
                <?= $form->field($model, 'nama_darurat')->textInput(['maxlength' => true])->label('Nama') ?>   
                <?= $form->field($model, 'tlp_darurat')->textInput(['maxlength' => true]) ?>            
                <?= $form->field($model, 'status_hubungan')->textInput(['maxlength' => true])->label('Hubungan') ?>
                
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
