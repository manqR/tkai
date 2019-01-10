<?php

namespace backend\controllers;

use Yii;
use backend\models\Tagihan;
use backend\models\Kategori;
use backend\models\TagihanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagihanController implements the CRUD actions for Tagihan model.
 */


include './inc/table.php';
include './inc/models.php';
include './inc/money.php';

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
        ];
    }

    /**
     * Lists all Tagihan models.
     * @return mixed
     */
    public function actionIndex()
    {
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
        $model = new Tagihan();
        $kode = 'INV-'.date('my').rand(10000,99999);

        $grade = Kategori::find()
                ->All();
        
        $filter = Yii::$app->user->identity->cabang == 0 ? "" : "WHERE idcabang = ".Yii::$app->user->identity->cabang;        
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM cabang ".$filter);
        $cabang = $sql->queryAll();  

        if ($model->load(Yii::$app->request->post())){       
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
                    $model->material = SaveRupiah($model->material);
                    $model->save();
                    Yii::$app->session->setFlash('success');
                    return $this->redirect(['index']);
                }
               
            }
                           
        }

        return $this->render('create', [
            'model' => $model,
            'kode' =>$kode,
            'cabang' => $cabang,
            'grade' => $grade
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
    public function actionUpdate($idtagihan, $urutan)
    {
        $model = $this->findModel($idtagihan, $urutan);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idtagihan' => $model->idtagihan, 'urutan' => $model->urutan]);
        }

        return $this->render('update', [
            'model' => $model,
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
    protected function findModel($idtagihan, $urutan)
    {
        if (($model = Tagihan::findOne(['idtagihan' => $idtagihan, 'urutan' => $urutan])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
