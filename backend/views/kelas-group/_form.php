<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Jurusan;
use backend\models\Kelas;
use backend\models\TahunAjaran;
use yii\helpers\ArrayHelper;
use yii\web\View;
/* @var $model backend\models\KelasGroup */
/* @var $form yii\widgets\ActiveForm */

$root = '@web';
/* @JS */
$this->registerJsFile($root."/vendors/select2/select2.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);


$this->registerJsFile($root."/scripts/forms/plugins.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/scripts/forms/masks.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);


/* @CSS */
$this->registerCssFile($root."/vendors/select2/select2.css");


$this->registerJs("
	function showTahunAjaran(data){				
		$.post('tagihan/tagihan',{
			jurusan: data
		},
		function(data, status){	
			console.log(data);
			$('#tagihan-idajaran').html(data);
		})
	}",View::POS_HEAD
);

?>


<div class="card-block">

	<?php $form = ActiveForm::begin(); ?>

		<?php
			$connection = \Yii::$app->db;
			$sql = $connection->createCommand("SELECT a.idkelas,a.nama_kelas, c.tahun_ajaran, b.nama_jurusan FROM kelas a JOIN jurusan b oN a.idjurusan = b.idjurusan JOIN tahun_ajaran c ON a.idajaran = c.idajaran");
			$modelx = $sql->queryAll();
			
			$data = array();
			foreach ($modelx as $modelxs):
				$data[$modelxs['idkelas']] = $modelxs['nama_kelas'].' - '.$modelxs['tahun_ajaran'] . ' - '. ucfirst($modelxs['nama_jurusan']);
			endforeach;
			
			
		?>
	
		<?= $form->field($model, 'idkelas')->dropDownList($data ,array('prompt'=>'Pilih Kelas...','class'=>'select2 m-b-1','style' => 'width: 100%'))->label('Kelas');	?>		
	
	
		<?= $form->field($model, 'wali_kelas')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'status')->dropDownList(['A' => 'Active', 'I' => 'InActive', ], ['prompt' => '-- Pilih --','style'=>'font-size:12px']) ?>

		<div class="form-group">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
