<?php

namespace backend\controllers;

use Yii;
use yii\web\UploadedFile;
use backend\models\Import;
use backend\models\BiayaTidakTetap;
use backend\models\TagihanBiayaTidaktetap;

class UploadController extends \yii\web\Controller
{
    // public function beforeAction($action) {
    //     $this->enableCsrfValidation = false;
    //     return parent::beforeAction($action);
    // }

    public function actionIndex()
    {
        $model = new Import();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->file = UploadedFile::getInstance($model, 'file');

            if ( $model->file )
                {

                    $time = time();
                    $model->file->saveAs('import/' .$time. '.' . $model->file->extension);
                    $model->file = 'import/' .$time. '.' . $model->file->extension;

                     $handle = fopen($model->file, "r");
                     while (($fileop = fgetcsv($handle, 1000, ";")) !== false) 
                     {
                         if($model->kategori == 'master'){
                             $master = new BiayaTidakTetap();

                             $master->keterangan = $fileop[0];
                             $master->nominal = $fileop[1];
                             $master->user_created = Yii::$app->user->identity->username;
                             $master->date_created = date('Y-m-d H:i:s');
                             $master->save();

                         }else{
                            $tagihan = new TagihanBiayaTidaktetap();
                            
                            $tagihan->idbiaya = $fileop[0];
                            $tagihan->no_tagihan = $fileop[1];
                            $tagihan->idsiswa = $fileop[2];
                            $tagihan->keterangan = $fileop[3];
                            $tagihan->nominal = $fileop[4];
                            $tagihan->flag = $fileop[5];
                            $tagihan->tgl_assign = date('Y-m-d H:i:s',strtotime($fileop[6]));
                            $tagihan->tgl_payment = date('Y-m-d H:i:s',strtotime($fileop[7]));
                            $tagihan->user = $fileop[8];

                            $tagihan->save(false);

                         }
                        //  var_dump($fileop);
                        // $name = $fileop[0];
                        // $age = $fileop[1];
                        // $location = $fileop[2];
                        // // print_r($fileop);exit();
                        // $sql = "INSERT INTO details(name, age, location) VALUES ('$name', '$age', '$location')";
                        // $query = Yii::$app->db->createCommand($sql)->execute();
                     }

                    //  if ($query) 
                    //  {
                    //     echo "data upload successfully";
                    //  }

                }

            // $model->save();
            // return $this->redirect(['index', 'id' => $model->id]);
            return $this->render('index', [
                'model' => $model,
            ]);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
     

    public function actionUpload(){
        $_POST;
        $model = $_POST['model'];
        UploadedFile::getInstance($_POST['file'], 'file');
        var_dump($_POST);
        // $_POST['file'] = UploadedFile::getInstance($_POST, $_POST['file']);

        // if($_POST['file']){
        //     if($model == 'tagihan'){
        //         $time = time();
        //         $_POST['file']->saveAs('import/' .$time. '.' . $_POST['file']->extension);
        //         $_POST['file'] = 'import/' .$time. '.' . $_POST['file']->extension;

        //          $handle = fopen($_POST['file'], "r");
        //          while (($fileop = fgetcsv($handle, 1000, ",")) !== false) 
        //          {
        //              var_dump($fileop);
        //             // $name = $fileop[0];
        //             // $age = $fileop[1];
        //             // $location = $fileop[2];
        //             // // print_r($fileop);exit();
        //             // $sql = "INSERT INTO details(name, age, location) VALUES ('$name', '$age', '$location')";
        //             // $query = Yii::$app->db->createCommand($sql)->execute();
        //          }

        //         //  if ($query) 
        //         //  {
        //         //     echo "data upload successfully";
        //         //  }

        //     }else{
        //         echo"bbb";
        //     }
        
    }

}
