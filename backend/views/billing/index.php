<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JurusanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tagihan Siswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurusan-index">

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],  
            [
                'attribute'=>'nis',
                'format' => 'raw',
                'value'=>function ($model) {
                 return Html::a($model->nis,'billing-detail-'.$model->kode_siswa);
             },
            ],                
            'nama_lengkap',            
            'agama',            
            'jenis_kelamin',            
            'tempat_lahir',            
            'tanggal_lahir',            
        ],
    ]); 
    ?>
</div>
