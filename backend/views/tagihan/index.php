<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagihanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tagihan';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    tableShow('.datatable','./api/tagihan');
");

?>
<div class="card">
    <div class="card-block">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div>
                <div class="alert alert-success">Simpan Berhasil ! </div>
                <!-- <?= Yii::$app->session->getFlash('success') ?> -->
            </div>
        <?php endif; ?>
        <p><?= Html::a(' Tambah Tagihan', ['create'], ['class' => 'btn btn-success fa fa-plus']) ?></p>
        <?php
            TablewithCrud($arrFields);            
        ?>
    </div>
</div>
