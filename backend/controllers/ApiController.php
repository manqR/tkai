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
    public function actionSiswa(){
 
        if(Yii::$app->user->identity->auth_key){
            $connection = \Yii::$app->db;
            $query = $connection->createCommand("SELECT * FROM v_siswa");
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

            $data .='<div class="row pricing">	
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
                            $output[$key] = array($models['nis']
                            ,$models['nama_lengkap']
                            ,$models['cabang']
                            ,$models['kategori']                            
                            ,$models['jenis_kelamin']
                            ,$models['tempat_lahir']
                            ,$models['tanggal_lahir']
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