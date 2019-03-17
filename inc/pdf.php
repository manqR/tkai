<?php


use backend\models\Kuitansi;

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

        $connection = \Yii::$app->db;
        // $sql = $connection->createCommand("SELECT DISTINCT *  FROM tagihan_biaya_tidaktetap a 
        //                                 JOIN siswa b ON a.idsiswa = b.idsiswa 
        //                                 JOIN detail_group c ON b.idsiswa = c.idsiswa
        //                                 JOIN kelas d ON d.idkelas = d.idkelas
        //                                 WHERE b.idsiswa = '176001'
        //                                 ORDER BY c.idgroup DESC LIMIT 1");
        // $model = $sql->queryOne();



        $mpdf->writeHTML($head.' 
                            <table width="100%">
                                <tr>
                                    <td><img src="images/logo.png"/></td>
                                    <td width="270px"></td>
                                    <td>
                                        <span style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-size:12px;float: right;">Jl. Kedondong No. 18 Jakarta Selatan 12620</span><br/>
                                        <span style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-size:12px;float: right;">Telp. 021-788 8913 Fax 012-7888 8917</span><br/>
                                        <span style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-size:12px;float: right;">Email : sekolah.sdkai@gmail.com</span>
                                    </td>
                                </tr>
                            </table>
                            
                        
                            <div style="text-align:center">
                                <b>K   W   I   T   A   N   S   I </b>
                            </div>
            
                            <table class="invoice" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 100%; margin: 20px auto;">                                   
                            <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">No Kwitansi </td>                                                                                    
                                <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: <i>'.Yii::$app->user->identity->username.'</i></td>
                            </tr>
                            <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> No. Induk Siswa </td>                                                                                    
                                <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: ..............</td>
                            </tr>                                                                               
                            <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> Nama Siswa </td>                                                                                    
                                <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: sdasdasd</td>
                            </tr>                                                                               
                            <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top"> Pembayaran Registrasi Siswa Baru</td>                                                                                    
                                <td colspan="3" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">: <b>Rp '.number_format(12312323,0,".",".").'</b></td>
                            </tr> 
                            <br/>
                            <br/>
                            <br/>
                            <tr style="tex-align:center;font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td></td>                                                                                   
                                <td></td>                                                                                   
                                <td> </td>                                                                                   
                                <td style="text-align:center;">Jakarta, '.date('d M  Y').'<br/>Bag Adm TKAI<br/><br/><br/><br/>(........................)</td>                                                                                   
                            </tr>
                           
                        
                        </table>
        ');

       
        $mpdf->Output();
        exit;
        
   }

?>