<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TagihanSiswa */

$this->title = $model->idtagihan_siswa;
$this->params['breadcrumbs'][] = ['label' => 'Tagihan Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tagihan-siswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idtagihan_siswa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idtagihan_siswa], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idtagihan_siswa',
            'idtagihan',
            'idsiswa',
            'tahun_ajaran',
            'nama_tagihan',
            'besaran',
            'keterangan:ntext',
            'user_create',
            'date_create',
        ],
    ]) ?>

</div>
