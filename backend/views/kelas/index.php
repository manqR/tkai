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
");


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

    <div id="list">
        <?php
            foreach($model as $models):
            
            $connection = \Yii::$app->db;
            $sql = $connection->createCommand("SELECT COUNT(*)jml FROM v_kelas_siswa WHERE key_ = '".$models->key_."'");
            $count = $sql->queryOne();
            
            $connection = \Yii::$app->db;
            $sql = $connection->createCommand("SELECT * FROM v_kelas_siswa WHERE key_ = '".$models->key_."' ORDER BY nis DESC LIMIT 5");
            $siswa = $sql->queryAll();
            $ls_siswa='';

            $grd = '';
            $brnch = '';
            foreach($siswa as $siswas):
                $ls_siswa .= '<li>'.$siswas['nama_lengkap'].'</li>';
                $grd = $siswas['kategori'];
                $brnch = $siswas['cabang'];
            endforeach;
                
        ?>       
        
        <div class="row pricing">	
            <div class="col-md-6 col-lg-3">
                <div class="pricing-plan">
                    <h5><?= $models->kode ?> - <?= $grd ?></h5>
                    <i class="material-icons addSiswa" aria-hidden="true" data-toggle="modal" data-id=<?= $models->key_ ?> data-target=".add-siswa">add_circle_outline</i>
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
        </div>
        <?php endforeach; ?>
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
                        TablewithCrud($arrFields);            
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
