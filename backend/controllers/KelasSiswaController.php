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

    
    public function actionIndex(){

        include './inc/table.php';
        include './inc/models.php';     

        $ThAjaran = TahunAjaran::find()
            ->Where(['flag'=>1])
            ->OrderBy(['idtahun_ajaran'=>SORT_DESC])
            ->One();
        $ajaran = TahunAjaran::find()
                ->all();

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
            'ajaran' => $ajaran,
            'arrFields' => AttributeKelasSiswa(), 
            'arrFieldsAksi'=>AttributeKelasSiswaWithAksi()
        ]);
    }

    public function actionExport($key){
        $path = Yii::getAlias("@vendor/phpExcel/Classes/PHPExcel.php");
        require $path;

       
        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Taman Kreativitas Anak")
                                    ->setLastModifiedBy("Taman Kreativitas Anak")
                                    ->setTitle("Office 2007 XLSX Test Document")
                                    ->setSubject("Office 2007 XLSX Test Document")
                                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Test result file");


        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Kode Siswa');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'NIS');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Nama Siswa');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Kode Tagihan');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Kelas');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'key_');       
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Tahun Ajaran');

        
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT c.*, a.key_ , a.kode, a.tahun_ajaran 
                                           FROM kelas a 
                                           JOIN  detil_kelas b ON a.key_ = b.key_ 
                                           JOIN siswa c ON b.kode_siswa = c.kode_siswa
                                           WHERE a.key_ = '".$key."'");
        $model = $sql->queryAll();  

        $i = 1;
        foreach($model as $models):           
           $i++;  

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $models['kode_siswa']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $models['nis']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $models['nama_lengkap']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, '');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $models['kode']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $models['key_']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $models['tahun_ajaran']);
            
        endforeach;
     
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Data Siswa');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$key.'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 May 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        // header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit();



    }
    

}
