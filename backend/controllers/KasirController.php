<?php

namespace backend\controllers;

use Yii;
use backend\models\Cart;
use backend\models\CartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Siswa;
use backend\models\TagihanBiayaTidaktetap;
use backend\models\TagihanSiswa;
use yii\web\Response;

/**
 * KasirController implements the CRUD actions for Cart model.
 */
class KasirController extends Controller
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
     * Lists all Cart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Siswa::find()
                ->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }


    public function actionCart($id){
        $connection = \Yii::$app->db;
		$query = $connection->createCommand("SELECT * FROM v_tagihan_siswa a LEFT JOIN kelas b ON a.idkelas = b.idkelas  LEFT JOIN tahun_ajaran c ON b.idajaran = c.idajaran LEFT JOIN kelas_group d ON b.idkelas = d.idkelas
        WHERE idsiswa = '".$id."'  AND (
                                                    (d.idgroup NOT IN (SELECT x.idgroup FROM tagihan_siswa x WHERE x.idsiswa= '".$id."' AND a.key_ = x.nama_tagihan) )
                                                        AND
                                                    (a.key_ NOT IN (SELECT y.no_tagihan FROM tagihan_biaya_tidaktetap y WHERE y.idsiswa = '".$id."' AND y.flag = 1))
                                                )
        ORDER BY c.idajaran ASC
        
        ");
		$data = $query->queryAll();
        
        $output = array();
		
        foreach($data as $key => $models):
            
            $kelas = isset($models['idkelas']) ? $models['idkelas'] : 'X';
            $aksi = '<i class="material-icons tambah" aria-hidden="true" data-id="'.$models['key_'].';'.$kelas.';'.$models['idsiswa'].'">add_box</i>';
			$output[$key] = array($models['idsiswa']
								 ,$models['keterangan']
								 ,$models['nominal']
                                 ,isset($models['tahun_ajaran']) ? $models['tahun_ajaran'] : '-'
                                 ,$aksi);
		endforeach;
		
		
		    $data = json_encode($output);
			$data = [
				'data'=>$output
			];
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $data;
			
    }


    public function actionPost(){
        $model = new Cart();
        
        $arrData = $_POST['data'];

        // $arrData = 'praktik;6;176001';
        $arrData = explode(';',$arrData);
        
        if(stripos($arrData[0], 'BIL') !== FALSE){
            $find = TagihanBiayaTidaktetap::find()
                ->where(['no_tagihan'=>$arrData[0]])
                ->One();
        }else{
            $connection = \Yii::$app->db;
            $query = $connection->createCommand("SELECT * FROM v_tagihan_siswa WHERE idsiswa = '".$arrData[2]."' AND idkelas = '".$arrData[1]."' AND key_ = '".$arrData[0]."'");
            $find = $query->queryOne();
        }

        $model->idsiswa = $arrData[2];
        $model->key_ = $arrData[0];
        $model->idkelas = $arrData[1];
        $model->keterangan = $arrData[0];
        $model->nominal = isset($find->nominal) ? $find->nominal : $find['nominal'];
        $model->flag = 1;
        $model->user_create = Yii::$app->user->identity->username;
        $model->date_create = date('Y-m-d');

        if($model->save()){           

            $data = ['err'=>'sukses'];			
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }else{
            $data = ['err'=>'err'];			
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

       
    }

    public function actionPrint($id){
 
        // $idsiswa = $_POST['data']; 
        
        $idsiswa = $id;
        
        $connection = \Yii::$app->db;
        $query = $connection->createCommand("SELECT a.* ,c.idgroup,b.nama_kelas FROM cart a LEFT JOIN kelas b ON a.idkelas = b.idkelas LEFT JOIN kelas_group c ON b.idkelas = c.idkelas WHERE a.idsiswa = '".$idsiswa."' AND a.flag = 1");
        $model = $query->queryAll();

        if($model){
        $sum = 0;
        $data='';
        foreach($model as $models):           
            $data .= ' <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
                $data .= '<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">'.$models['keterangan'].'</td>';
                $data .= '<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">1</td>';
                $data .= '<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">'.$models['nama_kelas'].'</td>';
                $data .= '<td class="alignright" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" align="right" valign="top">'.number_format($models['nominal'],0,".",".").'</td>';
            $data .= '</tr>';
            
            $sum+= $models['nominal'];
          
        endforeach;

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
		
        
        $mpdf->WriteHTML('<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <head>
                                    <meta name="viewport" content="width=device-width" />
                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                    <title>Billing e.g. invoices and receipts</title>
                                    
                                </head>
                                <body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #FFF; margin: 0;" bgcolor="#FFF">
                                    <table class="body-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #FFF; margin: 0;" bgcolor="#FFF">
                                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                            <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                            <td class="container" width="100%" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                                                <div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                                                    <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #FFF;" bgcolor="#fff">
                                                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td class="content-wrap aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;" align="center" valign="top">
                                                                <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                    <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                        <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                        <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl='.$idsiswa.'&choe=UTF-8" style="width:100px" title="'.$idsiswa.'>" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                        <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                            <h2 class="aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif; box-sizing: border-box; font-size: 24px; color: #000; line-height: 1.2em; font-weight: 400; text-align: center; margin: 40px 0 0;" align="center">SMK MALAKA</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                        <td class="content-block aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
                                                                            <table class="invoice" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 100%; margin: 40px auto;">
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">Nomor </td>                                                                                    
                                                                                    <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: 769/ SMK M. /VIII / 2018</td>
                                                                                </tr>
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">Lampiran </td>                                                                                    
                                                                                    <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: </td>
                                                                                </tr>
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">Perihal </td>                                                                                    
                                                                                    <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: <b>Pemberitahuan Tunggakan</b></td>
                                                                                </tr>                                                                               
                                                                               <tr>
                                                                                    <td colspan="4"></td>
                                                                               </tr>
                                                                               <tr>
                                                                                    <td colspan="4"></td>
                                                                               </tr>
                                                                               <tr>
                                                                                    <td colspan="4"></td>
                                                                               </tr>
                                                                               <tr>
                                                                                    <td colspan="4"></td>
                                                                               </tr>
                                                                               <tr>
                                                                                    <td colspan="4"></td>
                                                                               </tr>
                                                                               <tr>
                                                                                    <td colspan="4"></td>
                                                                               </tr>
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td colspan="4" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">Kepada Yth, </td>                                                                                   
                                                                                </tr>  
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td colspan="4" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">Bapak/Ibu Orang Tua/Wali Siswa dari : </td>                                                                                   
                                                                                </tr>  
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td></td>                                                                                   
                                                                                    <td>Nama </td>                                                                                   
                                                                                    <td>: Aulia Afifah </td>                                                                                   
                                                                                    <td></td>                                                                                   
                                                                                </tr>  
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td></td>                                                                                   
                                                                                    <td>Kelas / Jurusan </td>                                                                                   
                                                                                    <td>: '.$model[0]['nama_kelas'].' </td>                                                                                   
                                                                                    <td></td>                                                                                   
                                                                                </tr>
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td colspan="4" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">di - </td>                                                                                   
                                                                                </tr>   
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td colspan="4" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">Tempat <br/> Dengan Hormat, </td>                                                                                   
                                                                                </tr>   
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td colspan="4" style="text-align: justify;font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">Bersama ini kami sampaikan bahwa Tahun 
                                                                                    Pelajaran 2018/2019 telah berjalan kurang lebih 2 (dua) bulan. Untuk itu, 
                                                                                    demi kelancaran Kegiatan Belajar Mengajar dan Kegiatan Administrasi lainnya,
                                                                                     kami mohon kepada bapak/ibu/wali Siswa/i SMK Malaka yang masih memiliki <b>Tunggakan</b> 
                                                                                     untuk segera melunasi <b>Tunggakan yang masih ada di kelas sebelumnya</b>. 
                                                                                     Perinician ada pada lampirah halaman ke 2. <br/><br/> Kami mohon Bapak/Ibu segera menyelesaikan kewajiban keuangan tersebut.<br/> 
                                                                                     Demikian Pemberitahuan ini kami sampaikan, atas perhatian dan kerja samanya diucapkan terima kasih.<br/></td>                                                                                   
                                                                                </tr>
                                                                                
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td></td>                                                                                   
                                                                                    <td></td>                                                                                   
                                                                                    <td> </td>                                                                                   
                                                                                    <td style="text-align:center;"><br/><br/><br/><br/><br/>Jakarta, '.date('d M Y').'</td>                                                                                   
                                                                                </tr>
                                                                                <tr style="tex-align:center;font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td></td>                                                                                   
                                                                                    <td></td>                                                                                   
                                                                                    <td> </td>                                                                                   
                                                                                    <td style="text-align:center;">Kepala Sekolah SMK Malaka<br/><br/><br/><br/><br/>Heru Wulandro , S.Si</td>                                                                                   
                                                                                </tr>
                                                                                <tr style="tex-align:center;font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td><br/><br/><u>Tembusan :</u><br/>1. Yayasan Budi Utomo<br/>2. Keuangan<br/>3. Arsip</td>                                                                                   
                                                                                    <td></td>                                                                                   
                                                                                    <td></td>                                                                                   
                                                                                    <td></td>                                                                                   
                                                                                    
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                        <td class="content-block aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">                                                
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                
                                                </div>
                                            </td>
                                            <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                        </tr>
                                    </table>
                                </body>
                            </html>');
        $mpdf->AddPage();
		$mpdf->WriteHTML(' <html xmlns="http://www.w3.org/1999/xhtml" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <head>
                                    <meta name="viewport" content="width=device-width" />
                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                    <title>Billing e.g. invoices and receipts</title>
                                    
                                </head>
                                <body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #FFF; margin: 0;" bgcolor="#FFF">
                                    <table class="body-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #FFF; margin: 0;" bgcolor="#FFF">
                                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                            <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                            <td class="container" width="100%" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                                                <div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                                                    <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #FFF;" bgcolor="#fff">
                                                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td class="content-wrap aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;" align="center" valign="top">
                                                                <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                    <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                        <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                        <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl='.$idsiswa.'&choe=UTF-8" style="width:100px" title="'.$idsiswa.'>" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                        <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                            <h2 class="aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif; box-sizing: border-box; font-size: 24px; color: #000; line-height: 1.2em; font-weight: 400; text-align: center; margin: 40px 0 0;" align="center">SMK MALAKA</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                        <td class="content-block aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
                                                                            <table class="invoice" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 80%; margin: 40px auto;">
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">'.$idsiswa.'<br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />769/ SMK M. /VIII / 2018<br style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />'.date('d M Y').'</td>
                                                                                </tr>
                                                                                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                    <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                                                                        <table class="invoice-items" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;">
                                                                                                '.$data.'
                                                                                        
                                                                                            <tr class="total" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                                <td class="alignright" colspan="3" width="80%" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top">Total</td>
                                                                                                <td class="alignright" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top">'.number_format($sum,0,".",".").'</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                        <td class="content-block aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">                                                
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                        <td class="content-block aligncenter" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
                                                                        <br/> 
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                
                                                </div>
                                            </td>
                                            <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                        </tr>
                                    </table>
                                </body>
                            </html>');

			// $mpdf->WriteHTML('Hello World');

			$mpdf->Output();
		exit;

    }else{
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML('-');
        $mpdf->Output();
        exit;
    }

       
    }

    public function actionList($id){
        $view = Cart::find()
            ->where(['idsiswa'=>$id])
            ->AndWhere(['flag'=>1])
            ->all();    
        
            // var_dump($view);
        if($view){
            foreach($view as $views):
                echo "<tr>
                         <td>".$views->idsiswa."</td>
                         <td>".$views->keterangan."</td>
                         <td>".number_format($views->nominal,0,".",".")."</td>
                         <td>1</td>
                     </tr>";                                               
            endforeach;
        }else{
            echo " <tr>
                    <td colspan=\"4\" class=\"text-xs-center\">No data available in table</td>
                </tr>";
        }
        
    }

    public function actionJumlahList($id){
        $nominal = Cart::find()
            ->where(['idsiswa'=>$id])    
            ->AndWhere(['flag'=>1])        
            ->sum('nominal');    
        
            echo "<div class=\"invoice-totals-row\">
                         <strong class=\"invoice-totals-title\">Subtotal</strong>
                         <span class=\"invoice-totals-value\"><b>Rp ".number_format($nominal,0,".",".")."</b></span>
                         <input type='hidden' id='nominal' name='nominal' value=".$nominal.">
                     </div>
                     
                   ";     
    }
    /**
     * Displays a single Cart model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionCheckout(){

        $idsiswa = $_POST['data'];

        // $idsiswa = '176002';
        $connection = \Yii::$app->db;
        $query = $connection->createCommand("SELECT a.* ,c.idgroup FROM cart a LEFT JOIN kelas b ON a.idkelas = b.idkelas LEFT JOIN kelas_group c ON b.idkelas = c.idkelas WHERE a.idsiswa = '".$idsiswa."'");
        $model = $query->queryAll();

       foreach($model as $models):
            // var_dump($models);
            if($models['idkelas'] == 'X'){
                $add =  TagihanBiayaTidaktetap::find()
                        ->where(['no_tagihan'=>$models['key_']])
                        ->One();

                $add->flag = 1;
                $add->tgl_payment = date('Y-m-d H:i:s');
                $add->user = Yii::$app->user->identity->username;
                $add->save();  
                
                $update = Cart::findOne($models['idcart']);
                $update->flag = 2;
                $update->save();                        
            }else{
                $add = new TagihanSiswa();
                $add->idsiswa = $models['idsiswa'];
                $add->idgroup = $models['idgroup'];
                $add->nama_tagihan = $models['key_'];
                $add->besaran = $models['nominal'];
                $add->keterangan = $models['keterangan'];
                $add->user_create = Yii::$app->user->identity->username;
                $add->date_create = date('Y-m-d H:i:s');
                $add->save();

                $update = Cart::findOne($models['idcart']);
                $update->flag = 2;
                $update->save();
            }

       endforeach;

       $data = ['err'=>'sukses'];			
       Yii::$app->response->format = Response::FORMAT_JSON;
       return $data;

    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cart();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idcart]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idcart]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
