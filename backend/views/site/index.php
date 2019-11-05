<?php

/* @var $this yii\web\View */

$connection = \Yii::$app->db;
$sql = $connection->createCommand("SELECT d.keterangan, SUM(a.nominal) nominal FROM tagihan_siswa_spp a 
                                    JOIN bulan_spp b ON a.bulan = b.bulan
                                    JOIN siswa c ON a.kode_siswa = c.kode_siswa
                                    JOIN kategori d ON c.idkategori = d.idkategori
                                    WHERE b.number = MONTH(now())
                                    GROUP BY d.keterangan");
$spp = $sql->queryAll();  
$data_spp = json_encode($spp);

$sql2 = $connection->createCommand("SELECT c.keterangan,SUM(a.nominal) nominal 
                                    FROM v_tagihan_siswa a 
                                    JOIN siswa b ON a.kode_siswa = b.kode_siswa 
                                    JOIN kategori c ON b.idkategori = c.idkategori
                                    GROUP BY c.keterangan");
$tagihan = $sql2->queryAll();  
$data_tagihan = json_encode($tagihan);

$this->title = 'TKAI - Jakarta';

$this->registerJs('

am4core.useTheme(am4themes_animated);

var chart = am4core.create("spp", am4charts.PieChart3D);


chart.legend = new am4charts.Legend();

chart.data = '.$data_spp.';

chart.innerRadius = am4core.percent(40);

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "nominal";
series.dataFields.category = "keterangan";



var chart2 = am4core.create("tagihan", am4charts.PieChart3D);
chart2.legend = new am4charts.Legend();

chart2.data = '.$data_tagihan.';

chart2.innerRadius = am4core.percent(40);

var series2 = chart2.series.push(new am4charts.PieSeries3D());
series2.dataFields.value = "nominal";
series2.dataFields.category = "keterangan";



var chart3 = am4core.create("lain", am4charts.PieChart3D);
chart3.legend = new am4charts.Legend();

chart3.data = [{
    "grade": "KBB",
    "nominal": 100000
}, {
    "grade": "SD",
    "nominal": 200000
}, {
    "grade": "TKA",
    "nominal": 500000
}];

chart3.innerRadius = am4core.percent(40);

var series3 = chart3.series.push(new am4charts.PieSeries3D());
series3.dataFields.value = "nominal";
series3.dataFields.category = "grade";
');

?>
<div class="site-index">
    <div class="row">     
        
        <?php

            // $sum = 0;
            foreach($model as $models):
                $tahun = explode("/",$models['tahun_ajaran']);
                // $sum += $models['nominal'];
        ?>
        <a href="tunggakan-list-<?= $tahun[0].'-'.$tahun[1] .'-'. $models['keterangan'] ?>?>">
            <div class="col-md-3">
                <div class="card card-block">
                    <h5 class="m-b-0 v-align-middle text-overflow">
                        <span class="small pull-xs-right tag bg-danger p-y-0 p-x-xs" style="line-height: 24px;">
                        <span >Tunggakan</span>
                        </span>
                        <span><?= number_format($models['nominal'],0,".",".") ?></span>
                    </h5>
                    <div class="small text-overflow text-muted">
                    <?= $models['tahun_ajaran'] ?>
                    </div>
                    <div class="small text-overflow">
                        <?= $models['keterangan'] ?>
                    </div>
                </div>
            </div>
        </a>
        
        <?php endforeach; ?>

        <div class="col-md-4 card card-block">
            <label>Tagihan SPP</label>
            <div id="spp"></div>
        </div>
        <div class="col-md-4 card card-block">
            <label>Tagihan Tetap</label>
            <div id="tagihan"></div>
        </div>
        <div class="col-md-4 card card-block">
            <label>Tagihan Lainnya</label>
            <div id="lain"></div>
        </div>
        
        
    </div>
      

</div>
