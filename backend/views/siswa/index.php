<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Siswa';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    tableShow('.datatable','./api/siswa');
");

?>
<div class="card">
    <div class="card-block">
        <p><?= Html::a(' Tambah Siswa', ['create'], ['class' => 'btn btn-success fa fa-plus']) ?></p>
        <?php
            TablewithCrud($arrFields);            
        ?>
    </div>
</div>
