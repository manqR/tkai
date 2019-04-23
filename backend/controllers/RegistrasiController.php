<?php



namespace backend\controllers;

use Yii;
use yii\web\Response;
use backend\models\Siswa;
use backend\models\Cart;
use backend\models\Kuitansi;
use backend\models\SiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

include './inc/table.php';
include './inc/models.php';   

class RegistrasiController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(){            
        return $this->render('index', [
            'arrFields' => AttributeRegister(),                   
        ]);
    }

    public function actionCreate(){   
        $model = new Siswa();
        $find = Siswa::find()
                ->orderBy(['urutan'=>SORT_DESC])
                ->One();
        
        $kode = '';
        $nis = '';
        if(substr($find->no_registrasi,2,6) ==  date('ymd')){
            $last = substr($find->no_registrasi,-3) +1;
            if($last < 10){
                $last = '00'.$last;
            }else if($last < 100){
                $last = '0'.$last;
            }else{
                $last = $last;
            }
            $kode = 'RG'.date('ymd').$last;
            $nis = date('ymd').$last;

        }else{
            $kode = 'RG'.date('ymd').'001';
            $nis = date('ymd').'001';
        }           

        if ($model->load(Yii::$app->request->post())){
            
            $model->status = 0;
            $model->nis = $nis;
            $model->kode_siswa = $model->idcabang.'-'.$model->idkategori.'-'.$nis;
            // var_dump($model);
            $model->tgl_input = date('Y-m-d H:i:s');
            $model->tahun_input = date('Y');
            $model->save();

            $cart = new Cart();
            $cart->kode_siswa = $model->kode_siswa;
            $cart->idtagihan = $kode;
            $cart->remarks = 'Registrasi';
            $cart->keterangan = 'tagihan';
            $cart->nominal = $model->biaya_registrasi;
            $cart->jumlah_bayar = $model->biaya_registrasi;
            $cart->tahun_ajaran = $model->tahun_input;
            $cart->flag = 2;
            $cart->date = date('Y-m-d H:i:s');
            $cart->save();

            $kuitansi = new Kuitansi();                        
            $kuitansi->no_kuitansi = 'K-'.date('ymd').'.'.rand(10000,99999);
            $kuitansi->idcart = $cart->urutan;
            $kuitansi->kode_siswa = $cart->kode_siswa;
            $kuitansi->idtagihan = $cart->idtagihan;
            $kuitansi->remarks = $cart->remarks;
            $kuitansi->keterangan = $cart->keterangan;
            $kuitansi->nominal = $cart->nominal;
            $kuitansi->jumlah_bayar = $cart->jumlah_bayar;
            $kuitansi->tahun_ajaran = $cart->tahun_ajaran;
            $kuitansi->flag = $cart->flag;
            $kuitansi->date = $cart->date;
            $kuitansi->save();



            Yii::$app->session->setFlash('success');
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model, 
            'kode'  => $kode              
        ]);
    }



    public function actionUpdate($id)
    {
        $model = Siswa::find()
                ->where(['no_registrasi'=>$id])
                ->One();

        if ($model->load(Yii::$app->request->post())){
            
            $model->save();
            Yii::$app->session->setFlash('success');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionPrint($id){
        include './inc/pdf.php';
        PrintRegKuitansi($id);
    }

    public function actionView($id)
    {
        $model = Siswa::find()
        ->where(['no_registrasi'=>$id])
        ->One();

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionProses(){
        if($_POST){
        //    var_dump($_POST);


           $status = $_POST['status'];
           
            foreach($_POST['action'] as $register):
                $model = Siswa::find()
                        ->where(['no_registrasi'=>$register])
                        ->One();
                $model->status = $status;
                $model->save();
            endforeach;
            Yii::$app->session->setFlash('success');
            return $this->redirect(['index']);
            

        // echo $_POST['action'];
        }else{

        }
    }

}
