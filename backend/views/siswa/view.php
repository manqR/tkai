<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */

$this->title = $model->idsiswa;
$this->params['breadcrumbs'][] = ['label' => 'Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idsiswa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idsiswa], [
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
            'idsiswa',
            'idkelas',
            'idjurusan',
            'nama_lengkap',
            'jenis_kelamin',
            'nisn',
            'no_seri_ijazah_smp',
            'no_seri_skhun_smp',
            'no_ujian_nasional',
            'nik',
            'tempat_lahir',
            'tanggal_lahir',
            'agama',
            'alamat:ntext',
            'kelurahan',
            'kecamatan',
            'kota',
            'provinsi',
            'transportasi',
            'tlp_rumah',
            'hp',
            'email:email',
            'status_kps',
            'no_kps',
            'tinggi_badan',
            'berat_badan',
            'jarak_tempat_tinggal',
            'waktu_tempuh',
            'jml_saudara',
            'user_create',
            'date_create',
            'user_update',
            'date_update',
        ],
    ]) ?>

</div>
