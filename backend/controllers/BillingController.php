<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use backend\models\Siswa;
use backend\models\TagihanSiswa;
use backend\models\TagihanSiswaSpp;
use backend\models\TagihanSiswaLain;
use backend\models\SiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



include './inc/money.php';

class BillingController extends \yii\web\Controller
{
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
    }

    public function actionIndex(){

        $searchModel = new SiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDetail($id){
        // $spp = TagihanSiswaSpp::find()
        //         ->where(['kode_siswa'=>$id])
        //         ->OrderBy(['urutan'=>SORT_ASC])
        //         ->All();
        $connection = \Yii::$app->db;
        $query = $connection->createCommand("SELECT a.tahun_ajaran,a.bulan , a.nominal sisa_bayar, a.flag, a.date_update, c.nominal nominal_tagihan FROM tagihan_siswa_spp a JOIN bulan_spp b ON a.bulan = b.bulan JOIN tagihan_spp c ON a.idtagihan = c.idtagihan AND a.bulan = c.bulan WHERE kode_siswa =  '".$id."'
                                             ORDER BY b.urutan");
        $spp = $query->queryAll();

       
        $sql = $connection->createCommand("SELECT * FROM v_tagihan_siswa WHERE kode_siswa = '".$id."'");
        $tagihan = $sql->queryAll();

        $lain = TagihanSiswaLain::find()
                ->joinWith('tagihanLain')
                ->Where(['kode_siswa'=>$id])
                ->All();
        // var_dump($lain->tagihanLain->nama_tagihan);
        // die;
        return $this->render('detail',[
            'model'=>$this->findModel($id),
            'spp'=>$spp,
            'tagihan'=>$tagihan,
            'lain' => $lain,
        ]);
    }

    protected function findModel($id){
        if (($model = Siswa::find()->where(['kode_siswa'=>$id])->One()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
  
