<?php

namespace backend\controllers;


use backend\models\Spp;

class KeuanganController extends \yii\web\Controller
{
    public function actionIndex(){       
        $connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT DISTINCT b.tahun_ajaran, b.idajaran FROM tagihan a JOIN tahun_ajaran b ON a.idajaran = b.idajaran AND b.`status` = 1 ORDER BY b.idajaran ASC");
        $model = $sql->queryAll();
        
        return $this->render('index',[
            'model'=>$model
        ]);
    }

    public function actionOnchangeAjaran($id){
        $connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT DISTINCT a.kode, a.nama_kelas FROM  kelas a JOIN v_pelunasan_tagihan b ON a.idajaran = ajaran WHERE a.idajaran = '".$id."'");
        $model = $sql->queryAll();
        $default = "<option value='-' selected>- All -</option> ";

        if($model){
                
            foreach($model as $models):
                 $default .= "<option value=".$models['kode'].">".$models['nama_kelas']."</option>";
            endforeach;

            return $default;
        }
        
    }
    public function actionPostdata(){

        if($_POST){
            $filter = '';

            if($_POST['kelas'] !='-'){
                $filter = " AND  kode = '".$_POST['kelas']."' ";
            }
            $date = explode(';',$_POST['periode']);

            if($_POST['kategori'] == 'spp'){
                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT * FROM v_pelunasan_spp WHERE idajaran= ".$_POST['tahun_ajaran']."  AND date_create BETWEEN '".$date[0]."' AND '".$date[1]."' ".$filter."");
                $model = $sql->queryAll();
              
                $data = '';
                $sum =0;
                foreach($model as $models):
                    if($models){
                        $sum += $models['besaran'];
                        $data .= '<tr><td>'.$models['idsiswa'].'</td>
                                 <td>'.$models['nama_kelas'].'</td>
                                 <td>'.$models['idjurusan'].'</td>
                                 <td>'.$models['bulan'].'</td>
                                 <td>'.number_format($models['besaran'],0,".",".").'</td>
                                </tr>
                                 <input type="hidden" value='.$sum.'> name="total"';                        
                    }else{
                        $data .= '<td coslpan="4">Data Tidak ditemukan</td>';
                    }                                                
                       
                endforeach;
                               
                return $data;
            }else{

               
                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT * FROM v_pelunasan_tagihan a JOIN kelas b ON a.ajaran = b.idajaran WHERE (ajaran= ".$_POST['tahun_ajaran']." OR ajaran = '-') AND tgl_payment BETWEEN '".$date[0]."' AND '".$date[1]."' ".$filter."");
                $model = $sql->queryAll();
                // $sql = "SELECT * FROM v_pelunasan_tagihan a JOIN kelas b ON a.ajaran = b.idajaran WHERE (ajaran= ".$_POST['tahun_ajaran']." OR ajaran = '-') AND tgl_payment BETWEEN '".$date[0]."' AND '".$date[1]."' ".$filter."";
                // echo $sql;
                // die;
                $arr = '';
                foreach($model as $models):
                    if($models){

                        $arr .=  '<tr><td>'.$models['idsiswa'].'</td>
                                 <td>'.$models['nama_kelas'].'</td>
                                 <td>'.$models['idjurusan'].'</td>
                                 <td>'.$models['keterangan'].'</td>
                                 <td>'.number_format($models['nominal'],0,".",".").'</td>
                                </tr>';                        
                    }else{
                        $arr =  '<tr><td coslpan="4">Data Tidak ditemukan</td></tr>';
                    }                                                
                       
                endforeach;
                return $arr;
            }
       }else{
            return "<p style='font-size:12px'>Method Not Allowed..</p>";
        }

       
    }

    public function actionPrint($kat, $th){
        if($kat){
            
            if($kat == 'spp'){

                include './inc/pdf.php';
                PrintLaporan($kat,$th);                            
            }else{
                include './inc/pdf.php';
                PrintLaporan($kat,$th);
            }
        }else{
            return "<p style='font-size:12px'>Method Not Allowed..</p>";
        }
    }

}
