<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KelasGroup */

$this->title = $model->idgroup;
$this->params['breadcrumbs'][] = ['label' => 'Kelas Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-block">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idgroup], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idgroup], [
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
				'label'=>'Kode Kelas',
				'attribute' => 'idkelas'
			],     
			
			'wali_kelas',            
			[
				'attribute'=>'status', 
				'label'=>'Status',
				'format'=>'raw',
				'value'=>$model->status == 'A' ? 
					'<span class="tag tag-success">Enable</span>' : 
					'<span class="tag tag-danger">Disable</span>',			
			],
			
        ],
    ]) ?>

</div>
