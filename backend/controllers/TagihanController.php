<?php

namespace backend\controllers;

use Yii;
use backend\models\Tagihan;
use backend\models\TagihanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Spp;
use backend\models\Jurusan;
use backend\models\Kelas;

/**
 * TagihanController implements the CRUD actions for Tagihan model.
 */
class TagihanController extends Controller
{
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
    }

    /**
     * Lists all Tagihan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagihanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tagihan model.
     * @param string $idtagihan
     * @param string $idjurusan
     * @param string $idkelas
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idtagihan,  $idkelas)
    {
        return $this->render('view', [
            'model' => $this->findModel($idtagihan, $idkelas),
        ]);
    }

    /**
     * Creates a new Tagihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionTagihan(){
		$jurusan = $_POST['jurusan'];
		// $jurusan = 'MM';
		
		$model = Kelas::find()
				->joinWith('tahunAjaran')
				->where(['idjurusan'=>$jurusan])
				->All();
		
		
		$zero = '<option value="">- Pilih - </option>';
		foreach($model as $models):			
			$zero .= '<option value="'.$models->idajaran.'">'.$models->tahunAjaran->tahun_ajaran.'</option>';						
		endforeach;
		echo $zero;
		
	}

    public function actionCreate()
    {
        $model = new Tagihan();
		$spp = new Spp();
        if ($model->load(Yii::$app->request->post()) && 
			$spp->load(Yii::$app->request->post())){
			
			function SaveRupiah($val){
				return str_replace('.','',$val);
			}
			
			
			for($i = 1 ; $i <= 12 ; $i++){
				$saveSPP = new Spp();
				$bulan = '';
				switch($i){
					case 1:
						$bulan = 'Juli';
					break;
					case 2 :
						$bulan = 'Agustus';
					break;
					case 3:
						$bulan = 'September';
					break;
					case 4:
						$bulan = 'Oktober';
					break;
					case 5:
						$bulan = 'November';
					break;
					case 6:
						$bulan = 'Desember';
					break;
					case 7:
						$bulan = 'Januari';
					break;
					case 8:
						$bulan = 'Februari';
					break;
					case 9:
						$bulan = 'Maret';
					break;
					case 10:
						$bulan = 'April';
					break;
					case 11:
						$bulan = 'Mei';
					break;
					case 12:
						$bulan = 'Juni';
					break;
				}
				
				$saveSPP->idtagihan = $model->idtagihan;
				$saveSPP->bulan = $bulan;
				$saveSPP->user_create = Yii::$app->user->identity->username;
				$saveSPP->date_create = date('Y-m-d H:i:s');
				$saveSPP->besaran =SaveRupiah($spp->besaran);				
				$saveSPP->save();				
				
			}
			// var_dump(Yii::$app->request->post());
			$find = Kelas::find()
					->where(['idkelas'=>$model->idkelas])
					->One();
			
			$model->administrasi = SaveRupiah($model->administrasi);
			$model->pengembangan = SaveRupiah($model->pengembangan);
			$model->praktik = SaveRupiah($model->praktik);
			$model->semester_a = SaveRupiah($model->semester_a);
			$model->semester_b = SaveRupiah($model->semester_b);
			$model->lab_inggris = SaveRupiah($model->lab_inggris);
			$model->lks = SaveRupiah($model->lks);
			$model->perpustakaan = SaveRupiah($model->perpustakaan);
			$model->osis = SaveRupiah($model->osis);
			$model->mpls = SaveRupiah($model->mpls);
			$model->asuransi = SaveRupiah($model->asuransi);
			$model->date_create = date('Y-m-d H:i:s');
			$model->user_create = Yii::$app->user->identity->username;
			$model->idajaran = $find->idajaran;
			$model->idjurusan = $find->idjurusan;
			$model->save();
            return $this->redirect(['view', 'idtagihan' => $model->idtagihan, 'idjurusan' => $model->idjurusan, 'idkelas' => $model->idkelas]);
        }

        return $this->render('create', [
            'model' => $model,
			'spp' => $spp
        ]);
    }

    /**
     * Updates an existing Tagihan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idtagihan
     * @param string $idjurusan
     * @param string $idkelas
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idtagihan, $idkelas)
    {
        $model = $this->findModel($idtagihan, $idkelas);
		$spp = Spp::find()
			   ->where(['idtagihan'=>$idtagihan])
			   ->One();
		
        if ($model->load(Yii::$app->request->post()) && 			 
			$spp->load(Yii::$app->request->post())){
			function SaveRupiah($val){
				return str_replace('.','',$val);
			}
			
			
			$delSpp = Spp::find()->where(['idtagihan'=>$idtagihan])->All();
			foreach($delSpp as $delSpps):
				$delSpps->delete();
			endforeach;
			
			for($i = 1 ; $i <= 12 ; $i++){
				$saveSPP = new Spp();
				$bulan = '';
				switch($i){
					case 1:
						$bulan = 'Juli';
					break;
					case 2 :
						$bulan = 'Agustus';
					break;
					case 3:
						$bulan = 'September';
					break;
					case 4:
						$bulan = 'Oktober';
					break;
					case 5:
						$bulan = 'November';
					break;
					case 6:
						$bulan = 'Desember';
					break;
					case 7:
						$bulan = 'Januari';
					break;
					case 8:
						$bulan = 'Februari';
					break;
					case 9:
						$bulan = 'Maret';
					break;
					case 10:
						$bulan = 'April';
					break;
					case 11:
						$bulan = 'Mei';
					break;
					case 12:
						$bulan = 'Juni';
					break;
				}
				
				$saveSPP->idtagihan = $model->idtagihan;
				$saveSPP->bulan = $bulan;
				$saveSPP->user_create = $spp->user_create;
				$saveSPP->date_create = $spp->date_create;
				$saveSPP->besaran =SaveRupiah($spp->besaran);	
				$saveSPP->date_update = date('Y-m-d H:i:s');
				$saveSPP->user_update = Yii::$app->user->identity->username;
				$saveSPP->save();				
				
			}
			
			$model->administrasi = SaveRupiah($model->administrasi);
			$model->pengembangan = SaveRupiah($model->pengembangan);
			$model->praktik = SaveRupiah($model->praktik);
			$model->semester_a = SaveRupiah($model->semester_a);
			$model->semester_b = SaveRupiah($model->semester_b);
			$model->lab_inggris = SaveRupiah($model->lab_inggris);
			$model->lks = SaveRupiah($model->lks);
			$model->perpustakaan = SaveRupiah($model->perpustakaan);
			$model->osis = SaveRupiah($model->osis);
			$model->mpls = SaveRupiah($model->mpls);
			$model->asuransi = SaveRupiah($model->asuransi);
			$model->date_update = date('Y-m-d H:i:s');
			$model->user_update = Yii::$app->user->identity->username;
			$model->idajaran = $_POST['idajaran'];
			$model->save();
			
            return $this->redirect(['view', 'idtagihan' => $model->idtagihan, 'idjurusan' => $model->idjurusan, 'idkelas' => $model->idkelas]);
        }

        return $this->render('update', [
            'model' => $model,
			'spp' => $spp
        ]);
    }

    /**
     * Deletes an existing Tagihan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $idtagihan
     * @param string $idjurusan
     * @param string $idkelas
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idtagihan, $idjurusan, $idkelas)
    {
        $this->findModel($idtagihan,  $idkelas)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tagihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $idtagihan
     * @param string $idjurusan
     * @param string $idkelas
     * @return Tagihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idtagihan,  $idkelas)
    {
        if (($model = Tagihan::findOne(['idtagihan' => $idtagihan,  'idkelas' => $idkelas])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
