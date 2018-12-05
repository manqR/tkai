<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\TahunAjaran;
use backend\models\Jurusan;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $model backend\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
/* @ROOT */
$root = '@web';
/* @JS */
$this->registerJsFile($root."/vendors/select2/select2.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/bootstrap-maxlength/src/bootstrap-maxlength.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);

$this->registerJsFile($root."/scripts/forms/plugins.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);


/* @CSS */
$this->registerCssFile($root."/vendors/select2/select2.css");

?>

<div class="card-block">
	<?php $form = ActiveForm::begin(); ?>	
		<?= $form->field($model, 'kode')->textInput(['maxlength' => 10,'class'=>'form-control m-b-1','id'=>'maxlength'])->label('Kode Kelas') ?>						
		
		<?= $form->field($model, 'idajaran', ['options' => ['tag' => 'false']])-> dropDownList(
				ArrayHelper::map(TahunAjaran::find()->all(),'idajaran','tahun_ajaran'),
				['prompt'=>'- Pilih -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Tahun Ajaran');  ?>					
		
		<?= $form->field($model, 'idjurusan', ['options' => ['tag' => 'false']])-> dropDownList(
				ArrayHelper::map(Jurusan::find()->all(),'idjurusan','nama_jurusan'),
				['prompt'=>'- Pilih -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Jurusan');  ?>					

		<?= $form->field($model, 'nama_kelas')->textInput(['maxlength' => 50,'class'=>'form-control','id'=>'maxlengthConf'])->label('Nama Kelas') ?>							
		<?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Non-Active']); ?>
		
		 <div class="form-group">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		</div>
	<?php ActiveForm::end(); ?>
</div>

