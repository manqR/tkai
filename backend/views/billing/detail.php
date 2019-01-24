<?php
/* @var $this yii\web\View */

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
                                Nominal
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
                                $sum += $spps->nominal;
                        ?>
                            <tr>
                                <td><?= $spps->tahun_ajaran ?></td>
                                <td><?= $spps->bulan ?></td>
                                <td><?= FormatRupiah($spps->nominal) ?></td>
                                <td><?= $spps->flag == 1 ? ' <span class="tag tag-danger">Belum Bayar</span>' : '<span class="tag tag-success">Sudah Bayar</span>' ?></td>
                                <td><?= $spps->date_update == '' ? '-': $spps->date_update ?></td>
                           </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>                            
                            <th colspan="2">
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
                            foreach ($tagihan as $tagihans): 
                                $sum += $tagihans['nominal'];;
                        ?>
                            <tr>
                                <td><?= $tagihans['tahun_ajaran']; ?></td>
                                <td><?= $tagihans['idtagihan']; ?></td>
                                <td><?= $tagihans['remarks']; ?></td>
                                <td><?= FormatRupiah($tagihans['nominal']) ?></td>
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
        <div class="tab-pane" id="three" role="tabpanel">
            
         
        </div>
    </div>
</div>
