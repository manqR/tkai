<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Siswa;
use backend\models\Kelas;
use backend\models\TahunAjaran;
use backend\models\Cabang;
use backend\models\DetilKelas;


include './inc/money.php';
class ApiController extends Controller
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
    public function actionRegister(){
 
        if(Yii::$app->user->identity->auth_key){
            $connection = \Yii::$app->db;
            $query = $connection->createCommand("SELECT * FROM v_siswa WHERE status <> 1");
            $data = $query->queryAll();
            
            $output = array();
          
         
            foreach($data as $key => $models):              
            
                $output[$key] = array($models['nis']
                                    ,$models['nama_lengkap']
                                    ,$models['cabang']
                                    ,$models['kategori']
                                    ,$models['nisn']
                                    ,$models['jenis_kelamin']
                                    ,$models['tempat_lahir']
                                    ,$models['tanggal_lahir']                                    
                                    ,'<i class="material-icons view" aria-hidden="true" data-id="">open_in_new</i> | <i class="material-icons edit" aria-hidden="true" data-id="">edit</i>'
                                );
            
            endforeach;
          
            
          
            $data = json_encode($output);
            $data = [
                'data'=>$output
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }else{           
            $data = [
                'msg'=>'Auth not allowed'
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }
    public function actionSiswa(){
 
        if(Yii::$app->user->identity->auth_key){

            $cabang = Yii::$app->user->identity->cabang;
            $filter = '';
            if($cabang == 0){
                $filter ="";
            }else{
                $filter = " AND idcabang = ".$cabang."";
            }
            $connection = \Yii::$app->db;
            $query = $connection->createCommand("SELECT * FROM v_siswa WHERE status = 1 $filter");
            $data = $query->queryAll();
            
            $output = array();
          
         
            foreach($data as $key => $models):              
            
                $output[$key] = array($models['nis']
                                    ,$models['nama_lengkap']
                                    ,$models['cabang']
                                    ,$models['kategori']
                                    ,$models['nisn']
                                    ,$models['jenis_kelamin']
                                    ,$models['tempat_lahir']
                                    ,$models['tanggal_lahir']                                    
                                    ,'<i class="material-icons view" aria-hidden="true" data-id="">open_in_new</i> | <i class="material-icons edit" aria-hidden="true" data-id="">edit</i>'
                                );
            
            endforeach;
          
            
          
            $data = json_encode($output);
            $data = [
                'data'=>$output
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }else{           
            $data = [
                'msg'=>'Auth not allowed'
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }

    public function actionKelasSiswa($id, $grade){

        $ThAjaran = TahunAjaran::find()
                    ->Where(['flag'=>1])
                    ->One();
        if($id == 0 && $grade == 0){
            $Cabang = Cabang::find()
                ->All();
            $model = Kelas::find()
                ->Where(['tahun_ajaran'=>$ThAjaran])                            
                ->All();
            $count = Cabang::find()
                ->count();
        }else{
            $Cabang = Cabang::find()
                ->Where(['idcabang'=>$id])                
                ->All();
            $model = Kelas::find()
                ->Where(['tahun_ajaran'=>$ThAjaran]) 
                ->AndWhere(['idcabang'=>$id])  
                ->AndWhere(['idkategori'=>$grade])         
                ->All();
            $count = Cabang::find()
                ->Where(['idcabang'=>$id])
                ->count();    
        }

       
        $data = '';
        
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
            $data .='
                            <div class="col-md-6 col-lg-3">
                                <div class="pricing-plan">
                                    <h5>'.$models->kode.' - '.$grd.'</h5>
                                    <i class="material-icons addSiswa" aria-hidden="true" data-toggle="modal" data-id='.$models->key_.' data-target=".add-siswa">add_circle_outline</i>
                                    <p class="plan-title text-primary">'.$models->wali_kelas.'<br/>'.$brnch.'</p>
                                    <div class="plan-price text-primary">
                                        <span>'.$count['jml'].'</span>
                                    </div>
                                    <ul class="plan-features">									
                                        '.$ls_siswa.'
                                    </ul>
                                    <button class="btn btn-primary btn-lg open-AddBookDialog" data-toggle="modal" data-id='.$models->key_.' data-target=".siswa">Lihat Data Siswa</button>
                                </div>
                            </div>';
        endforeach;
        return $data;
    }

    public function actionSiswaList($key_){
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM v_kelas_siswa WHERE key_ = '".$key_."'");
        $model = $sql->queryAll();

        $output = array();
			
        
        foreach($model as $key => $models):
            $aksi = '<i class="material-icons kurang" title="Hapus" aria-hidden="true" data-id='.$models['kode_siswa'].';'.$key_.'>delete</i>';

                            $output[$key] = array($models['nis']
                            ,$models['nama_lengkap']
                            ,$models['cabang']
                            ,$models['kategori']                            
                            ,$models['jenis_kelamin']
                            ,$models['tempat_lahir']
                            ,$models['tanggal_lahir']
                            ,$aksi
        );
		endforeach;
		
		$data = json_encode($output);
		$data = [
			'data'=>$output
		];
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
    }
    public function actionSiswaListAdd($key_){
        $key = explode("-",$key_);

        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT (SELECT b.key_ FROM detil_kelas b WHERE a.kode_siswa = b.kode_siswa AND b.key_ = '".$key_."')key_ 
                                                    ,a.* 
                                                    FROM v_siswa a
                                         WHERE a.idcabang = '".$key[1]."' AND a.idkategori = '".$key[2]."'");
                                         
        $model = $sql->queryAll();

        $output = array();
            
        $aksi = '';
        foreach($model as $i => $models):
            if($models['key_']){
                $aksi = '<span class="tag tag-success">kelas '.$key[0].' </span>';
            }else{
                $aksi = '<i class="material-icons tambah" aria-hidden="true" data-id='.$models['kode_siswa'].';'.$key_.'>add_box</i>';
            }

            $output[$i] = array($models['nis']
                            ,$models['nama_lengkap']
                            ,$models['cabang']
                            ,$models['kategori']                            
                            ,$models['jenis_kelamin']
                            ,$models['tempat_lahir']
                            ,$models['tanggal_lahir']
                            ,$aksi
                        );
		endforeach;
		
		$data = json_encode($output);
		$data = [
			'data'=>$output
		];
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
    }
    public function actionAddSiswa(){
        $return = explode(";",$_POST['data']);

        $model = new DetilKelas();
        $model->kode_siswa = $return[0];
        $model->key_ = $return[1];        
        $model->save();
        
        $data = array();
		if($model){            
            $data = ['err'=>'sukses'];
        }else{
            $data = [
				'data'=>['']
			];
        }
		
        
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
    }
    public function actionDeleteSiswa(){
        $return = explode(";",$_POST['data']);

        $query =DetilKelas::find()
                ->where(['key_'=>$return[1]])
                ->AndWhere(['kode_siswa'=>$return[0]])
                ->One();
                       
        $data = array();
		if($query->delete()){            
            $data = ['err'=>'sukses'];
        }else{
            $data = [
				'data'=>['']
			];
        }
		
        
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
    }

    public function actionKelas(){
   
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT a.kode, b.keterangan `cabang`, c.keterangan `grade`, a.key_, a.flag, a.tahun_ajaran, a.wali_kelas
                                            FROM kelas a
                                            JOIN cabang b ON a.idcabang = b.idcabang
                                            JOIN kategori c ON a.idkategori  = c.idkategori");
                                         
        $model = $sql->queryAll();        
        $output = array();
        $status = '';
        $aksi = "<i class=\"material-icons view\" aria-hidden=\"true\" data-id=\"\">delete</i> | <i class=\"material-icons edit\" aria-hidden=\"true\" data-id=\"\">edit</i>";
        foreach($model as $i => $models):
            if($models['flag'] == 1){
                $status = '<span class="tag tag-success">Aktif</span>';
            }else{
                $status = '<span class="tag tag-warning">Tidak Aktif</span>';
            }

            $output[$i] = array($models['kode']
                            ,$models['cabang']
                            ,$models['grade']
                            ,$models['tahun_ajaran']                       
                            ,$models['wali_kelas']
                            ,$status                                                        
                            ,$aksi
                        );
		endforeach;
		
		$data = json_encode($output);
		$data = [
			'data'=>$output
		];
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
    }

    public function actionAjaran(){          
        $model = TahunAjaran::find()
                ->all();
        $output = array();
        $status = '';
        $aksi = "<i class=\"material-icons view\" aria-hidden=\"true\" data-id=\"\">delete</i> | <i class=\"material-icons edit\" aria-hidden=\"true\" data-id=\"\">edit</i>";
        foreach($model as $i => $models):
            if($models->flag == 1){
                $status = '<span class="tag tag-success">Aktif</span>';
            }else{
                $status = '<span class="tag tag-warning">Tidak Aktif</span>';
            }

            $output[$i] = array($models->tahun_ajaran                                                      
                            ,$status                                                        
                            ,$aksi
                        );
		endforeach;
		
		$data = json_encode($output);
		$data = [
			'data'=>$output
		];
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
    }

    public function actionTagihan(){     
        
        $filter = Yii::$app->user->identity->cabang == 0 ? "" : "WHERE idcabang = ".Yii::$app->user->identity->cabang;
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM v_tagihan ".$filter);
                                         
        $model = $sql->queryAll();    
        $output = array();        
        $aksi = "<i class=\"material-icons view\" aria-hidden=\"true\" data-id=\"\">delete</i> | <i class=\"material-icons edit\" aria-hidden=\"true\" data-id=\"\">edit</i>";
        foreach($model as $i => $models):          

            $output[$i] = array(
                             $models['cabang']                                                   
                            ,$models['grade']                                                        
                            ,$models['tahun_ajaran']                                                                                    
                            ,FormatRupiah($models['seragam'])
                            ,FormatRupiah($models['peralatan'])                                                                                    
                            ,FormatRupiah($models['uang_pangkal'])                                                                                    
                            ,FormatRupiah($models['uang_bangunan'])                                                                                    
                            ,FormatRupiah($models['material'])
                            ,$aksi                                                                                                                                                                                          
                        );
		endforeach;
		
		$data = json_encode($output);
		$data = [
			'data'=>$output
		];
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
    }
}

?>