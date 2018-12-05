<?php


use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Kelas;
use backend\models\DetailGroup;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\KelasGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas Groups';
$this->params['breadcrumbs'][] = $this->title;

$root = '@web';
/* @JS */
$this->registerJsFile($root."/vendors/select2/select2.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/datatables/media/js/jquery.dataTables.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/datatables/media/js/dataTables.bootstrap4.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/sweetalert/dist/sweetalert.min.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);

$this->registerJsFile($root."/scripts/forms/plugins.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/scripts/forms/masks.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/scripts/ui/alert.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);

;

/* @CSS */
$this->registerCssFile($root."/vendors/select2/select2.css");
$this->registerCssFile($root."/vendors/sweetalert/dist/sweetalert.css");
$this->registerCssFile($root."/vendors/datatables/media/css/dataTables.bootstrap4.css");

$this->registerJs("function myFunction() {
						var id = document.getElementById(\"mySelect\").value;
						var dataString = 'id=' + id.replace('/','');
						$.ajax({
							type: 'GET',
							url: 'kelas-group/apigroup',
							data: dataString,
							cache: false,
							success: function(html) {	
								$('#list').css({\"display\": \"block\"});   							
								$('#lists').css({\"display\": \"none\"});
								$('#list').html(html);     
							}
						});						
					}",View::POS_HEAD
				  );

$this->registerJs("   					 
					$(document).on(\"click\", \".open-AddBookDialog\", function () {								
						var group = $(this).data('id');						
						
						var table = $('.datatable').DataTable({
								'destroy': true,										
								'ajax': './kelas-group/arraydata?id='+group
						});																								
					})
					$(document).on(\"click\", \".addSiswa\", function () {								
						var group = $(this).data('id');
						console.log(group);
						
						var table = $('.datatable').DataTable({
								'destroy': true,										
								'ajax': './kelas-group/listsiswa?id='+group
						});																								
					})
					$(document).on(\"click\", \".tambah\", function () {		
						  var datas = $(this).data('id');
						  swal({
							  title: 'Are you sure?',
							  text: 'Data siswa akan ditambahkan di kelasi ini',
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#DD6B55',
							  confirmButtonText: 'Yes, save it!',
							  closeOnConfirm: false
							}, function() {							
								console.log(datas);
								$.post('kelas-group/postkelas',{
									data: datas
								},
								function(data, status){	
									if(data.err == 'sukses'){										
										var rld = datas.split(';');										
										$('.datatable').DataTable({
											'destroy': true,										
											'ajax': './kelas-group/listsiswa?id='+rld[0]+';'+rld[1]
										
										});		
										swal('Saving!', 'Data Siswa Berhasil ditambahkan', 'success');
									}else{										
										swal('Saving!', 'Data Tidak Berhasil ditambahkan', 'error');
									}
																			
								});
							});
																					
						})
						$(document).on(\"click\", \".kurang\", function () {		
						  var datas = $(this).data('id');
						  swal({
							  title: 'Are you sure?',
							  text: 'Siswa akan dihapus dari kelasi ini',
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#DD6B55',
							  confirmButtonText: 'Ya, Lanjutkan!',
							  closeOnConfirm: false
							}, function() {							
								console.log(datas);
								$.post('kelas-group/deletekelas',{
									data: datas
								},
								function(data, status){	
									if(data.err == 'sukses'){										
										var rld = datas.split(';');										
										$('.datatable').DataTable({
											'destroy': true,										
											'ajax': './kelas-group/arraydata?id='+rld[0]
										
										});		
										swal('Saving!', 'Data Siswa Berhasil dihapus', 'success');
									}else{										
										swal('Saving!', 'Data Tidak Berhasil dihapus', 'error');
									}
																			
								});
							});
																					
						})
				 ");	
 
 $this->registerCss(".addSiswa{cursor: pointer;} .tambah{cursor: pointer;} .kurang{cursor: pointer;}");
?>
<div class="kelas-group-index">
    <p>
        <?= Html::a(' Add Group Class', ['create'], ['class' => 'btn btn-success fa fa-plus']) ?>
        <?= Html::a(' Add Tahun Ajaran', ['create'], ['class' => 'btn btn-success fa fa-plus','data-toggle'=>'modal','data-target'=>'.ajaran']) ?>
    </p>
	
	<div class="center-table">
		<p>
					
			 <div class="m-b">				
				<select data-placeholder="Your Favorite Football Team" class="select2 m-b-1" onchange="myFunction()" id="mySelect" style="width: 100%;">
					<option value="default" selected="selected">-- Tahun Ajaran --</option>
					<?php
						foreach($findTahun as $finds):							
							 echo "<option value=\"$finds->idajaran\">$finds->tahun_ajaran</option>";
						endforeach;
					?>
				</select>
			</div>
			<span>
				<i class="handle"></i>
			</span>
		</p>
	</div>
	
	<div class="row pricing" id="list" style="display:hidden">		
		
	</div>
	
	<div class="row pricing" id="lists">		
		<?php
			
			foreach($model as $models):
				
				$connection = \Yii::$app->db;
				$sql = $connection->createCommand("SELECT COUNT(*) JUMLAH FROM detail_group a JOIN kelas_group b ON a.idgroup = b.idgroup WHERE b.idajaran = ".$models->idajaran." AND a.idgroup = ".$models->idgroup."");
				$count = $sql->queryAll();
			 	
				$connection = \Yii::$app->db;
				$sql = $connection->createCommand("SELECT c.nama_lengkap  FROM detail_group a JOIN kelas_group b ON a.idgroup = b.idgroup JOIN siswa c ON a.idsiswa = c.idsiswa WHERE b.idajaran = ".$models->idajaran." AND a.idgroup = ".$models->idgroup." ORDER BY a.tgl_add DESC LIMIT 5");
				$siswa = $sql->queryAll();
				$ls_siswa='';
				
				foreach($siswa as $siswas):
					$ls_siswa .= '<li>'.$siswas['nama_lengkap'].'</li>';
				endforeach;
				
				 echo '<div class="col-md-6 col-lg-3">
							<div class="pricing-plan">
								<h5>'.$models->kode.' - '.$models->idjurusan.'</h5>
								<i class="material-icons addSiswa" aria-hidden="true" data-toggle="modal" data-id='.$models->idgroup.';'.$models->idajaran.' data-target=".add-siswa">add_circle_outline</i>
								<p class="plan-title text-primary">'.$models->wali_kelas.'</p>
								<div class="plan-price text-primary">
									<span>'.$count[0]['JUMLAH'].'</span>
								</div>
								<ul class="plan-features">									
									'.$ls_siswa.'
								</ul>
								<button class="btn btn-primary btn-lg open-AddBookDialog" data-toggle="modal" data-id='.$models->idgroup.' data-target=".siswa">Lihat Data Siswa</button>
							</div>
						</div>';
			endforeach;					
		?>
	</div>
	
	<!-- ------------ MODAL ------------------>
	<div class="modal fade siswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="max-width: 800px" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Data Siswa</h4>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						 <table class="table table-bordered datatable" style="width:100%">
							<thead>
								<tr>
									<th>
										NIS
									</th>
									<th>
										Nama
									</th>
									<th>
										Janis Kelamin
									</th>
									<th>
										Kelas
									</th>
									<th>
										Jurusan
									</th>
									<th>
										Tahun Ajaran
									</th>
									<th>
										Aksi
									</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>						
				</div>
			</div>
		</div>
	</div>
	<!-- ------------ /MODAL ------------------>
	
	<!-- ------------ MODAL ADD SISWA------------------>
	<div class="modal fade add-siswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="max-width: 800px" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Tambah Siswa</h4>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						 <table class="table table-bordered datatable" style="width:100%">
							<thead>
								<tr>
									<th>
										NIS
									</th>
									<th>
										Nama
									</th>
									<th>
										Janis Kelamin
									</th>
									<th>
										Tempat Lahir
									</th>
									<th>
										Tanggal Lahir
									</th>
									<th>
										Aksi
									</th>

								</tr>
							</thead>
						</table>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>						
				</div>
			</div>
		</div>
	</div>
	<!-- ------------ /MODAL ADD SISWA ------------------>
	
	
	
	<!-- ------------ MODAL TAHUN AJARAN ------------------>
	<div class="modal fade ajaran" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="max-width: 800px" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Data Siswa</h4>
				</div>
				<?php $form = ActiveForm::begin(); ?>
				<div class="modal-body">
					
					<?= $form->field($newModel, 'idajaran')->textInput(['maxlength' => true,'id'=>'thnajaran'])->label('Tahun Ajaran') ?>
					<?= $form->field($newModel, 'status')-> dropDownList(['1'=>'Aktif','0'=>'Tidak Aktif'],
						['prompt'=>'Choose Class...','style' => 'font-size: 12px','id'=>'status'])->label('Status');  ?>
									
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary submitAjaran" data-dismiss="modal">Submit</button>						
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
	<!-- ------------ /MODAL TAHUN AJARAN ------------------>
	
</div>

<?php
	$this->registerJs('$(".submitAjaran").click(function(){
							swal({
							  title: "Are you sure?",
							  text: "You will not be able to recover this imaginary file!",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonColor: "#DD6B55",
							  confirmButtonText: "Yes, save it!",
							  closeOnConfirm: false
							}, function() {
								var ajaran = $("#thnajaran").val();
								var status = $("#status").val();
									console.log(ajaran);
									$.post("kelas-group/postdata",{
										ajaran: ajaran,	
										status: status
									},
									function(data, status){		
										swal("Saving!", "Data Tahun Ajaran Berhasil disimpan", "success");
									});
							});
	
											
							});'
						);

?>
