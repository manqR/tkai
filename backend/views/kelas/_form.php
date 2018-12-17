<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use backend\models\Kategori;
use backend\models\Cabang;
use backend\models\TahunAjaran;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idkategori', ['options' => ['tag' => 'false']])-> dropDownList(
			ArrayHelper::map(Kategori::find()->all(),'idkategori','keterangan'),
			['prompt'=>'- Pilih -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Grade');  ?>					
	
	<?= $form->field($model, 'idcabang', ['options' => ['tag' => 'false']])-> dropDownList(
			ArrayHelper::map(Cabang::find()->all(),'idcabang','keterangan'),
			['prompt'=>'- Pilih -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Cabang');  ?>	

	<?= $form->field($model, 'tahun_ajaran', ['options' => ['tag' => 'false']])-> dropDownList(
			ArrayHelper::map(TahunAjaran::find()->where(['flag'=>1])->all(),'tahun_ajaran','tahun_ajaran'),
			['prompt'=>'- Pilih -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Tahun Ajaran');  ?>					


    <?= $form->field($model, 'wali_kelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag')->dropDownList(['1' => 'Aktif', '0' => 'Tidak Aktif'])->label('Status'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
