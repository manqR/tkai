<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Kuitansi */

$this->title = $model->no_kuitansi;
$this->params['breadcrumbs'][] = ['label' => 'Kuitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kuitansi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'no_kuitansi' => $model->no_kuitansi, 'urutan' => $model->urutan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'no_kuitansi' => $model->no_kuitansi, 'urutan' => $model->urutan], [
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
            'no_kuitansi',
            'idcart',
            'kode_siswa',
            'idtagihan',
            'remarks',
            'keterangan',
            'keterangan2',
            'nominal',
            'diskon',
            'jumlah_bayar',
            'tahun_ajaran',
            'flag',
            'payment_method',
            'bank_name',
            'date',
            'urutan',
        ],
    ]) ?>

</div>
