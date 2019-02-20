<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */

$this->title = $model->no_registrasi;
$this->params['breadcrumbs'][] = ['label' => 'Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-view card card-block">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->no_registrasi], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_registrasi',
            'kode_siswa',
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
        ],
    ]) ?>

</div>
