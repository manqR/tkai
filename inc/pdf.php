<?php


use backend\models\Kuitansi;
use backend\models\Siswa;

include 'inc/money.php';

   function PrintRegKuitansi($no_kuitansi){
    $head = '<style>
                img{
                    float: left;
                    width: 150px;                                
                    position: absolute;
                }
                .text{
                    left: 155px;
                    top: 45px;
                    right:25px;
                    position: absolute;
                    text-align: center;
                }
                hr{
                    top: 511px;
                    position: absolute;
                }                                
            </style>';


        // $data = Kuitansi::find()
        // ->where(['no_tagihan'=>$idbilling])
        // ->AndWhere(['idsiswa'=>$idsiswa])
        // ->One();

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', [190, 236]]);	    

        // $connection = \Yii::$app->db;
        // $sql = $connection->createCommand("SELECT DISTINCT *  FROM tagihan_biaya_tidaktetap a 
        //                                 JOIN siswa b ON a.idsiswa = b.idsiswa 
        //                                 JOIN detail_group c ON b.idsiswa = c.idsiswa
        //                                 JOIN kelas d ON d.idkelas = d.idkelas
        //                                 WHERE b.idsiswa = '176001'
        //                                 ORDER BY c.idgroup DESC LIMIT 1");
        // $model = $sql->queryOne();

        $model = Siswa::find()
                ->where(['no_registrasi'=>$no_kuitansi])
                ->One();
        

        $mpdf->writeHTML($head.' 
                        
                            <div style="text-align:center;line-height:80px;font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace">
                                <b>K     W     I     T     A     N     S     I</b>
                            </div>
            
                            <table class="invoice" style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; text-align: left; width: 100%; ">                                   
                            <tr style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">No Kwitansi </td>                                                                                    
                                <td colspan="3" style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: <i>'.$model->no_registrasi.'</i></td>
                            </tr>
                            <tr style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> No. Induk Siswa </td>                                                                                    
                                <td colspan="3" style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: '.$model->nis.'</td>
                            </tr>                                                                               
                            <tr style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> Nama Siswa </td>                                                                                    
                                <td colspan="3" style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: '.$model->nama_lengkap.'</td>
                            </tr>                                                                               
                            <tr style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> Pembayaran Registrasi Siswa Baru</td>                                                                                    
                                <td colspan="3" style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: <b>Rp '.number_format($model->biaya_registrasi,0,".",".").'</b></td>
                            </tr> 
                            <br/>
                            <br/>
                           
                            <tr style="tex-align:center;font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td ></td>                                                                                   
                                <td></td>                                                                                   
                                <td> </td>                                                                                   
                                                                                                                  
                                <td style="text-align:center;">Jakarta, '.date('d M  Y').'<br/>Bag Adm TKAI<br/><br/>('.Yii::$app->user->identity->username.')</td>                                                                                   
                            </tr>
                           
                        
                        </table>
        ');

       
        $mpdf->Output();
        exit;
        
   }


   function PrintKasir($no_kuitansi){
    $head = '<style>
                img{
                    float: left;
                    width: 150px;                                
                    position: absolute;
                }
                .text{
                    left: 155px;
                    top: 45px;
                    right:25px;
                    position: absolute;
                    text-align: center;
                }
                hr{
                    top: 511px;
                    position: absolute;
                }                                
            </style>';


      
        // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', [190, 236]]);	    
        // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'utf-8', [190, 236]]);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

       

        // $model = Siswa::find()
        //         ->joinWith('kuitansi')
        //         ->where(['no_kuitansi'=>$no_kuitansi])
        //         ->One();

        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM siswa a JOIN kuitansi b ON a.kode_siswa = b.kode_siswa 
                                            WHERE b.no_kuitansi = '".$no_kuitansi."'");
        $model = $sql->queryOne();

        $kuitansi = Kuitansi::findAll($no_kuitansi);
       
        $data = '';
        foreach($kuitansi as $kuitansis):
        
        $keterangan = ($kuitansis->keterangan == 'spp' ? 'SPP '.$kuitansis->remarks : $kuitansis->remarks);
   
            $data .= '<tr>';
                $data .= '<td>'.$keterangan.'</td>';
                $data .= '<td> : Rp'.FormatRupiah($kuitansis->jumlah_bayar).'</td>';
            $data .= '<tr>';
           
        endforeach;
       
      
        $mpdf->writeHTML($head.' 
                        
                            <div style="text-align:center;line-height:80px">
                                <b>K   W   I   T   A   N   S   I </b>
                            </div>
            
                            <table class="invoice" style="font-family: Arial; box-sizing: border-box; font-size: 14px; text-align: left; width: 100%;">                                   
                            <tr style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">No Kwitansi </td>                                                                                    
                                <td colspan="3" style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: <i>'.$model['no_kuitansi'].'</i></td>
                            </tr>
                            <tr style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> No. Induk Siswa </td>                                                                                    
                                <td colspan="3" style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: '.$model['nis'].'</td>
                            </tr>                                                                               
                            <tr style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> Nama Siswa </td>                                                                                    
                                <td colspan="3" style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: '.$model['nama_lengkap'].'</td>
                            </tr>                                                                               
                            <tr style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> Pembayaran : </td>                                                                                    
                                <td colspan="3" style="font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                    <table>
                                       '.$data.'
                                       
                                    </table>
                                </td>
                            </tr> 
                           
                            <tr style="tex-align:center;font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td ></td>                                                                                   
                                <td></td>                                                                                   
                                <td> </td>                                                                                   
                                                                                                                  
                                <td style="text-align:center;">Jakarta, '.date('d M  Y').'<br/>Bag Adm TKAI<br/><br/>('.Yii::$app->user->identity->username.')</td>                                                                                   
                            </tr>
                           
                        
                        </table>
        ');

       
        $mpdf->Output();
        exit;
        
   }

   function PrintLapKeuangan($periode){
        $path = Yii::getAlias("@vendor/fpdf/fpdf.php");
        require $path;

        $title = '';
        $filter = '';
        if($periode == 1){
            $title = 'HARIAN';
            $filter = 'WHERE DATE(date) = "'.date('Y-m-d').'"';
        }else if($periode == 2){
            $title = 'MINGGUAN';
            $filter = 'WHERE DATE(date) BETWEEN "'.date('Y-m-d', strtotime('-7 days')).'" AND "'.date('Y-m-d').'"';
        }else if($periode == 3){
            $title = 'TAHUNAN';
            $filter = 'WHERE DATE(date) BETWEEN "'.date('Y-m-d', strtotime('-1 year')).'" AND "'.date('Y-m-d').'"';
        }

        
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM kuitansi ".$filter);
        $model = $sql->queryAll();

    
        $pdf = new FPDF('P','mm','A4');

        $pdf->AliasNbPages();    
        $pdf->AddPage();
        $pdf->SetMargins(25, 10, 25);
        // $pdf->SetLeftMargin(25);
        // $pdf->SetRightMargin(25);
        $yi = 30; 
        $ya = 44; 
        $row=0;

        $pdf->Ln(20);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(155,3,"LAPORAN DATA PEMBAYARAN ".$title,50,0,'C',0);

        $pdf->SetFont('Arial','',9);
        $pdf->Ln(15);
        $pdf->cell(158,3,'Tgl Cetak : '.date('d M Y H:i:s'),50,0,'R',0);

        $pdf->Ln(5);
        $pdf->cell(180,3,'---------------------------------------------------------------------------------------------------------------------------------------------------',50,0,'L',0);
        $pdf->Ln(3);
        $pdf->SetFont('Arial','B',7);
        $pdf->cell(6,3,"No ",50,0,'C',0);
        $pdf->cell(20,3,"No Trans ",50,0,'C',0);
        $pdf->cell(20,3,"Tgl Trans ",50,0,'C',0);
        $pdf->cell(15,3,"NIS ",50,0,'C',0);
        $pdf->cell(30,3,"Nama ",50,0,'C',0);
        $pdf->cell(30,3,"Nama Biaya ",50,0,'C',0);
        $pdf->cell(20,3,"Keterangan",50,0,'C',0);
        $pdf->cell(20,3,"Nominal ",50,0,'C',0);
      
        $pdf->Ln(3);
        $pdf->SetFont('Arial','',9);
        $pdf->cell(180,3,'---------------------------------------------------------------------------------------------------------------------------------------------------',50,0,'L',0);


        $pdf->Ln(7);
        $pdf->SetFont('Arial','',6);
        $i = 1;
        $sum = 0;
        foreach($model as $models):
            $siswa = Siswa::findOne(['kode_siswa'=>$models['kode_siswa']]);

            $pdf->cell(6,3,$i,50,0,'C',0);
            $pdf->cell(20,3,$models['no_kuitansi'],50,0,'C',0);
            $pdf->cell(20,3,$models['date'],50,0,'C',0);
            $pdf->cell(15,3,$siswa->nis,50,0,'C',0);
            $pdf->cell(30,3,$siswa->nama_lengkap,50,0,'C',0);
            $pdf->cell(30,3,$models['remarks'],50,0,'C',0);
            $pdf->cell(20,3,$models['payment_method'],50,0,'C',0);
            $pdf->cell(20,3,FormatRupiah($models['nominal']),50,0,'C',0);
            $sum += $models['nominal'];
            $pdf->Ln(5);
            $i++;
        endforeach;
        $pdf->Ln(5);
        $pdf->SetFont('Arial','',9);
        $pdf->cell(180,3,'---------------------------------------------------------------------------------------------------------------------------------------------------',50,0,'L',0);
        $pdf->SetFont('Arial','B',9);
        $pdf->Ln(5);
        $pdf->cell(135,3,'Total :',50,0,'R',0);
        $pdf->cell(22,3,'Rp '.FormatRupiah($sum),50,0,'R',0);
        $pdf->Ln(3);
        $pdf->cell(135,3,'',50,0,'R',0);
        $pdf->cell(22,3,'___________',50,0,'R',0);
        $pdf->Ln(1);
        $pdf->cell(135,3,'',50,0,'R',0);
        $pdf->cell(22,3,'___________',50,0,'R',0);

        $pdf->output();
        exit;
   }

?>