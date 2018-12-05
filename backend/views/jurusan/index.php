<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JurusanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tambah Jurusan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurusan-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>        
		<a href = "jurusan-create" class="btn btn-success fa fa-plus"> Tambah Jurusan</a>
		
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'header' => 'Kode Jurusan',
				'attribute' => 'idjurusan'
			],            
            'nama_jurusan',            
			
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
