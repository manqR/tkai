<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TahunAjaran */

$this->title = $model->idajaran;
$this->params['breadcrumbs'][] = ['label' => 'Tahun Ajarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-block">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idajaran], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idajaran], [
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
				'label'=>'Tahun Ajaran',
				'attribute' => 'tahun_ajaran'
			],                   
			[
				'attribute'=>'status', 
				'label'=>'Status',
				'format'=>'raw',
				'value'=>$model->status == 1 ? 
					'<span class="tag tag-success">Enable</span>' : 
					'<span class="tag tag-danger">Disable</span>',			
			],
           
        ],
    ]) ?>

</div>
