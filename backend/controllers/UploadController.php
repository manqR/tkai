<?php

namespace backend\controllers;

use Yii;
use yii\web\UploadedFile;
use backend\models\Import;
use backend\models\TagihanLain;
use backend\models\TagihanSiswaLain;

class UploadController extends \yii\web\Controller
{
    // public function beforeAction($action) {
    //     $this->enableCsrfValidation = false;
    //     return parent::beforeAction($action);
    // }

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
    
    function getnominal($kode){

        $tagihan = TagihanLain::findOne(['idtagihan'=>$kode]);
        return $tagihan;
        // var_dump($tagihan);

    }
    
    public function actionIndex()
    {
        $model = new Import();
        
        $path = Yii::getAlias("@vendor/excelReader/src/SimpleXLSX.php");
        require $path; 

        if ($model->load(Yii::$app->request->post()) ) {

            $model->filename = UploadedFile::getInstance($model, 'filename');

            if ( $model->filename ){

                    
                $model->filename->saveAs('import/' .$model->filename. '.' . $model->filename->extension);
                $model->filename = 'import/' .$model->filename. '.' . $model->filename->extension;  
                
                if ( $xlsx = \SimpleXLSX::parse($model->filename) ) {
                    $i = 2;
                    foreach($xlsx->rows() as $r):

                        
                        if($xlsx->getCell(0,'A'.$i)){;
                            
                            $kode = $xlsx->getCell(0,'D'.$i);
                            $tagihan = TagihanLain::findOne(['idtagihan'=>$kode]);
                            $upload = new TagihanSiswaLain();

                            $upload->kode_siswa = $xlsx->getCell(0,'A'.$i);
                            $upload->kode_kelas = $xlsx->getCell(0,'E'.$i);
                            $upload->idtagihan = $xlsx->getCell(0,'D'.$i);
                            $upload->nominal = (isset($tagihan->nominal) ? $tagihan->nominal : '');
                            $upload->tahun_ajaran = $xlsx->getCell(0,'G'.$i);
                            $upload->key_ = $xlsx->getCell(0,'F'.$i);
                            $upload->assign_by = Yii::$app->user->identity->username;
                            $upload->assign_date = date('Y-m-d H:i:s');
                            $i++;
                            $upload->save(false);
                        }
                    
                    endforeach;

                    Yii::$app->session->setFlash('success');
                    return $this->redirect(['index']);

                } else {
                    echo \SimpleXLSX::parseError();
                }
            }

        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
     

   

    // public function actionUpload(){

    //     if ($model->load(Yii::$app->request->post())){
    //         var_dump($model);
    //     }
    //     // $_POST;
    //     // $model = $_POST['model'];
    //     // UploadedFile::getInstance($_POST['file'], 'file');
    //     // var_dump($_POST);
    //     // $_POST['file'] = UploadedFile::getInstance($_POST, $_POST['file']);

    //     // if($_POST['file']){
    //     //     if($model == 'tagihan'){
    //     //         $time = time();
    //     //         $_POST['file']->saveAs('import/' .$time. '.' . $_POST['file']->extension);
    //     //         $_POST['file'] = 'import/' .$time. '.' . $_POST['file']->extension;

    //     //          $handle = fopen($_POST['file'], "r");
    //     //          while (($fileop = fgetcsv($handle, 1000, ",")) !== false) 
    //     //          {
    //     //              var_dump($fileop);
    //     //             // $name = $fileop[0];
    //     //             // $age = $fileop[1];
    //     //             // $location = $fileop[2];
    //     //             // // print_r($fileop);exit();
    //     //             // $sql = "INSERT INTO details(name, age, location) VALUES ('$name', '$age', '$location')";
    //     //             // $query = Yii::$app->db->createCommand($sql)->execute();
    //     //          }

    //     //         //  if ($query) 
    //     //         //  {
    //     //         //     echo "data upload successfully";
    //     //         //  }

    //     //     }else{
    //     //         echo"bbb";
    //     //     }
        
    // }

}
