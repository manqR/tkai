<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Kelas */

$this->title = $model->key_;
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'key_' => $model->key_, 'urutan' => $model->urutan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'key_' => $model->key_, 'urutan' => $model->urutan], [
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
            'kode',
            'idkategori',
            'idcabang',
            'tahun_ajaran',
            'wali_kelas',
            'flag',
            'key_',
            'urutan',
        ],
    ]) ?>

</div>
