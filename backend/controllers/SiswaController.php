<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use backend\models\Siswa;
use backend\models\SiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

include './inc/table.php';
/**
 * SiswaController implements the CRUD actions for Siswa model.
 */
class SiswaController extends Controller
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
     * Lists all Siswa models.
     * @return mixed
     */
    public function actionIndex(){
                     
        $obj = new Siswa();
        $arrFields = array_keys($obj->attributes); 
        
        return $this->render('index', [
            'arrFields' => $arrFields,                   
        ]);
    }

    /**
     * Displays a single Siswa model.
     * @param string $nis
     * @param string $kode_siswa
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nis, $kode_siswa, $urutan)
    {
        return $this->render('view', [
            'model' => $this->findModel($nis, $kode_siswa, $urutan),
        ]);
    }

    /**
     * Creates a new Siswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionFunctionTable(){
        $arr = array(
            'Title1'
            ,'Title2'
            ,'Title3'
        );
        TablewithCrud($arr);
    }
    public function actionCreate()
    {
        $model = new Siswa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nis' => $model->nis, 'kode_siswa' => $model->kode_siswa, 'urutan' => $model->urutan]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Siswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $nis
     * @param string $kode_siswa
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nis, $kode_siswa, $urutan)
    {
        $model = $this->findModel($nis, $kode_siswa, $urutan);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nis' => $model->nis, 'kode_siswa' => $model->kode_siswa, 'urutan' => $model->urutan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Siswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $nis
     * @param string $kode_siswa
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nis, $kode_siswa, $urutan)
    {
        $this->findModel($nis, $kode_siswa, $urutan)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Siswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $nis
     * @param string $kode_siswa
     * @param integer $urutan
     * @return Siswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nis, $kode_siswa, $urutan)
    {
        if (($model = Siswa::findOne(['nis' => $nis, 'kode_siswa' => $kode_siswa, 'urutan' => $urutan])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
