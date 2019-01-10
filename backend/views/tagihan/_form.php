<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\helpers\ArrayHelper;

/* @var $model backend\models\Tagihan */
/* @var $form yii\widgets\ActiveForm */

use backend\models\TahunAjaran;

$root = '@web';
$this->registerJsFile($root."/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/scripts/forms/masks.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);

?>

<div class="tagihan-form">

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div>
            <div class="alert alert-danger">Simpan Gagal ! Data Sudah pernah ada</div>
            <!-- <?= Yii::$app->session->getFlash('error') ?> -->
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idtagihan')->textInput(['maxlength' => true,'value'=>$kode,'readonly'=>true])->label('No Tagihan') ?>
           
        <!-- BRANCH -->
        <label>Cabang</label>
        <select data-placeholder="Branch .." class="select2 m-b-1" id="mySelect" name="branchSelect" style="width: 100%;">
			
			<?php                
                $class = '';                
                $option = '<option value="0" selected="selected">-- Pilih --</option>';                
                $class = 'selected="selected"';                
                
				foreach($cabang as $cabangs):							
					 echo "<option ".$class." value=".$cabangs['idcabang'].">".$cabangs['keterangan']."</option>";
                endforeach;
                
               
			?>
		</select>
       <!-- END BRANCH -->

         <!-- GRADE -->
    <label>Grade</label>
     <select data-placeholder="Grade .." class="select2 m-b-1" id="GradeSelect" name="GradeSelect" style="width: 100%;">
			
			<?php
               
                echo '<option value="0" selected="selected">-- Pilih --</option>';
				foreach($grade as $grades):							
					 echo "<option value=\"$grades->idkategori\">$grades->keterangan</option>";
                endforeach;
                
               
			?>
		</select>
        <!-- END GRADE -->

        <?= $form->field($model, 'tahun_ajaran', ['options' => ['tag' => 'false']])-> dropDownList(
			ArrayHelper::map(TahunAjaran::find()->where(['flag'=>1])->all(),'tahun_ajaran','tahun_ajaran'),
			['prompt'=>'- Pilih -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Tahun Ajaran');  ?>	

    <?= $form->field($model, 'seragam')->textInput(['onkeyup' => 'js:formatAsRupiah(this);' ]) ?>
    <?= $form->field($model, 'peralatan')->textInput(['onkeyup' => 'js:formatAsRupiah(this);' ]) ?>
    <?= $form->field($model, 'uang_pangkal')->textInput(['onkeyup' => 'js:formatAsRupiah(this);' ]) ?>
    <?= $form->field($model, 'uang_bangunan')->textInput(['onkeyup' => 'js:formatAsRupiah(this);' ]) ?>
    <?= $form->field($model, 'material')->textInput(['onkeyup' => 'js:formatAsRupiah(this);' ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("
				
	function formatRupiah(angka, prefix){
		var number_string = angka.value.replace(/[^,\d]/g, '').toString(),
			split    = number_string.split(','),
			sisa     = split[0].length % 3,
			rupiah     = split[0].substr(0, sisa),
			ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	
	function formatAsRupiah(el) {
		
		el.value = formatRupiah(el);					
	}",
View::POS_HEAD);					

?>                