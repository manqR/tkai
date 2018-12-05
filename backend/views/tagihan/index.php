<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagihanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' Setup Billing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tagihan-index">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($this->title, ['create'], ['class' => 'btn btn-success fa fa-plus']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
			[
				'header' => 'Kode Tagihan',
				'attribute' => 'idtagihan'
			],        			    
			[
				'header' => 'Kode Kelas',
				'attribute' => 'idkelas'
			],                    
            //'praktik',
            //'semester_a',
            //'semester_b',
            //'lab_inggris',
            //'lks',
            //'perpustakaan',
            //'osis',
            //'mpls',
            //'asuransi',
            //'user_create',
            //'date_create',
            //'user_update',
            //'date_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
