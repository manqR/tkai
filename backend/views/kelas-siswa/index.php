<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KelasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    function myFunction() {
        var id = document.getElementById(\"mySelect\").value;
        var grade = document.getElementById(\"GradeSelect\").value;
        var dataString = 'id=' + id + '&grade='+ grade;
        $.ajax({
            type: 'GET',
            url: 'api/kelas-siswa',
            data: dataString,
            cache: false,
            success: function(html) {	
                $('#list').html(html);     
            }
        });						
    }",View::POS_HEAD
);


$this->registerJs("
    $(document).on(\"click\", \".open-AddBookDialog\", function () {		
        var key_ = $(this).data('id');
        tableShow('.datatable','./api/siswa-list?key_='+key_);
    });
    $(document).on(\"click\", \".addSiswa\", function () {		
        var key_ = $(this).data('id');
        tableShow('.datatable','./api/siswa-list-add?key_='+key_);
    });

    $(document).on(\"click\", \".tambah\", function () {		
        var datas = $(this).data('id');
        swal({
            title: 'Anda Yakin?',
            text: 'Data siswa akan ditambahkan di kelasi ini',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, save it!',
            closeOnConfirm: false
          }, function() {							
              console.log(datas);
              $.post('api/add-siswa',{
                  data: datas
              },
              function(data, status){	
                  if(data.err == 'sukses'){	
                        var key_ = datas.split(';');				
                        tableShow('.datatable','./api/siswa-list-add?key_='+key_[1]);   
                        myFunction();		                    
                      swal('Saving!', 'Data Siswa Berhasil ditambahkan', 'success');
                  }else{		
                      console.log(data)								
                      swal('Saving!', 'Data Tidak Berhasil ditambahkan', 'error');
                  }
                                                          
              });
          });
                                                                  
    })
    
    $(document).on(\"click\", \".kurang\", function () {		
        var datas = $(this).data('id');
        swal({
            title: 'Anda Yakin?',
            text: 'Siswa akan dihapus dari kelasi ini',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Ya, Lanjutkan!',
            closeOnConfirm: false
          }, function() {							
              console.log(datas);
              $.post('api/delete-siswa',{
                  data: datas
              },
              function(data, status){	
                  if(data.err == 'sukses'){										
                     var key_ = datas.split(';');				
                     tableShow('.datatable','./api/siswa-list?key_='+key_[1]);   		          									
                     myFunction();
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
<div class="kelas-index">

    <p>
        <!-- GRADE -->
        <select data-placeholder="Grade .." class="select2 m-b-1" onchange="myFunction()" id="GradeSelect" style="width: 25%;float:right">
			
			<?php
               
                echo '<option value="0" selected="selected">-- Grade All --</option>';
				foreach($grade as $grades):							
					 echo "<option value=\"$grades->idkategori\">$grades->keterangan</option>";
                endforeach;
                
               
			?>
		</select>
        <!-- END GRADE -->
        
        <!-- BRANCH -->
        <select data-placeholder="Branch .." class="select2 m-b-1" onchange="myFunction()" id="mySelect" style="width: 25%;float:right">
			
			<?php
                $option = '';
                $class = '';
                if($count > 1){
                    $option = '<option value="0" selected="selected">-- All Branch --</option>';
                }else{
                    $class = 'selected="selected"';
                }
                echo $option;
				foreach($cabang as $cabangs):							
					 echo "<option ".$class." value=\"$cabangs->idcabang\">$cabangs->keterangan</option>";
                endforeach;
                
               
			?>
		</select>
       <!-- END BRANCH -->
    </p>
    <br/>
    <br/>
    <div class="row pricing">	
        <div id="list">
       
            <?php
                foreach($model as $models):
                
                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT COUNT(*)jml FROM v_kelas_siswa WHERE key_ = '".$models->key_."'");
                $count = $sql->queryOne();
                
                $connection = \Yii::$app->db;
                $query = $connection->createCommand("SELECT (SELECT keterangan FROM kategori where idkategori = ".$models->idkategori.") grade, (SELECT keterangan FROM cabang WHERE idcabang = ".$models->idcabang.") `cabang`");
                $result = $query->queryOne();

                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT * FROM v_kelas_siswa WHERE key_ = '".$models->key_."' ORDER BY nis DESC LIMIT 5");
                $siswa = $sql->queryAll();
                $ls_siswa='';

                foreach($siswa as $siswas):
                    $ls_siswa .= '<li>'.$siswas['nama_lengkap'].'</li>';                  
                endforeach;
                $grd = $result['grade'];
                $brnch = $result['cabang'];
                    
            ?>       
            
            
            <div class="col-md-6 col-lg-3">
                <div class="pricing-plan">
                    <h5><?= $models->kode ?> - <?= $grd ?></h5>
                    <i class="material-icons addSiswa" aria-hidden="true" title="tambah siswa" data-toggle="modal" data-id=<?= $models->key_ ?> data-target=".add-siswa">add_circle_outline</i>
                    <a class="material-icons" href="kelassiswa-export-<?= $models->key_ ?>">import_export</a>
                    <p class="plan-title text-primary"><?= $models->wali_kelas?> <br/><?= $brnch  ?></p>
                    <div class="plan-price text-primary">
                        <span><?= $count['jml'] ?></span>
                    </div>
                    <ul class="plan-features">									
                        <?= $ls_siswa ?>
                    </ul>
                    <button class="btn btn-primary btn-lg open-AddBookDialog" data-toggle="modal" data-id=<?= $models->key_ ?> data-target=".siswa">Lihat Data Siswa</button>
                </div>
            </div>
           
            <?php endforeach; ?>
        </div>
    </div>

    <!-------------- MODAL ------------------>
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
                    <?php
                        TablewithCrud($arrFieldsAksi);            
                    ?>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>						
				</div>
			</div>
		</div>
	</div>
	<!-- ------------ /MODAL ------------------>

    <!-------------- MODAL ------------------>
	<div class="modal fade add-siswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="max-width: 800px" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Data Siswa</h4>
				</div>
				<div class="modal-body">
                    <?php
                        TablewithCrud($arrFieldsAksi);            
                    ?>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>						
				</div>
			</div>
		</div>
	</div>
	<!-- ------------ /MODAL ------------------>

</div>
