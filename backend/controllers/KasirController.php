<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use backend\models\Cart;
use backend\models\Kuitansi;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class KasirController extends \yii\web\Controller
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
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                  // allow authenticated users
                      [
                        'allow' => true,
                        'roles' => ['@'],
                      ],
                  // everything else is denied
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCheckout(){
        
        if($_POST){
            
            $cart = Cart::findOne($_POST['urutan']);
            $cart->jumlah_bayar = $_POST['bayar'];
            $cart->flag= 2;
            $cart->save();

            $model = new Kuitansi();
            $model->no_kuitansi = $_POST['kode'];
            $model->bank_name = $_POST['bank'];
            $model->idcart = $cart->urutan;
            $model->kode_siswa = $cart->kode_siswa;
            $model->idtagihan = $cart->idtagihan;
            $model->remarks = $cart->remarks;
            $model->keterangan = $cart->keterangan;
            $model->nominal = $cart->nominal;
            $model->jumlah_bayar = $_POST['bayar'];
            $model->tahun_ajaran = $cart->tahun_ajaran;
            $model->payment_method = $_POST['payment'];
            $model->flag = $cart->flag;
            $model->date = ($_POST['tgl'] != '' ? $_POST['tgl'] : date('Y-m-d H:i:s'));
            $model->save(false);

            if(strtolower($cart->keterangan) == 'spp'){
                \Yii::$app->db->createCommand("UPDATE tagihan_siswa_spp
                                                SET nominal = (nominal - ".$_POST['bayar']."),
                                                    date_update = '".date('Y-m-d H:i:s')."',
                                                    user_update = '".Yii::$app->user->identity->username ."'
                                                WHERE idtagihan = '".$model->idtagihan."'
                                                AND kode_siswa = '".$model->kode_siswa."'
                                                AND bulan = '".$cart->remarks."'")->execute();     

            }else{
                 \Yii::$app->db->createCommand("UPDATE tagihan_siswa
                                                SET ".str_replace(' ','_',strtolower($cart->remarks))." = (".str_replace(' ','_',strtolower($cart->remarks))." - ".$_POST['bayar'].")
                                                WHERE idtagihan = '".$model->idtagihan."'
                                                AND kode_siswa = '".$model->kode_siswa."'")->execute();          
            }
            

            $data = [
                'msg'=>'success',
                'siswa'=>$model->kode_siswa,
                'no_kuitansi'=>$model->no_kuitansi
            ];
        }else{
            $data = [
                'msg'=>'Method not allowed'
            ];
           
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionPrint($no_kuitansi){
        include 'inc/pdf.php';
     

        // var_dump($_POST);
        // die;
        
        PrintKasir($no_kuitansi);

    }

  

}
