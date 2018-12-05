<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Jurusan */

$this->title = $model->idjurusan;
$this->params['breadcrumbs'][] = ['label' => 'Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-block">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idjurusan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idjurusan], [
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
			[
				'label'=>'Kode Jurusan',
				'attribute' => 'idjurusan'
			],     
			[
				'label'=>'Nama Jurusan',
				'attribute' => 'nama_jurusan'
			],                   			
        ],
    ]) ?>

</div>
