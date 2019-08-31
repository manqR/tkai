<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Siswa;
include 'inc/money.php';
/* @var $this yii\web\View */
/* @var $searchModel backend\models\KuitansiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayat Kuitansi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kuitansi-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


    <h5><?= Html::encode($this->title) ?></h5>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_kuitansi',
            [
                'label'=>'Nama Siswa',
                'attribute'=>'kode_siswa',
                'format' => 'html',
                'value'=> function ($model) {
                    $siswa = Siswa::findOne(['kode_siswa'=>$model->kode_siswa]);
                    return '<center><b>' .$model->kode_siswa. '<br>' . $siswa->nama_lengkap . '</b></center>';
                },
            ],             
            [
                'label'=>'Total Tagihan',
                'attribute'=>'nominal',
                'format' => 'html',
                'value'=> function ($model) {                    
                    return formatRupiah($model->nominal);
                },
            ],            
            'diskon',
            [
                'label'=>'Jumlah Bayar',
                'attribute'=>'jumlah_bayar',
                'format' => 'html',
                'value'=> function ($model) {                    
                    return formatRupiah($model->jumlah_bayar);
                },
            ],        
            'tahun_ajaran',        
            'payment_method',
            'bank_name',
            'date',
            [
                'label'=>'Aksi',
                'attribute'=>'no_kuitansi',
                'format' => 'raw',
                'value'=> function ($model) {                    
                    return Html::a('<i class="material-icons">print</i>',['//kasir/print','no_kuitansi'=>$model->no_kuitansi],['target'=>'_blank']);
                },
            ],        
            

        ],
    ]); ?>
</div>
