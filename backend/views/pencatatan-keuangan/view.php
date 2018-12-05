<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PencatatanKeuangan */

$this->title = $model->idcatat;
$this->params['breadcrumbs'][] = ['label' => 'Pencatatan Keuangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-block">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idcatat], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idcatat], [
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
            'idcatat',
            'no_pencatatan',
            'kategori',
            'keterangan',
            'nominal',
            'flag',
            'user_create',
            'date_create',
        ],
    ]) ?>

</div>
