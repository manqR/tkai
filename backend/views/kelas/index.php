<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KelasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    tableShow('.datatable','./api/kelas');
");


?>
<div class="card">
    <div class="card-block">
        <p><?= Html::a(' Tambah Kelas', ['create'], ['class' => 'btn btn-success fa fa-plus']) ?> </p>
        <?php TablewithCrud($arrFields);    ?>    
    </div>    
</div>
