<?php

namespace backend\controllers;

use Yii;
use backend\models\TagihanSiswa;
use backend\models\TagihanSiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Siswa;
use backend\models\SppSiswa;
use backend\models\BiayaTidakTetap; 
use backend\models\TagihanBiayaTidaktetap; 
use yii\web\Response;
use Mpdf\Mpdf;
// use mPDF\mPDF;


/**
 * TagihanSiswaController implements the CRUD actions for TagihanSiswa model.
 */
class TagihanSiswaController extends Controller
{
    /**
     * @inheritdoc
     */

	public static function allowedDomains(){
		return [
			'*',				
		];
	}
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
		];
		return array_merge(parent::behaviors(), [
			'corsFilter'  => [
				'class' => \yii\filters\Cors::className(),
				'cors'  => [					
					'Origin'                           => static::allowedDomains(),					
					'Access-Control-Allow-Credentials' => true,
					'Access-Control-Max-Age'           => 3600,    
				],
			],

		]);
    }

    /**
     * Lists all TagihanSiswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagihanSiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model = Siswa::find()
				->All();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $model
        ]);
    }

    /**
     * Displays a single TagihanSiswa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	 
	
	public function actionListsiswa($id){
		
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT * FROM siswa WHERE nama_lengkap LIKE '%".$id."%' OR idsiswa LIKE '%".$id."%'");
		$models = $sql->queryAll();
		
		
		foreach($models as $model):			 	
		
				
			 echo '<a href="javascript:;" onclick="return showDetail('.$model['idsiswa'].');" class="column-equal" data-toggle="contact">
					<div class="col v-align-middle contact-avatar">
						<div class="circle-icon bg-danger">'.substr(strtoupper($model['nama_lengkap']),0,1).'</div>
					</div>
					<div class="col v-align-middle contact-details p-l-1">
						<span class="bold">'.$model['nama_lengkap'].'</span>
						<span class="small">'.$model['idsiswa'].'</span>
					</div>
				</a>';		
		endforeach;		
	}
	
	
	public function actionDetailsiswa($id){
		
		function rupiah($num){
			return number_format($num, 0,'.','.');
		}
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT SUM(e.administrasi + e.pengembangan + e.praktik) TAGIHAN_BIL_OPTION,
										 (SELECT IFNULL(SUM(xx.besaran),0) FROM tagihan_siswa xx WHERE xx.idsiswa = b.idsiswa AND xx.idgroup = c.idgroup AND xx.nama_tagihan IN ('administrasi','pengembangan','praktik')) BillingOption,		 
										  SUM(e.semester_a + e.semester_b + e.lab_inggris + e.lks + e.perpustakaan + e.osis + e.mpls + e.asuransi) TAGIHAN_FIX_CHARGE,		 
										 (SELECT IFNULL(SUM(yy.besaran),0) FROM tagihan_siswa yy WHERE yy.idsiswa = b.idsiswa AND yy.idgroup = c.idgroup AND yy.nama_tagihan IN ('semester_a','semester_b','lab_inggris','lks','perpustakaan','osis','mpls','asuransi'))  FixCharge,
										 (SELECT SUM(x.besaran) FROM spp x WHERE x.idtagihan = e.idtagihan) TAGIHAN_SPP,
										 IFNULL((SELECT SUM(z.besaran) FROM spp_siswa z WHERE z.idsiswa = b.idsiswa AND z.idgroup = c.idgroup),0)  SPP 
									FROM siswa a JOIN 
										 detail_group b ON a.idsiswa = b.idsiswa JOIN
										 kelas_group c ON b.idgroup = c.idgroup JOIN
										 kelas d ON c.idkelas = d.idkelas JOIN
										 tagihan e ON d.idkelas = e.idkelas AND d.idjurusan = e.idjurusan
									WHERE a.idsiswa = '".$id."' 
									GROUP BY b.idgroup
									ORDER BY b.id DESC LIMIT 1 ");
		$models = $sql->queryAll();
		
		$status_SPP='complete';
		$status_FIX = 'complete';
		$status_OPT = 'complete';
		$class_SPP = 'success';
		$class_FIX = 'success';
		$class_OPT = 'success';
		
		if(isset($models[0]['SPP'])){
			if($models[0]['SPP'] - $models[0]['TAGIHAN_SPP'] != 0){
				$status_SPP = 'incomplete';
				$class_SPP = 'danger';
			}
			if($models[0]['FixCharge'] - $models[0]['TAGIHAN_FIX_CHARGE'] != 0){
				$status_FIX = 'incomplete';
				$class_FIX = 'danger';
			}
			if($models[0]['BillingOption'] - $models[0]['TAGIHAN_BIL_OPTION'] != 0){
				$status_OPT = 'incomplete';
				$class_OPT = 'danger';
			}
			
			echo'<div class="row">
					<div class="col-sm-6 col-md-4 col-lg-4">
						<div class="card card-block">
							<h5 class="m-b-0 v-align-middle text-overflow">					
								<span class="small pull-xs-right tag bg-'.$class_SPP.' p-y-0 p-x-xs"  id="show1" data-toggle="modal" data-target=".bd-example-modal"  style="line-height: 24px;">
									<span >'.$status_SPP.'</span>
								</span>
								<span style="font-size: 9px;font-weight: bold;">'.rupiah($models[0]['SPP']).'</span>/
								<span style="font-size: 11px;font-weight: bold;">'.rupiah($models[0]['TAGIHAN_SPP']).'</span>							
							</h5>
							<div class="small text-overflow text-muted">
								SPP
							</div>
							<div class="small text-overflow">
								Updated:&nbsp;<span>05:35 AM</span>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<div class="card card-block">
							<h5 class="m-b-0 v-align-middle text-overflow">
								<span class="small pull-xs-right tag bg-'.$class_FIX.' p-y-0 p-x-xs" id="show2" data-toggle="modal" data-target=".fix" style="line-height: 24px;">
									<span >'.$status_FIX.'</span>
								</span>
								<span style="font-size: 9px;font-weight: bold;">'.rupiah($models[0]['FixCharge']).'</span>/
								<span style="font-size: 11px;font-weight: bold;">'.rupiah($models[0]['TAGIHAN_FIX_CHARGE']).'</span>							
							</h5>
							<div class="small text-overflow text-muted">
								FIX CHARGE
							</div>
							<div class="small text-overflow">
								Updated:&nbsp;<span>12:42 PM</span>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<div class="card card-block">
							<h5 class="m-b-0 v-align-middle text-overflow">
								<span class="small pull-xs-right tag bg-'.$class_OPT.' p-y-0 p-x-xs" id="show3" data-toggle="modal" data-target=".optional" style="line-height: 24px;">
								<span >'.$status_OPT.'</span>
								</span>
								<span style="font-size: 9px;font-weight: bold;">'.rupiah($models[0]['BillingOption']).'</span>/
								<span style="font-size: 11px;font-weight: bold;">'.rupiah($models[0]['TAGIHAN_BIL_OPTION']).'</span>							
							</h5>
							<div class="small text-overflow text-muted">
								Optional Billing
							</div>
							<div class="small text-overflow">
								Updated:&nbsp;<span>09:26 AM</span>
							</div>
						</div>
					</div>										
				</div>';
		}else{
				
			echo ' <div class="column-equal m-b-2">
					
					<div class="col v-align-middle p-l-2">
						<h3>
							<b>Data Belum Tersedia ..</b>                        
						</h3>						
					</div>
				</div>';
		}
	}
	
	public function actionSpplist($id){
	
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT d.bulan, d.besaran, IFNULL(e.besaran,0) sudah_dibayar, a.idgroup, a.idsiswa
											FROM detail_group a 
												JOIN kelas_group b ON a.idgroup = b.idgroup 
												JOIN kelas f ON b.idkelas = f.idkelas
												JOIN tagihan c ON b.idkelas = c.idkelas AND f.idjurusan = c.idjurusan
												JOIN spp d ON d.idtagihan = c.idtagihan
												LEFT JOIN spp_siswa e ON e.idsiswa = a.idsiswa AND e.idgroup = a.idgroup AND e.bulan = d.bulan
												LEFT JOIN months g ON d.bulan = g.namabulan
											WHERE a.idsiswa = '".$id."' AND a.id = (SELECT x.id FROM detail_group x WHERE x.idsiswa = '".$id."' ORDER BY x.id DESC LIMIT 1)
												  AND g.urutan <= (SELECT urutan FROM months WHERE idbulan = MONTH(now())) AND  IFNULL(e.besaran,0) <= 0 ");
		$models = $sql->queryAll();	
		
		foreach($models as $model):
			$class='';
			if(($model['sudah_dibayar'] - $model['besaran']) >= 0){
				$class = '<span class="tag tag-success">Lunas</span>'; 								
			}else{
				$class='<input type="text" class="form-control" id="biaya" style="display: inline-block;width: 90%;">
						<input type="hidden" id="bulan" value='.$model['bulan'].' />
						<input type="hidden" id="group" value='.$model['idgroup'].' />
						<input type="hidden" id="idsiswa" value='.$model['idsiswa'].'>
						<i class="material-icons add_bill" aria-hidden="true" style="position: absolute;margin-top: 7px;">add_box</i>';
			}
			echo '<tr>
					<td>'.$model['bulan'].'</td>
					<td>'.$model['besaran'].'</td>
					<td>'.$model['sudah_dibayar'].'</td>
					<td> '.$class.'</td>
				</tr>';
		endforeach;	
	
	}
	
	public function actionFixlist($id){
		
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT a.idsiswa, a.idgroup, c.idjurusan, c.idkelas 
										   FROM detail_group a 
										   	JOIN kelas_group b ON a.idgroup = b.idgroup 
											JOIN kelas c ON b.idkelas = c.idkelas
										   WHERE a.idsiswa = '".$id."' ORDER BY id DESC LIMIT 1");
		$model = $sql->queryAll();
		
		
		
		
		

		$query = $connection->createCommand("SELECT keterangan, nama_tagihan,
													(CASE WHEN keterangan = 'Semester Ganjil' 	THEN semester_a 
														WHEN keterangan = 'Semester Genap'  	THEN semester_b
															WHEN keterangan = 'Perpustakaan' 	THEN perpustakaan 
															WHEN keterangan = 'Osis'			THEN osis
															WHEN keterangan = 'MPLS'			THEN mpls
															WHEN keterangan = 'LKS'				THEN lks
															WHEN keterangan = 'Lab Bhs Inggis'	THEN lab_inggris
															WHEN keterangan = 'Asuransi'		THEN asuransi
														ELSE 0 END) Biaya,
														urutan 
											FROM (
												SELECT 'Semester Ganjil' keterangan ,'semester_a' nama_tagihan, semester_a,semester_b, lab_inggris, lks, perpustakaan, osis, mpls, asuransi , 1 urutan FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
												UNION ALL
												SELECT 'Semester Genap' keterangan, 'semester_b' nama_tagihan, semester_a,semester_b, lab_inggris, lks, perpustakaan, osis, mpls, asuransi , 2 urutan FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
												UNION ALL
												SELECT 'Lab Bhs Inggis' keterangan, 'lab_inggris' nama_tagihan , semester_a,semester_b, lab_inggris, lks, perpustakaan, osis, mpls, asuransi , 3 urutan  FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
												UNION ALL
												SELECT 'LKS' keterangan, 'lks' nama_tagihan ,semester_a,semester_b, lab_inggris, lks, perpustakaan, osis, mpls, asuransi , 4 urutan  FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
												UNION ALL
												SELECT 'Perpustakaan' keterangan, 'perpustakaan' nama_tagihan , semester_a, semester_b, lab_inggris, lks, perpustakaan, osis, mpls, asuransi , 5 urutan  FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
												UNION ALL
												SELECT 'Osis' keterangan,semester_a, 'osis' nama_tagihan, semester_b, lab_inggris, lks, perpustakaan, osis, mpls, asuransi , 6 urutan FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
												UNION ALL
												SELECT 'MPLS' keterangan,semester_a, 'mpls' nama_tagihan  ,semester_b, lab_inggris, lks, perpustakaan, osis, mpls, asuransi, 7 urutan  FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
												UNION ALL
												SELECT 'Asuransi' keterangan, 'asuransi' nama_tagihan, semester_a,semester_b, lab_inggris, lks, perpustakaan, osis, mpls, asuransi , 8 urutan FROM tagihan	 WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
											)src
											GROUP BY keterangan
											ORDER BY urutan ");
		$data = $query->queryAll();



		foreach($data as $datas):

			$pay = $connection->createCommand("SELECT IFNULL(besaran,0)besaran FROM tagihan_siswa x WHERE x.idsiswa = '".$model[0]['idsiswa']."' AND x.idgroup = '".$model[0]['idgroup']."' AND x.nama_tagihan = '".$datas['nama_tagihan']."'");
			$modelPay = $pay->queryAll();
			
			$xx=0;
			if($modelPay){
				$xx = $modelPay[0]['besaran'];
			}else{
				$xx;
			}
			// var_dump($xx);
			$sisa_pembayaran = $xx;
			$class = '';
			if($sisa_pembayaran - $datas['Biaya']  >= 0){
				$class = '<span class="tag tag-success">Lunas</span>'; 								
			}else{						

				$class='<input type="text" class="form-control" id="bayar" style="display: inline-block;width: 90%;">
					<input type="hidden" id="group" value='.$model[0]['idgroup'].' />
					<input type="hidden" id="idsiswa" value='.$model[0]['idsiswa'].'>
					<input type="hidden" id="keterangan" value="'.$datas['keterangan'].'">
					<input type="hidden" id="nama_tagihan" value="'.$datas['nama_tagihan'].'">
					<i class="material-icons add_fix" aria-hidden="true" style="position: absolute;margin-top: 7px;">add_box</i>';
			}
			echo '<tr>
					<td>'.$datas['keterangan'].'</td>
					<td>'.$datas['Biaya'].'</td>
					<td>0</td>
					<td> '.$class.'</td>
				</tr>';			
		endforeach;


	}
	public function actionOptionlist($id){
		
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT a.idsiswa, a.idgroup, c.idjurusan, c.idkelas 
										   FROM detail_group a 
										   JOIN kelas_group b ON a.idgroup = b.idgroup
										   JOIN kelas c ON b.idkelas = c.idkelas 
										   WHERE a.idsiswa = '".$id."' ORDER BY id DESC LIMIT 1");
		$model = $sql->queryAll();
						
		$query = $connection->createCommand("SELECT keterangan, nama_tagihan,
													(CASE WHEN keterangan = 'Administrasi' THEN administrasi 
														WHEN keterangan = 'Pengembangan'  THEN pengembangan
															WHEN keterangan = 'Praktek' 	THEN praktik 			
														ELSE 0 END) Biaya,
														urutan 
											FROM (
												SELECT 'Administrasi' keterangan ,  'administrasi' nama_tagihan, administrasi,pengembangan, praktik, 1 urutan FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
												UNION ALL
												SELECT 'Pengembangan' keterangan , 'pengembangan' nama_tagihan, administrasi,pengembangan, praktik, 2 urutan FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'
												UNION ALL
												SELECT 'Praktek' keterangan, 'praktik' nama_tagihan, administrasi,pengembangan, praktik, 3 urutan  FROM tagihan WHERE idkelas = '".$model[0]['idkelas']."' AND idjurusan = '".$model[0]['idjurusan']."'

											)src
											GROUP BY keterangan
											ORDER BY urutan ");
		$data = $query->queryAll();

		$ls = '';
		foreach($data as $datas):

			$pay = $connection->createCommand("SELECT IFNULL(besaran,0)besaran FROM tagihan_siswa x WHERE x.idsiswa = '".$model[0]['idsiswa']."' AND x.idgroup = '".$model[0]['idgroup']."' AND x.nama_tagihan = '".$datas['nama_tagihan']."'");
			$modelPay = $pay->queryAll();
			
			$xx=0;
			if($modelPay){
				$xx = $modelPay[0]['besaran'];
			}else{
				$xx;
			}
			// var_dump($xx);
			$sisa_pembayaran = $xx;
			$class = '';
			if($sisa_pembayaran - $datas['Biaya']  >= 0){
				$class = '<span class="tag tag-success">Lunas</span>'; 								
			}else{						

				$class='<input type="text" class="form-control" id="biayax" style="display: inline-block;width: 90%;">
					<input type="hidden" id="groupx" value='.$model[0]['idgroup'].' />
					<input type="hidden" id="idsiswax" value='.$model[0]['idsiswa'].'>
					<input type="hidden" id="keteranganx" value="'.$datas['keterangan'].'">
					<input type="hidden" id="nama_tagihanx" value="'.$datas['nama_tagihan'].'">
					<i class="material-icons add_option" aria-hidden="true" style="position: absolute;margin-top: 7px;">add_box</i>';
			}
			echo '<tr>
					<td>'.$datas['keterangan'].'</td>
					<td>'.$datas['Biaya'].'</td>
					<td>0</td>
					<td> '.$class.'</td>
				</tr>';			
				
				
		endforeach;


	}
	public function actionProfiledetail($id){
		
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT * 
											FROM detail_group a 
												  JOIN siswa b ON a.idsiswa = b.idsiswa
												  JOIN kelas_group c ON a.idgroup = c.idgroup
												  JOIN kelas d ON c.idkelas = d.idkelas
											WHERE b.idsiswa = '".$id."' ORDER BY a.id DESC LIMIT 1
										");
		$models = $sql->queryAll();
		
		
		if($models){
		
		echo ' <div class="column-equal m-b-2">
					<div class="col" style="width:128px;">
						<img src="images/face1.jpg" class="avatar avatar-lg img-circle" alt="">
					</div>
					<div class="col v-align-middle p-l-2">
						<h1>
							<b>'.$models[0]['nama_lengkap'].'</b> <i class="material-icons addbiaya" title="Assign Biaya Tidak Tetap" aria-hidden="true" id="addbiaya" style="color:red" data-toggle="modal" data-id='.$models[0]['idsiswa'].' data-target=".add-biaya">open_in_new</i>
						</h1>
						<h3>'.$models[0]['wali_kelas'].'</h3>
					</div>
				</div>
            <div class="column-equal m-b-2">
                <div class="col p-l-2 text-xs-right" style="width:128px;">
                    <span class="text-muted">Kelas</span>
                </div>
                <div class="col p-l-2">
					<span>'.$models[0]['idjurusan'].'</span>
                    
                </div>
            </div>
            <div class="column-equal m-b-2">
                <div class="col p-l-2 text-xs-right" style="width:128px;">
                    <span class="text-muted">
                    Kelas
                    </span>
                </div>
                <div class="col p-l-2">
                    <span>
						'.$models[0]['idkelas'].'
                    </span>
                </div>
            </div>
            <div class="column-equal m-b-2">
                <div class="col p-l-2 text-xs-right" style="width:128px;">
                    <span class="text-muted">
                    Email
                    </span>
                </div>
                <div class="col p-l-2">
                   <a ng-href="'.$models[0]['email'].'" href="'.$models[0]['email'].'">
                    '.$models[0]['email'].'
                    </a>
                </div>
            </div>
            <div class="column-equal m-b-2">
                <div class="col p-l-2 text-xs-right" style="width:128px;">
                    <span class="text-muted">
                    Handphone
                    </span>
                </div>
                <div class="col p-l-2">
                    <span>
                    '.$models[0]['hp'].'
                    </span>
                </div>
            </div>';
		}else{
			echo ' ';
		}
			
	}

	public function actionPostspp(){
		if(Yii::$app->user->identity->auth_key){
			$biaya = $_POST['biaya'];			
			$group = $_POST['group'];			
			$idsiswa = $_POST['idsiswa'];	
			$bulan = $_POST['bulan'];	
			$admin = Yii::$app->user->identity->username;		
				
			$model = new SppSiswa();
			
			$model->idsiswa = $idsiswa;
			$model->idgroup = $group;
			$model->bulan = $bulan;
			$model->besaran = $biaya;
			$model->user_create = $admin;
			$model->date_create = date('Y-m-d H:i:s');
			$model->save();	
						
			$data = ['err'=>'sukses'];

			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}else{
			$data = [
				'data'=>['']
			];
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}
	}
	public function actionPostfix(){
		if(Yii::$app->user->identity->auth_key){
			$biaya = $_POST['biaya'];			
			$group = $_POST['group'];			
			$keterangan = $_POST['keterangan'];			
			$nama_tagihan = $_POST['nama_tagihan'];			
			$idsiswa = $_POST['idsiswa'];				
			$admin = Yii::$app->user->identity->username;		
				
			// $biaya =300000;			
			// $group = 15;			
			// $keterangan = 'Semester A';			
			// $idsiswa = '17006';				
			// $admin = Yii::$app->user->identity->username;	

			$model = new TagihanSiswa();
			
			$model->idsiswa = $idsiswa;
			$model->idgroup = $group;
			$model->nama_tagihan = $nama_tagihan;
			$model->keterangan = $keterangan;
			$model->besaran = $biaya;
			$model->user_create = $admin;
			$model->date_create = date('Y-m-d H:i:s');
			$model->save();	
						
			// $data = ['err'=>'sukses',
			// 		 'biaya'=>$biaya,
			// 		 'group' => $group,
			// 		 'keterangan' => $keterangan,
			// 		 'nama_tagihan' => $nama_tagihan,
			// 		 'idsiswa' => $idsiswa,
			// 		 'admin' => $admin
			// 		];
			
			$data = ['err'=>'sukses'];
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}else{
			$data = [
				'data'=>['']
			];
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}
	}

	public function actionPostbiaya(){
		if(Yii::$app->user->identity->auth_key){
			
			$data = explode(";",$_POST['data']);	
			$admin = Yii::$app->user->identity->username;		
				
			$model = new TagihanBiayaTidaktetap();

			$models = BiayaTidakTetap::findOne($data[1]);			
			$no_invoice ='BIL'.rand(99999,11111);
			$model->idsiswa = $data[0];
			$model->idbiaya = $data[1];
			$model->no_tagihan = $no_invoice;
			$model->keterangan = $models->keterangan;
			$model->nominal = $models->nominal;
			$model->flag = 0;
			$model->tgl_assign = date('Y-m-d H:i:s');
			$model->user = $admin;
			$model->save();	
						
			$data = ['err'=>'sukses'];

			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}else{
			$data = [
				'data'=>['']
			];
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}
	}

	public function actionPostoptional(){
		if(Yii::$app->user->identity->auth_key){
			$biaya = $_POST['biaya'];								
			$keterangan = $_POST['keterangan'];			
			$nama_tagihan = $_POST['nama_tagihan'];			
			$idsiswa = $_POST['idsiswa'];			
			$group = $_POST['group'];			
			$admin = Yii::$app->user->identity->username;		
				
		
			// $biaya =300000;			
			// $group = 15;			
			// $keterangan = 'Semester A';			
			// $idsiswa = '17006';	
			// $nama_tagihan = 'pembangunan';			
			// $admin = Yii::$app->user->identity->username;	
			
			$model = new TagihanSiswa();
			
			$model->idsiswa = $idsiswa;			
			$model->nama_tagihan = $nama_tagihan;
			$model->keterangan = $keterangan;
			$model->idgroup = $group;
			$model->besaran = $biaya;
			$model->user_create = $admin;
			$model->date_create = date('Y-m-d H:i:s');
			$model->save();	
						

			// $data = ['err'=>'sukses',
			// 		 'biaya'=>$biaya,
			// 		 'group' => $group,
			// 		 'keterangan' => $keterangan,
			// 		 'nama_tagihan' => $nama_tagihan,
			// 		 'idsiswa' => $idsiswa,
			// 		 'admin' => $admin
			// 		];

			$data = ['err'=>'sukses'];
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}else{
			$data = [
				'data'=>['']
			];
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}
	}

	public function actionTagihantidaktetap($id){
		
		$model = TagihanBiayaTidaktetap::find()
				->where(['idsiswa'=>$id])
				->All();
		$output = array();

		$aksi = '';
		$status = '';
		foreach($model as $key => $models):						
			if($models->flag == 0){
				$aksi = '<i class="material-icons bayar" aria-hidden="true" data-id='.$id.';'.$models->id.'>touch_app</i>';
				$status =  '<span class="tag tag-danger">Belum Lunas</span>'; 
			}else{
				$aksi = '<a target="_blank" href="tagihan_siswa-print-'.$id.'-'.$models->no_tagihan.'" class="material-icons cetak" aria-hidden="true" >print</a>';
				$status =  '<span class="tag tag-success">Lunas</span>'; 
			}
			
			$output[$key] = array($models->no_tagihan
								 ,$models->keterangan
								 ,number_format($models->nominal,0,'.','.')	
								 ,$status					 
								 ,$aksi);
		endforeach;
				
				
		$data = json_encode($output);
		$data = [
			'data'=>$output
		];
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
		
	}

	public function actionPrint($idsiswa,$idbilling){
		// include "./inc/pdf.php";

		// cetakKuitansi($idsiswa, $idbilling);

		$data = TagihanBiayaTidaktetap::find()
		->where(['no_tagihan'=>$idbilling])
		->AndWhere(['idsiswa'=>$idsiswa])
		->One();

		// $mpdf=new mpdf('utf-8');
		$mpdf = new \Mpdf\Mpdf();
		

		$mpdf->WriteHTML(' <html xmlns="http://www.w3.org/1999/xhtml" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<head>
						<meta name="viewport" content="width=device-width" />
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<title>Billing e.g. invoices and receipts</title>
						<style type="text/css">
							img {
							max-width: 100%;
							}
							body {
							-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
							}
							body {
							background-color: #f6f6f6;
							}
							@media only screen and (max-width: 640px) {
							body {
							padding: 0 !important;
							}
							h1 {
							font-weight: 800 !important; margin: 20px 0 5px !important;
							}
							h2 {
							font-weight: 800 !important; margin: 20px 0 5px !important;
							}
							h3 {
							font-weight: 800 !important; margin: 20px 0 5px !important;
							}
							h4 {
							font-weight: 800 !important; margin: 20px 0 5px !important;
							}
							h1 {
							font-size: 22px !important;
							}
							h2 {
							font-size: 18px !important;
							}
							h3 {
							font-size: 16px !important;
							}
							.container {
							padding: 0 !important; width: 100% !important;
							}
							.content {
							padding: 0 !important;
							}
							.content-wrap {
							padding: 10px !important;
							}
							.invoice {
							width: 100% !important;
							}
							}
						</style>
					</head>
					<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
						<table class="body-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
							<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
								<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
								<td class="container" width="600" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
									<div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
										<table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
											<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
												<td class="content-wrap aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;" align="center" valign="top">
													<table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
														<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
															<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
															<img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl='.$idbilling.'&choe=UTF-8" style="width:100px" title="'.$idbilling.'>" />
															</td>
														</tr>
														<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
															<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
																<h2 class="aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif; box-sizing: border-box; font-size: 24px; color: #000; line-height: 1.2em; font-weight: 400; text-align: center; margin: 40px 0 0;" align="center">SMK MALAKA</h2>
															</td>
														</tr>
														<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
															<td class="content-block aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
																<table class="invoice" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 80%; margin: 40px auto;">
																	<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																		<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">'.$idsiswa.'<br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />Invoice #'.$idbilling.'<br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />'.date('d M Y',strtotime($data->tgl_payment)).'</td>
																	</tr>
																	<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																		<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
																			<table class="invoice-items" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;">
																				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																					<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">'.$data->keterangan.'</td>
																					<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">1</td>
																					<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">LUNAS</td>
																					<td class="alignright" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" align="right" valign="top">'.number_format($data->nominal,0,".",".").'</td>
																					
																					
																				</tr>
																			   
																				<tr class="total" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																					<td class="alignright" colspan="3" width="80%" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top">Total</td>
																					<td class="alignright" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top">'.number_format($data->nominal,0,".",".").'</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
															<td class="content-block aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">                                                
															</td>
														</tr>
														<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
															<td class="content-block aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
															 <br/> THANK YOU
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									
									</div>
								</td>
								<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
							</tr>
						</table>
					</body>
				</html>');

			// $mpdf->WriteHTML('Hello World');

			$mpdf->Output();
		exit;

	}
	public function actionPostpembayaran(){
			$data = explode(";",$_POST['data']);
			$model  = TagihanBiayaTidaktetap::findOne($data[1]);

			$model->flag = 1;
			$model->tgl_payment = date('Y-m-d H:i:s');
			$model->user = Yii::$app->user->identity->username;
			$model->save();

			$data = ['err'=>'sukses'];

			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
	}

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

	public function actionListtagihan($id){

		// $id = explode(";",$id);	
		$model = BiayaTidakTetap::find()
				->all();

		$output = array();
				
		foreach($model as $key => $models):						
			$aksi = '';
			
				$aksi = '<i class="material-icons assign" id="assign" aria-hidden="true" data-id='.$id.';'.$models->id.'>add_box</i>';
			
			$output[$key] = array($models->keterangan
								 ,number_format($models->nominal,0,'.','.')						 
								 ,$aksi);
		endforeach;
				
				
		$data = json_encode($output);
		$data = [
			'data'=>$output
		];
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
				
		

	}
    /**
     * Creates a new TagihanSiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TagihanSiswa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtagihan_siswa]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TagihanSiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtagihan_siswa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TagihanSiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TagihanSiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TagihanSiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TagihanSiswa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
