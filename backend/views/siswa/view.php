<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */

$this->title = $model->nis;
$this->params['breadcrumbs'][] = ['label' => 'Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'nis' => $model->nis, 'kode_siswa' => $model->kode_siswa, 'urutan' => $model->urutan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nis' => $model->nis, 'kode_siswa' => $model->kode_siswa, 'urutan' => $model->urutan], [
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
            'nis',
            'kode_siswa',
            'idcabang',
            'idkategori',
            'nisn',
            'nama_lengkap',
            'nama_panggilan',
            'agama',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'tlp',
            'tlp_darurat',
            'nama_ayah',
            'nama_ibu',
            'pekerjaan_ayah',
            'pekerjaan_ibu',
            'email:email',
            'tahun_input',
            'tgl_input',
            'urutan',
        ],
    ]) ?>

</div>
