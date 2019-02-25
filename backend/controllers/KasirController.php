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
            $model->idcart = $cart->urutan;
            $model->kode_siswa = $cart->kode_siswa;
            $model->idtagihan = $cart->idtagihan;
            $model->remarks = $cart->remarks;
            $model->keterangan = $cart->keterangan;
            $model->nominal = $cart->nominal;
            $model->jumlah_bayar = $_POST['bayar'];
            $model->tahun_ajaran = $cart->tahun_ajaran;
            $model->flag = $cart->flag;
            $model->date = date('Y-m-d H:i:s');
            $model->save();
            $data = [
                'msg'=>'success',
                'siswa'=>$model->kode_siswa
            ];
        }else{
            $data = [
                'msg'=>'Method not allowed'
            ];
           
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

  

}
