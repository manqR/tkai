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
            $model->kode_siswa = $model->idcabang.'-'.$nis.'-'.$model->idkategori;
            // var_dump($model);
            $model->tgl_input = date('Y-m-d H:i:s');
            $model->tahun_input = date('Y');
            $model->save();
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
