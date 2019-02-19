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
use backend\models\TagihanSiswaSpp;
use backend\models\TagihanSpp;
use backend\models\Tagihan;
use backend\models\TagihanSiswa;
use backend\models\Cart;


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
        $sql = $connection->createCommand("SELECT a.*, b.key_ 
                                            FROM v_siswa a 
                                            LEFT JOIN detil_kelas b ON a.kode_siswa = b.kode_siswa
                                         WHERE a.idcabang = '".$key[1]."' AND a.idkategori = '".$key[2]."'
                                         ");
                                         
        $model = $sql->queryAll();

        $output = array();
            
        $aksi = '';
        foreach($model as $i => $models):

            $kelas = explode("-",$models['key_']);
            if($models['key_']){
                $aksi = '<span class="tag tag-success">kelas '.$kelas[0].' </span>';
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
        
        $find = Kelas::find()
            ->where(['key_'=>$return[1]])
            ->One();

        
        $detail = explode("-",$return[0]);
        $detail_kelas = explode("-",$return[1]);

        \Yii::$app->db->createCommand("INSERT INTO tagihan_siswa (
            kode_siswa
            ,kode_kelas
            ,idtagihan
            ,idcabang
            ,idkategori
            ,tahun_ajaran
            ,seragam
            ,peralatan
            ,uang_pangkal
            ,uang_bangunan
            ,material_penunjang
            ,material_tahunan
            ,tanggal_assign
            ,user_assign
        )
        SELECT  '".$return[0]."'
                ,'".$detail_kelas[0]."'
                ,idtagihan
                ,idcabang
                ,idkategori
                ,tahun_ajaran
                ,seragam
                ,peralatan
                ,uang_pangkal
                ,uang_bangunan
                ,material_penunjang
                ,material_tahunan 
                ,now()
                ,'Admin'
        FROM tagihan WHERE idkategori = '".$detail[1]."' AND idcabang = '".$detail[0]."' AND `tahun_ajaran` = '".$find->tahun_ajaran."'")->execute();

        
        $view = Tagihan::find()
                ->where(['idkategori' => $detail[1]])
                ->where(['idcabang' => $detail[0]])
                ->Andwhere(['tahun_ajaran'=>$find->tahun_ajaran])
                ->One();
       



        // INSERT TAGIHAN SPP
       
        $spp = TagihanSpp::find()
            ->where(['idtagihan'=>$view->idtagihan])
            ->All();
        
        foreach($spp as $spps):
            $spp_siswa = new TagihanSiswaSpp();
            $spp_siswa->idtagihan = $view->idtagihan;
            $spp_siswa->kode_siswa = $return[0];
            $spp_siswa->bulan = $spps->bulan;
            $spp_siswa->nominal = $spps->nominal;
            $spp_siswa->tahun_ajaran = $find->tahun_ajaran;
            $spp_siswa->flag = 1;
            $spp_siswa->date_create = date('Y-m-d');
            $spp_siswa->user_create = Yii::$app->user->identity->username;
            $spp_siswa->urutan = $spps->urutan;
            $spp_siswa->save();        
        endforeach;
        
        
        $data = array();
		if($model && $spp_siswa){            
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
        
                
        $detail = explode("-",$return[0]);
        $detail_kelas = explode("-",$return[1]);


        $find = Kelas::find()
                ->where(['key_'=>$return[1]])
                ->One();

        $view = Tagihan::find()
                ->where(['idkategori' => $detail[1]])
                ->where(['idcabang' => $detail[0]])
                ->Andwhere(['tahun_ajaran'=>$find->tahun_ajaran])
                ->One();
       

        // DELETE TAGIHAN SPP
        $delete_spp = TagihanSiswaSpp::find()
                    ->where(['idtagihan'=>$view->idtagihan])
                    ->AndWhere(['kode_siswa'=>$return[0]])
                    ->All();       
        foreach ($delete_spp as $delete_spps) {
            $delete_spps->delete();  
        }
         
        $tagihanSiswa = TagihanSiswa::find()
                    ->where(['idtagihan'=>$view->idtagihan])
                    ->AndWhere(['kode_siswa'=>$return[0]])
                    ->AndWhere(['kode_kelas'=>$detail_kelas[0]])
                    ->One();
        
        $tagihanSiswa->delete();
                
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
                            ,FormatRupiah($models['material_penunjang'])
                            ,FormatRupiah($models['material_tahunan'])
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
    public function actionListsiswa(){     
        $cabang =  Yii::$app->user->identity->cabang != 0 ? ['idcabang'=>Yii::$app->user->identity->cabang] : "";
        $model = Siswa::find()
                ->where(['status'=>1])
                ->AndWhere($cabang)
                ->all();
       
        $output = array();        
        $aksi = '';
        foreach($model as $i => $models):       
            $aksi = "<i class=\"material-icons add\" aria-hidden=\"true\" data-id=\"".$models->kode_siswa.';'.$models->nis.';'.$models->nama_lengkap."\">add_box</i>";   

            $output[$i] = array(
                             $models['nis']                                                   
                            ,$models['nama_lengkap']                                                        
                            ,$models['tempat_lahir']                                                                                                             
                            ,$models['tanggal_lahir']                                                                                                             
                            ,$models['jenis_kelamin']                                                                                                             
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
    public function actionPostsiswa(){     
        
        if($_POST){
            
            $val = explode(";",$_POST['data']);        
            $output = array();        
                           
            $data = [
                'data'=>[
                    'kode_siswa'=>$val[0],
                    'nis'=>$val[1],
                    'nama'=>$val[2]
                ]
            ];
		
		
        }else{           
            $data = [
                'data'=>'Method Not Allowed'
            ];
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
        
    }

    public function actionListtagihanall($kode=''){     
        

        $kode_siswa = $kode;
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM v_tagihan_siswa_all a WHERE a.remarks NOT IN (SELECT b.remarks FROM cart b WHERE a.kode_siswa = b.kode_siswa AND a.tahun_ajaran = b.tahun_ajaran AND a.idtagihan = b.idtagihan)
                                           AND  a.kode_siswa = '$kode_siswa'");
                                      
        $model = $sql->queryAll();    
        $output = array();        
        $aksi = '';
        foreach($model as $i => $models):          
            $aksi = "<i class=\"material-icons addCart\" aria-hidden=\"true\" data-id=\"".$models['keterangan'].';'.$models['kode_siswa'].';'.$models['remarks'].';'.$models['idtagihan'].';'.$models['tahun_ajaran'].';'.$models['nominal']."\">add_box</i>";   
            $nis = explode("-",$models['kode_siswa']);

            $output[$i] = array(
                            $nis[2]
                            ,'<span class="tag tag-primary">'.ucwords($models['keterangan']).'</span>'  
                            ,$models['remarks']  
                            ,FormatRupiah($models['nominal'])                                                      
                            ,$models['tahun_ajaran']                                                             
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

    public function actionAddCart(){     
        
        $output = array();

        if($_POST){
            $data = explode(";",$_POST['data']);
            $model = new Cart();

            $model->kode_siswa = $data[1];
            $model->idtagihan = $data[3];
            $model->remarks = $data[2];
            $model->keterangan = $data[0];
            $model->nominal = $data[5];
            $model->jumlah_bayar = $data[5];
            $model->tahun_ajaran = $data[4];
            $model->flag = 1;
            $model->date = date('Y-m-d H:i:s');

            $model->save(false);

            $data = json_encode($output);
            $data = [
                'error'=>'success',
                'siswa'=>$model->kode_siswa,

            ];                
        }else{
            $data = json_encode($output);
            $data = [
                'error'=>'error'
            ];
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
       
    }

    public function actionListcart($kode){
        $model = Cart::find()
                ->Where(['kode_siswa'=>$kode])
                ->andWhere(['flag'=>1])
                ->all();

        $data = '';
        
        if($model){
            $kode = 'K-'.date('ymd').'.'.rand(10000,99999);
            foreach($model as $i => $models):    
                $nis = explode("-",$models['kode_siswa']);            
                $data .="<tr>
                            <td>".$nis[2]."</td>
                            <td>".$models->remarks."</td>
                            <td>".$models->tahun_ajaran."</td>
                            <td>".number_format($models->nominal,0,".",".")."</td>
                            <td><input type=\"text\" class=\"form-control\" onKeyup =  \"findTotal()\" 	 name=\"nominal_bayar[]\" id=\"nominal_bayar\" value='$models->jumlah_bayar'/></td>
                           
                               
                                <input type='hidden' name=\"urutan[]\" value='".$models->urutan."' />
                                <input type='hidden' name=\"kode[]\" value='".$kode."' />
                           
                            <td><i class=\"material-icons delete\" aria-hidden=\"true\"  data-id=".$models->urutan.">delete</i></td>
                        </tr>";                                               
            endforeach;
        }else{
            $data = " <tr>
                    <td colspan=\"6\" class=\"text-xs-center\">No data available in table</td>
                </tr>";
        }
        return $data;
    }

    public function actionJumlahList($kode){
        $nominal = Cart::find()
            ->where(['kode_siswa'=>$kode])    
            ->AndWhere(['flag'=>1])        
            ->sum('nominal');    
        
            $data =  "<div class=\"invoice-totals-row\">
                         <strong class=\"invoice-totals-title\">Subtotal</strong>
                         <span class=\"invoice-totals-value\" id='total'><b>Rp ".number_format($nominal,0,".",".")."</b></span>
                         <input type='hidden' id='nominal' name='nominal' value=".$nominal.">
                     </div>";  
            return $data;   
    }

    
}

?>
