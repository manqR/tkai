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
use backend\models\TagihanLain;
use backend\models\Menu;
use backend\models\RolePrivillage;
use backend\models\Role;
use backend\models\MenuDetail;
use backend\models\KodeSiswa;


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
            $query = $connection->createCommand("SELECT * FROM v_siswa WHERE status = 0 ORDER BY urutan DESC");
            $data = $query->queryAll();
            
            $output = array();
          
            
          
            foreach($data as $key => $models):              
            
                $output[$key] = array($models['no_registrasi']
                                    ,$models['nisn']
                                    ,$models['nama_lengkap']
                                    ,$models['cabang']
                                    ,$models['kategori']
                                    ,$models['jenis_kelamin']
                                    ,$models['tempat_lahir']
                                    ,$models['tanggal_lahir']    
                                    ,'<input type="checkbox" name="action[]" value="'.$models['no_registrasi'].'">'                                
                                    ,'<a href="registrasi-view-'.$models['no_registrasi'].'"><i class="material-icons view" aria-hidden="true" data-id="">open_in_new</i></a> | 
                                     <a href="registrasi-update-'.$models['no_registrasi'].'"><i class="material-icons edit" aria-hidden="true" data-id="">edit</i></a> | 
                                     <a href="registrasi-print-'.$models['no_registrasi'].'"  target="_blank"><i class="material-icons print" aria-hidden="true" data-id="">print</i></a> |' 
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
                                    ,'<a href="siswa-view-'.$models['kode_siswa'].'"><i class="material-icons view" aria-hidden="true" data-id="">open_in_new</i></a> | 
                                    <a href="siswa-update-'.$models['kode_siswa'].'"><i class="material-icons edit" aria-hidden="true" data-id="">edit</i></a>  | 
                                    <a href="siswa-delete-'.$models['kode_siswa'].'"><i class="material-icons delete" aria-hidden="true" data-id="">delete</i></a>'
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

    public function actionKelasSiswa($id, $grade, $thn){

        $ThAjaran = TahunAjaran::find()
                    ->Where(['idtahun_ajaran'=>$thn])
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
                                    <a class="material-icons" href="kelassiswa-export-'.$models->key_.'">import_export</a>
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
        $sql = $connection->createCommand("SELECT * FROM v_kelas_siswa WHERE key_ = '".$key_."' AND status = 1");
        $model = $sql->queryAll();

        $output = array();
			
        
        foreach($model as $key => $models):
            $aksi = '<i class="material-icons kurang" title="Hapus" aria-hidden="true" data-id='.$models['kode_siswa'].';'.$key_.'>delete</i>
                     <i class="material-icons pindah" title="Pindah Kelas" data-toggle="modal" aria-hidden="true" data-target=".pindah-kelas" data-id='.$models['kode_siswa'].';'.$key_.'>compare_arrows</i>';                     
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
      
        $rest = substr($key_, -8);   
        $key = explode("-",$rest);
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT a.*, b.key_ 
                                            FROM v_siswa a 
                                            LEFT JOIN detil_kelas b ON a.kode_siswa = b.kode_siswa
                                         WHERE a.idcabang = '".$key[0]."' AND a.status = 1 AND a.idkategori = '".$key[1]."'
                                         ");
                                         
        $model = $sql->queryAll();

        $output = array();
            
        $aksi = '';
        foreach($model as $i => $models):

            $kelas = explode("-",$models['key_']);
            $rest2 = substr($models['key_'], -8);   
         
            if($models['key_'] && ($rest == $rest2)){
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

        
       
        $detail_kelas = $return[1];
        $rest = substr($return[1], -8);   
        $detail = explode("-",$rest);

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
                ,'".$detail_kelas."'
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
                ->Andwhere(['idcabang' => $detail[0]])
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
            $spp_siswa->save(false);        
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
        $detail_kelas = $return[1];


        $find = Kelas::find()
                ->where(['key_'=>$return[1]])
                ->One();

        $view = Tagihan::find()
                ->where(['idkategori' => $detail[1]])
                ->Andwhere(['idcabang' => $detail[0]])
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
                    ->AndWhere(['kode_kelas'=>$detail_kelas])
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
        $sql = $connection->createCommand("SELECT a.kode, b.keterangan `cabang`, c.keterangan `grade`, a.key_, a.flag, a.tahun_ajaran, a.wali_kelas, a.guru_kelas, a.urutan
                                            FROM kelas a
                                            JOIN cabang b ON a.idcabang = b.idcabang
                                            JOIN kategori c ON a.idkategori  = c.idkategori");
                                         
        $model = $sql->queryAll();        
        $output = array();
        $status = '';       
        foreach($model as $i => $models):
            $aksi = "<a href='kelas-update-".$models['urutan']."' class=\"material-icons edit\" aria-hidden=\"true\" data-id=\"\">edit</a>";
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
                            ,$models['guru_kelas']
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
        foreach($model as $i => $models):
            $aksi = "<a href='tahun-ajaran-update-".$models->idtahun_ajaran."' class=\"material-icons edit\" aria-hidden=\"true\" data-id=\"\">edit</a>";
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
        
        foreach($model as $i => $models):          
            $aksi = "<i class=\"material-icons view\" aria-hidden=\"true\" data-id=\"\">delete</i> | <a href=\"tagihan-update-".$models['idtagihan']."\" class=\"material-icons edit\" aria-hidden=\"true\" data-id=\"\">edit</i>";
         
            $output[$i] = array(
                
                             $models['cabang']                                                   
                            ,$models['grade']                                                        
                            ,$models['tahun_ajaran']                                                                                                                                                                                           
                            ,FormatRupiah($models['uang_pangkal'])                                                                                    
                            ,FormatRupiah($models['uang_bangunan']) 
                            ,FormatRupiah($models['seragam'])
                            ,FormatRupiah($models['peralatan'])                                                                                          
                            ,FormatRupiah($models['material_penunjang'])
                            ,FormatRupiah($models['material_tahunan'])
                            ,($models['daftar_ulang'] == 0 ? $models['daftar_ulang'] : FormatRupiah($models['daftar_ulang']))
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
        $sql = $connection->createCommand("SELECT * FROM v_tagihan_siswa_all a WHERE nominal <> 0                                            
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
            $model->diskon = 0;
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
    public function actionDeleteCart(){     
        
        $output = array();

        if($_POST){
            $id = $_POST['data'];
            $model = Cart::findOne($id);

            $model->delete();


            $data = [
                'error'=>'success',
                'siswa'=>$model->kode_siswa,
            ];                
        }else{
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
                            <td width='10%'><input type=\"number\" class=\"form-control\" onKeyup =  \"Discount()\" name=\"diskon[]\" id=\"diskon\" value=0 /></td>
                            <td><input type=\"text\" class=\"form-control\" onKeyup =  \"findTotal()\" 	 name=\"nominal_bayar[]\" id=\"nominal_bayar\" value='$models->jumlah_bayar'/></td>
                           
                               
                                <input type='hidden' name=\"nominalTagihan[]\" value='".$models->nominal."' />
                                <input type='hidden' name=\"urutan[]\" value='".$models->urutan."' />
                                <input type='hidden' name=\"kode[]\" value='".$kode."' />
                            
                            <td><input type=\"text\" class=\"form-control\"  name=\"keterangan[]\" id=\"keterangan\" value='' /></td>
                            <td><i class=\"material-icons delete\" aria-hidden=\"true\"  data-id=".$models->urutan.">delete</i></td>
                        </tr>";                                               
            endforeach;
        }else{
            $data = " <tr>
                    <td colspan=\"8\" class=\"text-xs-center\">No data available in table</td>
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

    public function actionListTunggakan($thn,$grade){    

        $tahun = explode('-',$thn);
        $tahun = $tahun[0].'/'.$tahun[1];
        
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM v_tagihan_siswa_all a 
                                            JOIN siswa b ON a.kode_siswa = b.kode_siswa
                                            JOIN kategori c ON b.idkategori = c.idkategori
                                            WHERE a.tahun_ajaran = '".$tahun."' AND c.keterangan = '".$grade."' ORDER BY nama_lengkap");

                                            
           
        $model = $sql->queryAll();            
        $output = array();  
        foreach($model as $i => $models):       
        
            $output[$i] = array(
                             $models['nis']                                                   
                            ,$models['nama_lengkap']                                                                                                                                       
                            ,$models['jenis_kelamin']                                                         
                            ,$models['tempat_lahir']                                                                                                             
                            ,$models['tanggal_lahir']     
                            ,$models['tahun_ajaran']     
                            ,$models['remarks']     
                            ,FormatRupiah($models['nominal'])     
                            
                        );
		endforeach;
		
		$data = json_encode($output);
		$data = [
			'data'=>$output
		];
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $data;
    }
    public function actionPembelian($kode){

        $model = TagihanLain::find()
                ->all();
        $tahun_ajaran = TahunAjaran::Find()
                    ->where(['flag'=>1])
                    ->One();
                            
        $output = array ();
        foreach($model as $i => $models):
            $aksi = "<i class=\"material-icons addCart\" aria-hidden=\"true\" data-id=\"".$models['nama_tagihan'].';'.$kode.';'.$models['nama_tagihan'].';'.$models['idtagihan'].';'.$tahun_ajaran->tahun_ajaran.';'.$models['nominal']."\">add_box</i>";   
            $output[$i] = array(
                $models->idtagihan,
                $models->nama_tagihan,
                formatRupiah($models->nominal),
                $aksi
            );
        endforeach;
        $data = [
            'data'=>$output
        ];
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
        
    }
    public function actionListkelas($kode,$cbg){

        $model = Kelas::find()
            ->Where(['idkategori'=>$kode])                            
            ->AndWhere(['idcabang'=>$cbg])                            
            ->All();
        $options = '';
        foreach($model as $i => $models):
            $options .= '<option value='.$models->key_.'>'.$models->kode.'<option>';
        endforeach;
        return $options;

    }
    public function actionListMenu(){
        
        $output = array();         

        if($_POST){

            $arrData = $_POST['data'];

          
            $model = Menu::find()
                    ->where(['flag'=>1])
                    ->all();
            
            $html = '';
           
            $html .='<div id="fontSizeWrapper">
                        <label for="fontSize">Tree Menu</label>                
                    </div>
                    <ul class="tree list-inline">';
            $x = 0;
            $d = 0;
            foreach($model as $models):
                $x += 1;
                
                $privileges = RolePrivillage::find()
                    ->where(['like', 'menu_name', $models->nama_menu])
                    ->AndWhere(['description'=>'HEAD'])
                    ->AndWhere(['idrole'=>$arrData[0]])
                    ->One();
                
                if($privileges){
                    $checks = $privileges->flag == 1 ? 'checked':'';
                }else{
                    $checks = '';
                }
              
                $detail = MenuDetail::find()
                    ->where(['parent_id'=>$models->idmenu])
                    ->andWhere(['flag'=>1])
                    ->all();

                    $child = '';
                  
                    foreach($detail as $details):
                        
                        $privilege = RolePrivillage::find()
                                    ->where(['like', 'menu_name', $details->name])
                                    ->AndWhere(['description'=>'CHILD'])
                                    ->AndWhere(['idrole'=>$arrData[0]])
                                    ->One();
                      
                      
                        if(isset($privilege->flag)){
                            $check = $privilege->flag == 1 ? 'checked':'';
                        }else{
                            $check = '';
                        }
                        
                        $d += 1;
                        $child .=' <li class=" list-inline">
                                        <input type="checkbox"  '.$check.' name="detail" id="d'.$d.'" />
                                        <label for="d'.$d.'" class="tree_label">'.$details->name.'</label>                                 
                                    </li>';

                    endforeach;

                   
                $html .='
                
                        
                            <li>
                                <input type="checkbox" '.$checks.' name="check" id="c'.$x.'" />
                                <label class="tree_label" for="c'.$x.'">'.$models->nama_menu.'</label>
                                <ul>
                                   '.$child.'
                                   
                                </ul>
                            </li>
                            
                       ';
            endforeach;
            $html .=' </ul>';
            return $html;
        }else{

            $data = json_encode($output);
            $data = [
                'data'=>'Method Not Allowed'
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
		    return $data;
        }
        
		
		
    }
    public function actionDivision(){
        $model = Role::find()
                ->all();
        
        $output = array();        

        foreach($model as $i => $models):
            $output[$i] = array(
                          $models->role,                                              
                          '<i data-id='.$models->idrole.';'.$models->role.' class="material-icons add">add</i>'
            );


        endforeach;
                
        $data = json_encode($output);
        $data = [
            'data'=>$output
        ];
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;

    }

    public function actionPostPrivilege(){
        if($_POST){
            
            $head = explode(',',$_POST['master']);
            $childMenu = explode(',',$_POST['child']);

            $model = Menu::find()
                    ->where(['flag'=>1])
                    ->OrderBy(['idmenu'=>SORT_ASC])
                    ->all();

            

            $del= RolePrivillage::find()
                ->where(['idrole'=>$_POST['role']])
                ->all();
                
                
            if(isset($del)){
                foreach($del as $dels){
                    $dels->delete();
                }
            }
            $x = 0;
            foreach($model as $i => $models):
                         
                $privilege = new RolePrivillage();
                $privilege->idrole = $_POST['role'];
                $privilege->description = 'HEAD';
                $privilege->menu_name = $models->nama_menu;
                $privilege->flag = $head[$i];
                $privilege->save();
                // echo $i;
                $child = MenuDetail::find()
                    ->where(['flag'=>1])
                    ->AndWhere(['parent_id'=>$models->idmenu])
                    ->OrderBy(['id'=>SORT_ASC])
                    ->all();

                foreach($child as $key => $childs):
                    $x++;
                    $privilege = new RolePrivillage();
                    $privilege->idrole = $_POST['role'];
                    $privilege->description = 'CHILD';
                    $privilege->menu_name = $childs->name;
                    $privilege->flag = $childMenu[$x-1];
                    $privilege->save();
                endforeach;
                // var_dump($head[$i]);
            endforeach;
        }else{
            $output = array();
            $data = json_encode($output);
            $data = [
                'data'=>'Method Not Allowed'
            ];
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }
    public function actionPindahKelas(){
        
        $model = Siswa::findOne(['kode_siswa'=>$_POST['siswaID']]);        
        $newKelas = Kelas::findOne(['key_'=>$_POST['to']]);
        $oldKelas = Kelas::findOne(['key_'=>$_POST['from']]);
        $detail = DetilKelas::findOne(['key_'=>$_POST['from']]);

        // $newKelas = substr($newKelas->kode_kelas, -7);

        $kodeSiswa = new KodeSiswa();
        $kodeSiswa->kode_siswa = $model->kode_siswa;
        $kodeSiswa->kode_kelas = $_POST['from'];
        $kodeSiswa->tahun_ajaran = $oldKelas->tahun_ajaran;
        $kodeSiswa->date = date('Y-m-d H:i:s');
        $kodeSiswa->user = Yii::$app->user->identity->username;
        // if($kodeSiswa->save()){
        $model->kode_siswa = $newKelas->idcabang.'-'.$newKelas->idkategori.'-'.$model->nis;
        $model->idkategori = $newKelas->idkategori;
        $model->idcabang =   $newKelas->idcabang;
            // $model->save();
        // }
        
        if($kodeSiswa->save() && $model->save()){
            $detail->key_ = $_POST['to'];
            $detail->kode_siswa = $model->kode_siswa;
            $detail->save();
        }

        var_dump($detail);
    }

 
}

?>
