<?php

use backend\models\Kuitansi;
use backend\models\Siswa;

include 'inc/money.php';

function PrintExcel($periode){
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
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'No');
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'No Transaksi');
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Tanggal Transaksi');
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'NIS');
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Nama');
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Grade');
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Nama Biaya');       
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Keterangan');
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Nominal');

      
      $title = '';
      $filter = '';
      if($periode == 1){
          $title = 'HARIAN';
          $filter = 'WHERE DATE(date) = "'.date('Y-m-d').'"';
      }else if($periode == 2){
          $title = 'BULANAN';
          $filter = 'WHERE DATE(date) BETWEEN "'.date('Y-m-d', strtotime('-30 days')).'" AND "'.date('Y-m-d').'"';
      }else if($periode == 3){
          $title = 'TAHUNAN';
          $filter = 'WHERE DATE(date) BETWEEN "'.date('Y-m-d', strtotime('-1 year')).'" AND "'.date('Y-m-d').'"';
      }

      
      $connection = \Yii::$app->db;
      $sql = $connection->createCommand("SELECT * FROM kuitansi ".$filter);
      $model = $sql->queryAll();


      $i = 1;
      $sum = 0;
      foreach($model as $models):    
        $siswa = Siswa::find()
                ->joinWith('kategori')
                ->where(['kode_siswa'=>$models['kode_siswa']])
                ->One();
        $i++;  

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $i-1);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $models['no_kuitansi']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $models['date']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $siswa->nis);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $siswa->nama_lengkap);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $siswa->kategori->keterangan);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $models['remarks']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, $models['payment_method']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, $models['nominal']);

        $sum += $models['nominal'];
          
      endforeach;
   
      // Rename worksheet
      $objPHPExcel->getActiveSheet()->setTitle('Laporan Keuangan');


      // Set active sheet index to the first sheet, so Excel opens this as the first sheet
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirect output to a client’s web browser (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Laporan Keuangan '.$title.'.xlsx"');
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
?>