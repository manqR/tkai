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



include './inc/table.php';
include './inc/models.php';        
       
class KelasSiswaController extends \yii\web\Controller
{

    public function behaviors(){
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
            'arrFieldsAksi'=>AttributeKelasSiswaWithAksi()
        ]);
    }

}
