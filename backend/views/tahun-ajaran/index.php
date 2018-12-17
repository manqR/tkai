<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TahunAjaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tahun Ajaran';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    tableShow('.datatable','./api/ajaran');
");

?>
<div class="card">
    <div class="card-block">
        <p><?= Html::a(' Tambah Tahun Ajaran', ['create'], ['class' => 'btn btn-success fa fa-plus']) ?></p>
        <?php
            TablewithCrud($arrFields);            
        ?>
    </div>
</div>
