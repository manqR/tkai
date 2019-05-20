<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagihanLainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tagihan Lains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tagihan-lain-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(' Add Tagihan Lain', ['create'], ['class' => 'btn btn-success fa fa-plus']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'label'=>'Kode Tagihan',
                'attribute'=>'idtagihan',
            ],
            'nama_tagihan',
            'nominal',
            'created_by',
            'created_date',
            //'urutan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
