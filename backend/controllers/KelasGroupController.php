<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use backend\models\KelasGroup;
use backend\models\DetailGroup;
use backend\models\TahunAjaran;
use backend\models\KelasGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * KelasGroupController implements the CRUD actions for KelasGroup model.
 */
class KelasGroupController extends Controller
{
	
	public static function allowedDomains(){
		return [
			'*',				
		];
	}
	
    /**
     * @inheritdoc
     */
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
     * Lists all KelasGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
		$findTahun = TahunAjaran::find()				
				->where(['status'=>1])
				->groupBy(['tahun_ajaran'])
				->All();
		
		$Ajaran = KelasGroup::find()	
				->joinWith(['kelas'])			
				->orderBy(['idgroup'=>SORT_DESC])
				->One();
		
				
		$model = KelasGroup::find()
				->joinWith('kelas')						
				->AndWhere(['idajaran'=>$Ajaran])				
				->All();
		
		// $connection = \Yii::$app->db;
		// $sql = $connection->createCommand("SELECT * FROM kelas_group a JOIN kelas b ON a.idkelas = b.idkelas WHERE a.`status` = 'A' AND b.idajaran = '".$Ajaran."' ");
		// $models = $sql->queryAll();
		
				
		$newModel = new TahunAjaran();
        $searchModel = new KelasGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'findTahun' => $findTahun,
			'model'=>$model,
			'newModel' => $newModel
        ]);
    }
	
	public function actionArraydata($id){
		

		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT a.idsiswa, a.nama_lengkap, a.jenis_kelamin, c.idkelas, d.idjurusan, e.tahun_ajaran, d.idajaran, b.id FROM siswa a JOIN detail_group b ON a.idsiswa = b.idsiswa JOIN kelas_group c ON b.idgroup = c.idgroup JOIN  kelas d ON c.idkelas = d.idkelas JOIN tahun_ajaran e ON d.idajaran = e.idajaran WHERE b.idgroup = '".$id."'");
		$models = $sql->queryAll();
		$output = array();
			

		foreach($models as $key => $model):
			$output[$key] = array($model['idsiswa']
								 ,$model['nama_lengkap']
								 ,$model['jenis_kelamin']
								 ,$model['idkelas']
								 ,$model['idjurusan']
								 ,$model['tahun_ajaran']
								 ,'<i class="material-icons kurang" aria-hidden="true" data-id='.$id.';'.$model['idajaran'].';'.$model['idsiswa'].';'.$model['id'].'>delete</i>');
		endforeach;
		
		$data = json_encode($output);
		$data = [
			'data'=>$output
		];
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
	}
	public function actionListsiswa($id){
				
		$id = explode(";",$id);				
		
		$connection = \Yii::$app->db;
		$sql = $connection->createcommand("SELECT a.idkelas FROM  kelas_group a JOIN kelas b ON a.idkelas = b.idkelas WHERE a.idgroup = ".$id[0]." AND b.idajaran = ".$id[1]." LIMIT 1");
		$kelas = $sql->queryall();
			
		if($kelas){
			
			$connection = \yii::$app->db;
			// $sql = $connection->createcommand("SELECT idsiswa, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir 
			// 								   FROM siswa 
			// 								   WHERE idsiswa NOT IN 
			// 										(SELECT a.idsiswa 
			// 										 FROM detail_group a JOIN kelas_group b ON a.idgroup = b.idgroup 
			// 										 WHERE b.idkelas = '".$kelas[0]['idkelas']."')");
			
			$sql = $connection->createcommand("SELECT a.idsiswa
													 ,a.nama_lengkap
													 ,a.jenis_kelamin
													 ,a.tempat_lahir
													 ,a.tanggal_lahir
													 ,IFNULL(c.idkelas,'-') kelas
													 ,d.kode
													 ,c.wali_kelas
												FROM siswa a 
												LEFT JOIN detail_group b ON a.idsiswa = b.idsiswa 
												LEFT JOIN kelas_group c ON b.idgroup = c.idgroup 
												LEFT JOIN kelas d ON c.idkelas = d.idkelas  AND d.idajaran = ".$id[1]."
											");
															

			$models = $sql->queryall();
			
			$output = array();
				
			foreach($models as $key => $model):
				$kelas = $model['kelas'];				
				$kode = $model['kode'];				
				$aksi = '';
				if($kelas == '-' || $kode == ''){
					$aksi = '<i class="material-icons tambah" aria-hidden="true" data-id='.$id[0].';'.$id[1].';'.$model['idsiswa'].'>add_box</i>';
				}else{
					$aksi = '<span class="tag tag-success">Terdaftar di kelas '.$model['kode'].'- wali '.$model['wali_kelas'].'</span>' ;
				}
				$output[$key] = array($model['idsiswa']
									 ,$model['nama_lengkap']
									 ,$model['jenis_kelamin']
									 ,$model['tempat_lahir']
									 ,$model['kelas']
									 ,$aksi);
			endforeach;
			
			
			    $data = json_encode($output);
				$data = [
					'data'=>$output
				];
				Yii::$app->response->format = Response::FORMAT_JSON;
				return $data;
			
			
			
			
		}else{
			$data = [
				'data'=>[]
			];
			
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}
	}
	
	public function actionPostdata(){
		
		$model = new TahunAjaran();
		
		$model->tahun_ajaran = $_POST['ajaran'];
		$model->status = $_POST['status'];
		$model->save();
	}
	public function actionDeletekelas(){
		
	
		if(Yii::$app->user->identity->auth_key){
			$data = $_POST['data'];
			$data = explode(';',$data);
				
			$model = DetailGroup::find()
					->where(['id'=>$data[3]])
					->AndWhere(['idsiswa'=>$data[2]])
					->One();
			$model->delete();
	
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
	
	public function actionPostkelas(){
		
		if(Yii::$app->user->identity->auth_key){
			$model = new DetailGroup();
			
			$data = $_POST['data'];
			$data = explode(';',$data);
			
			$model->idgroup = $data[0];
			$model->idsiswa = $data[2];
			$model->tgl_add = date('Y-m-d');
			$model->save();
			$data = ['err'=>'sukses'];
			
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}else{
			$data = [
				'data'=>['err'=>'failed']
			];
			
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
		}
		
		
	}
	
	public function actionApigroup($id){
		
		 $idSub1 = substr($id,0,4);
		 $idSub2 = substr($id,4,5);
		 
		 $model = KelasGroup::find()
		 		->joinWith('kelas')
				->where(['idajaran'=>$id])
				->all();
		
		
			
		foreach($model as $models):
			 
			 $connection = \Yii::$app->db;
			 $sql = $connection->createCommand("SELECT COUNT(*) JUMLAH FROM detail_group a JOIN kelas_group b ON a.idgroup = b.idgroup JOIN kelas c ON b.idkelas = c.idkelas WHERE c.idajaran = ".$id." AND a.idgroup = ".$models->idgroup."");
			 $count = $sql->queryAll();
			 				
			 $connection = \Yii::$app->db;
			 $sql = $connection->createCommand("SELECT c.nama_lengkap  FROM detail_group a JOIN kelas_group b ON a.idgroup = b.idgroup JOIN siswa c ON a.idsiswa = c.idsiswa  JOIN kelas d ON d.idkelas = b.idkelas WHERE d.idajaran = ".$models->kelas->idajaran." AND a.idgroup = ".$models->idgroup." ORDER BY a.tgl_add DESC LIMIT 5");
			 $siswa = $sql->queryAll();

			 $ls_siswa='';
			 
			 foreach($siswa as $siswas):
			 	$ls_siswa .= '<li>'.$siswas['nama_lengkap'].'</li>';
			 endforeach;
				
			 echo '<div class="col-md-6 col-lg-3">
						<div class="pricing-plan">
							<h5>'.$models->kelas->kode.' - '.$models->kelas->idjurusan.'</h5>
							<i class="material-icons addSiswa" aria-hidden="true" data-toggle="modal" data-id='.$models->idgroup.';'.$models->kelas->idajaran.' data-target=".add-siswa">add_circle_outline</i>
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
		
		
	}
    /**
     * Displays a single KelasGroup model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new KelasGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KelasGroup();

		if ($model->load(Yii::$app->request->post())){
		
			// $model->idajaran = $_POST['idajaran'];
			$model->save();			
            return $this->redirect(['view', 'id' => $model->idgroup]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KelasGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idgroup]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KelasGroup model.
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
     * Finds the KelasGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KelasGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KelasGroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
