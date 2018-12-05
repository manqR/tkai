<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-index">
   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(' '.$this->title, ['create'], ['class' => 'btn btn-success fa fa-plus']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
			[
				'header' => 'NIS',
				'attribute' => 'idsiswa'
			],        
			
			             
            'nama_lengkap',
			[
				'header' => 'Tempat Lahir',
				'attribute' => 'tempat_lahir'
			],   
			[
				'header' => 'Tanggal Lahir',
				'attribute' => 'tanggal_lahir'
			],    
			[
				'header' => 'Agama',
				'attribute' => 'agama'
			],     
            //'nisn',
            //'no_seri_ijazah_smp',
            //'no_seri_skhun_smp',
            //'no_ujian_nasional',
            //'nik',
            //'tempat_lahir',
            //'tanggal_lahir',
            //'agama',
            //'alamat:ntext',
            //'kelurahan',
            //'kecamatan',
            //'kota',
            //'provinsi',
            //'transportasi',
            //'tlp_rumah',
            //'hp',
            //'email:email',
            //'status_kps',
            //'no_kps',
            //'tinggi_badan',
            //'berat_badan',
            //'jarak_tempat_tinggal',
            //'waktu_tempuh',
            //'jml_saudara',
            //'user_create',
            //'date_create',
            //'user_update',
            //'date_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
