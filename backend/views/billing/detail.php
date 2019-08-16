<?php
/* @var $this yii\web\View */
use backend\models\Cart;
$this->title = 'Tagihan Detail / '.$model->nis.' / '.$model->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Tagihan Siswa', 'url' => ['./billing']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card card-block">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#one" role="tab">SPP</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#two" role="tab">Tagihan Tetap</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#three" role="tab">Tagihan Lainnya</a>
        </li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane active" id="one" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-bordered table-striped m-b-0">
                    <thead>
                        <tr>
                            <th>
                               Tahun Ajaran
                            </th>
                            <th>
                                Bulan
                            </th>
                            <th>
                                Nominal TAgihan
                            </th>
							 <th>
                                Sisa Tagihan
                            </th>
                            <th>
                               Status
                            </th>
                            <th>
                               Tanggal Bayar
                            </th>
                        </tr>
                    </thead>
                   
                    <tbody>
                   
                        <?php 
                            $sum = 0;
                            foreach ($spp as $spps): 
                                $sum += $spps['sisa_bayar'];
                        ?>
                            <tr>
                                <td><?= $spps['tahun_ajaran'] ?></td>
                                <td><?= $spps['bulan'] ?></td>
                                <td><?= FormatRupiah($spps['nominal_tagihan']) ?></td>
                                <td><?= FormatRupiah($spps['sisa_bayar']) ?></td>
                                <td><?= $spps['flag'] == 1 ? ' <span class="tag tag-danger">Belum Bayar</span>' : '<span class="tag tag-success">Sudah Bayar</span>' ?></td>
                                <td><?= $spps['date_update'] == '' ? '-': $spps['date_update'] ?></td>
                           </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>                            
                            <th colspan="3">
                                Total
                            </th>
                            <th colspan="3">
                                <?= FormatRupiah($sum) ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="two" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-bordered table-striped m-b-0">
                    <thead>
                        <tr>
                            <th>
                               Tahun Ajaran
                            </th>
                            <th>
                                No Tagihan
                            </th>
                            <th>
                                Keterangan
                            </th>
                            <th>
                               Nominal Tagihan
                            </th>
							
                            <th>
                               Sudah dibayarkan
                            </th>
							 <th>
                               Nominal Sisa
                            </th>
                            <th>
                               Tanggal Bayar
                            </th>
                        </tr>
                    </thead>
                   
                    <tbody>
                   
                        <?php 
                            $sum = 0;
                
                            foreach ($tagihan as $tagihans): 

                                $pay = Cart::find()
                                    ->where(['idtagihan'=>$tagihans['idtagihan']])
                                    ->AndWhere(['kode_siswa'=>$model->kode_siswa])
                                    ->AndWhere(['keterangan'=>'tagihan'])
                                    ->AndWhere(['remarks'=> $tagihans['key_']])
                                    ->AndWhere(['tahun_ajaran'=> $tagihans['tahun_ajaran']])
									->AndWhere(['flag'=>2])
                                    ->One();

                             
                                $sum += (isset($pay->nominal) ? $pay->nominal : 0);
                        ?>
                            <tr>
                                <td><?= $tagihans['tahun_ajaran']; ?></td>
                                <td><?= $tagihans['idtagihan']; ?></td>
                                <td><?= $tagihans['remarks']; ?></td>
                                                     
                                <td><?= FormatRupiah($tagihans['nominal2']) ?></td>                             
                                <td> <?= FormatRupiah(isset($pay->nominal) ? $pay->nominal : '0') ?> </td>
								<td><?= FormatRupiah($tagihans['nominal']) ?></td>         
                                <td><?= isset($pay->date) ? $pay->date : '-' ?></td>
                           </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>                            
                            <th colspan="4">
                                Total
                            </th>
                            <th colspan="2">
                                <?= FormatRupiah($sum) ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="three" role="tabpanel">
            
        <div class="table-responsive">
                <table class="table table-bordered table-striped m-b-0">
                    <thead>
                        <tr>
                            <th>
                               Tahun Ajaran
                            </th>
                            <th>
                                No Tagihan
                            </th>
                            <th>
                                Keterangan
                            </th>
                            <th>
                               Nominal
                            </th>
                            <th>
                               Sudah dibayarkan
                            </th>
                            <th>
                               Tanggal Bayar
                            </th>
                        </tr>
                    </thead>
                   
                    <tbody>
                   
                        <?php 
                            $sum = 0;
                
                            foreach ($lain as $lains): 

                               
                                $sum += $lains['nominal'];;
                        ?>
                            <tr>
                                <td><?= $lains['tahun_ajaran']; ?></td>
                                <td><?= $lains['idtagihan']; ?></td>
                                <td><?= $lains->tagihanLain->nama_tagihan; ?></td>
                                <td><?= FormatRupiah($lains['nominal']) ?></td>
                                <td></td>
                                <td></td>
                           </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>                            
                            <th colspan="3">
                                Total
                            </th>
                            <th colspan="3">
                                <?= FormatRupiah($sum) ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
