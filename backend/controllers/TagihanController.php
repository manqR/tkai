<?php

namespace backend\controllers;

use Yii;
use backend\models\Tagihan;
use backend\models\Kategori;
use backend\models\TagihanSpp;
use backend\models\BulanSpp;
use backend\models\TagihanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagihanController implements the CRUD actions for Tagihan model.
 */



class TagihanController extends Controller
{
    /**
     * {@inheritdoc}
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
    }

    /**
     * Lists all Tagihan models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        include './inc/table.php';
        include './inc/models.php';
        include './inc/money.php';
        return $this->render('index', [
            'arrFields' => AttributeTagihan(),                   
        ]);
    }

    /**
     * Displays a single Tagihan model.
     * @param string $idtagihan
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idtagihan, $urutan)
    {
        return $this->render('view', [
            'model' => $this->findModel($idtagihan, $urutan),
        ]);
    }

    /**
     * Creates a new Tagihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        include './inc/table.php';
        include './inc/models.php';
        include './inc/money.php';
        $model = new Tagihan();
        $spp = new TagihanSpp();

        $kode = 'INV-'.date('my').rand(10000,99999);

        $grade = Kategori::find()
                ->All();
        
        $filter = Yii::$app->user->identity->cabang == 0 ? "" : "WHERE idcabang = ".Yii::$app->user->identity->cabang;        
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM cabang ".$filter);
        $cabang = $sql->queryAll();  

        if ($model->load(Yii::$app->request->post()) && 
            $spp->load(Yii::$app->request->post())){       
            if($_POST){

                $check = Tagihan::find()
                    ->where(['idcabang'=>$_POST['branchSelect']])
                    ->AndWhere(['idkategori'=>$_POST['GradeSelect']])
                    ->AndWhere(['tahun_ajaran'=>$model->tahun_ajaran])
                    ->count();
                if($check > 0){
                    Yii::$app->session->setFlash('error');
                }else{
                    
                    $model->idcabang = $_POST['branchSelect'];     
                    $model->idkategori = $_POST['GradeSelect'];     
                    $model->seragam = SaveRupiah($model->seragam);
                    $model->peralatan = SaveRupiah($model->peralatan);
                    $model->uang_pangkal = SaveRupiah($model->uang_pangkal);
                    $model->uang_bangunan = SaveRupiah($model->uang_bangunan);
                    $model->material_penunjang = SaveRupiah($model->material_penunjang);
                    $model->material_tahunan = SaveRupiah($model->material_tahunan);
                    $model->daftar_ulang = SaveRupiah($model->daftar_ulang);
                    $model->save();

                    $listSpp = BulanSpp::find()
                                ->all();
                    
                    foreach ($listSpp as $listSpps):
                       $spps = new TagihanSpp();

                       $spps->idtagihan = $model->idtagihan;
                       $spps->bulan = $listSpps->bulan;                    
                       $spps->nominal = SaveRupiah($spp->nominal);                    
                       $spps->save(false);
                    endforeach;
                    
                   
                    Yii::$app->session->setFlash('success');
                    return $this->redirect(['index']);
                }
               
            }
                           
        }

        return $this->render('create', [
            'model' => $model,
            'kode' =>$kode,
            'cabang' => $cabang,
            'grade' => $grade,
            'spp' =>$spp
        ]);
    }

    /**
     * Updates an existing Tagihan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idtagihan
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        include './inc/table.php';
        include './inc/models.php';
        include './inc/money.php';
        
        $model = $this->findModel($id);
        $spp = TagihanSpp::findOne(['idtagihan'=>$id]);
        
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM cabang WHERE idcabang = '".$model->idcabang."'");
        $cabang = $sql->queryAll();  

        $grade = Kategori::find()
                         ->Where(['idkategori'=>$model->idkategori])
                         ->All();

        if ($model->load(Yii::$app->request->post()) && 
            $spp->load(Yii::$app->request->post())){    
            
                $model->idcabang = $_POST['branchSelect'];     
                $model->idkategori = $_POST['GradeSelect'];     
                $model->seragam = SaveRupiah($model->seragam);
                $model->peralatan = SaveRupiah($model->peralatan);
                $model->uang_pangkal = SaveRupiah($model->uang_pangkal);
                $model->uang_bangunan = SaveRupiah($model->uang_bangunan);
                $model->material_penunjang = SaveRupiah($model->material_penunjang);
                $model->material_tahunan = SaveRupiah($model->material_tahunan);
                $model->daftar_ulang = SaveRupiah($model->daftar_ulang);
                $model->save();


                $ListSpp = TagihanSpp::findAll(['idtagihan'=>$id]);

                foreach($ListSpp as $ListSpps):
                    $ListSpps->delete();
                endforeach;
                

                $listSpp = BulanSpp::find()
                        ->all();
    
                foreach ($listSpp as $listSpps):
                    $spps = new TagihanSpp();

                    $spps->idtagihan = $model->idtagihan;
                    $spps->bulan = $listSpps->bulan;                    
                    $spps->nominal = SaveRupiah($spp->nominal);                    
                    $spps->save(false);
                endforeach;
            
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'spp' => $spp,
            'cabang' => $cabang,
            'grade' => $grade,
        ]);
    }

    /**
     * Deletes an existing Tagihan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $idtagihan
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idtagihan, $urutan)
    {
        $this->findModel($idtagihan, $urutan)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tagihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $idtagihan
     * @param integer $urutan
     * @return Tagihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idtagihan)
    {
        if (($model = Tagihan::findOne(['idtagihan' => $idtagihan])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
