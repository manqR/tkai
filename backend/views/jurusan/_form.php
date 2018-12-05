<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $model backend\models\Jurusan */
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
		<?= $form->field($model, 'idjurusan')->textInput(['maxlength' => 10,'class'=>'form-control m-b-1','id'=>'maxlength'])->label('Kode Jurusan') ?>						
			
		<?= $form->field($model, 'nama_jurusan')->textInput(['maxlength' => 50,'class'=>'form-control','id'=>'maxlengthConf'])->label('Nama Jurusan') ?>									
		
		 <div class="form-group">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		</div>
	<?php ActiveForm::end(); ?>
</div>
