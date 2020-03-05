<?php

namespace backend\controllers;

use Yii;
use backend\models\Kuitansi;
use backend\models\Cart;
use backend\models\TagihanSiswaSpp;
use backend\models\TagihanSiswa;
use backend\models\TagihanSiswaLain;
use backend\models\KuitansiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KuitansiController implements the CRUD actions for Kuitansi model.
 */
class KuitansiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
               
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
     * Lists all Kuitansi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KuitansiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kuitansi model.
     * @param string $no_kuitansi
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($no_kuitansi, $urutan)
    {
        return $this->render('view', [
            'model' => $this->findModel($no_kuitansi, $urutan),
        ]);
    }

    /**
     * Creates a new Kuitansi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kuitansi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'no_kuitansi' => $model->no_kuitansi, 'urutan' => $model->urutan]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kuitansi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $no_kuitansi
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($no_kuitansi, $urutan)
    {
        $model = $this->findModel($no_kuitansi, $urutan);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'no_kuitansi' => $model->no_kuitansi, 'urutan' => $model->urutan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Kuitansi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $no_kuitansi
     * @param integer $urutan
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($no_kuitansi, $urutan)
    {
        $this->findModel($no_kuitansi, $urutan)->delete();

        return $this->redirect(['index']);
    }

    public function actionVoid($no_kuitansi, $x){
        if($_POST){
            $model = Kuitansi::findOne(['no_kuitansi'=>$no_kuitansi,'urutan'=>$x]);
            $model2 = Cart::findOne(['urutan'=>$model->idcart]);
       
            $model->flag = 3;
            $model->save(false);
            
            $model2->flag = 3;
            $model2->save(false);
            
            if($model->keterangan == 'spp'){
                $tagihan = TagihanSiswaSpp::findOne(['idtagihan'=>$model->idtagihan,'bulan'=>$model->remarks,'kode_siswa'=>$model->kode_siswa]);
                $tagihan->nominal = $tagihan->nominal + $model->nominal;
                $tagihan->flag = 1;
                $tagihan->user_update = Yii::$app->user->identity->username;
                $tagihan->date_update = date('Y-m-d H:i:s');
                $tagihan->save(false);

            }else if($model->keterangan == 'tagihan'){
                $tagihan = TagihanSiswa::findOne(['idtagihan'=>$model->idtagihan,'kode_siswa'=>$model->kode_siswa]);
                $name = $model2->remarks;
                $tagihan[$name] =  $tagihan[$name] + $model->nominal;
                $tagihan->save(false);
                // var_dump($name);
                // die;
            }else{
                $tagihan = TagihanSiswaLain::findOne(['idtagihan'=>$model->idtagihan,'kode_siswa'=>$model->kode_siswa]);
                $tagihan->nominal = $tagihan->nominal + $model->nominal;               
                $tagihan->save(false);
            }
            return $this->redirect(['index']);
            // var_dump($model->keterangan);
        }
    }

    /**
     * Finds the Kuitansi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $no_kuitansi
     * @param integer $urutan
     * @return Kuitansi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($no_kuitansi, $urutan)
    {
        if (($model = Kuitansi::findOne(['no_kuitansi' => $no_kuitansi, 'urutan' => $urutan])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
