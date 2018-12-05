<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KelasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tambah Kelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a href = "kelas-create" class="btn btn-success fa fa-plus"> Add Class</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           
			[
				'header' => 'Kode Kelas',
				'attribute' => 'kode'
			],        
            'nama_kelas',            
            'idajaran',            
            'idjurusan',            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
