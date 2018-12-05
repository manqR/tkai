<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BiayaTidakTetapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Biaya Tidak Tetaps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biaya-tidak-tetap-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(' Tambah Biaya Tidak Tetap', ['create'], ['class' => 'btn btn-success fa fa-plus']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'keterangan',
            'nominal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
