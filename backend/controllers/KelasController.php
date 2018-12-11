<?php

namespace backend\controllers;

use Yii;
use backend\models\Kelas;
use backend\models\TahunAjaran;
use backend\models\Cabang;
use backend\models\Kategori;
use backend\models\KelasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KelasController implements the CRUD actions for Kelas model.
 */

include './inc/table.php';
include './inc/models.php';        
       
class KelasController extends Controller
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
     * Lists all Kelas models.
     * @return mixed
     */
    public function actionIndex()
    {

        $ThAjaran = TahunAjaran::find()
            ->Where(['flag'=>1])
            ->One();
        $grade = Kategori::find()
            ->All();
        if(Yii::$app->user->identity->cabang == 0){
            $Cabang = Cabang::find()
                ->All();         
            $model = Kelas::find()
                ->Where(['tahun_ajaran'=>$ThAjaran])            
                ->All();
            $count = Cabang::find()
                ->count();
        }else{
            $Cabang = Cabang::find()
                ->Where(['idcabang'=>Yii::$app->user->identity->cabang])
                ->All();
            $model = Kelas::find()
                ->Where(['tahun_ajaran'=>$ThAjaran]) 
                ->AndWhere(['idcabang'=>Yii::$app->user->identity->cabang])           
                ->All();            
            $count = Cabang::find()
            ->Where(['idcabang'=>Yii::$app->user->identity->cabang])
            ->count();    
        }
                
        return $this->render('index', [
            'model' => $model,
            'cabang' =>$Cabang,
            'count'=>$count,
            'grade'=>$grade,
            'arrFields' => AttributeKelasSiswa(), 
        ]);
    }

    /**
     * Displays a single Kelas model.
     * @param string $key_
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key_, $urutan)
    {
        return $this->render('view', [
            'model' => $this->findModel($key_, $urutan),
        ]);
    }

    /**
     * Creates a new Kelas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kelas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'key_' => $model->key_, 'urutan' => $model->urutan]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kelas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $key_
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($key_, $urutan)
    {
        $model = $this->findModel($key_, $urutan);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'key_' => $model->key_, 'urutan' => $model->urutan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Kelas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $key_
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key_, $urutan)
    {
        $this->findModel($key_, $urutan)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $key_
     * @param integer $urutan
     * @return Kelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($key_, $urutan)
    {
        if (($model = Kelas::findOne(['key_' => $key_, 'urutan' => $urutan])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
