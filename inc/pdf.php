<?php


use backend\models\Kuitansi;
use backend\models\Siswa;

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
                ->joinWith('kuitansi')
                ->where(['no_registrasi'=>$no_kuitansi])
                ->AndWhere(['like','idtagihan','RG'])
                ->One();
        
        // var_dump($model);
        // die;

        $mpdf->writeHTML($head.' 
                        
                            <div style="text-align:center;line-height:80px">
                                <b>K   W   I   T   A   N   S   I </b>
                            </div>
            
                            <table class="invoice" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 100%; margin: 20px auto;">                                   
                            <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">No Kwitansi </td>                                                                                    
                                <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: <i>'.$model->kuitansi->no_kuitansi.'</i></td>
                            </tr>
                            <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> No. Induk Siswa </td>                                                                                    
                                <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: '.$model->nis.'</td>
                            </tr>                                                                               
                            <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> Nama Siswa </td>                                                                                    
                                <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: '.$model->nama_lengkap.'</td>
                            </tr>                                                                               
                            <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> Pembayaran Registrasi Siswa Baru</td>                                                                                    
                                <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: <b>Rp '.number_format($model->biaya_registrasi,0,".",".").'</b></td>
                            </tr> 
                            <br/>
                            <br/>
                           
                            <tr style="tex-align:center;font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td ></td>                                                                                   
                                <td></td>                                                                                   
                                <td> </td>                                                                                   
                                                                                                                  
                                <td style="text-align:center;">Jakarta, '.date('d M  Y').'<br/>Bag Adm TKAI<br/><br/><br/>('.Yii::$app->user->identity->username.')</td>                                                                                   
                            </tr>
                           
                        
                        </table>
        ');

       
        $mpdf->Output();
        exit;
        
   }

?>