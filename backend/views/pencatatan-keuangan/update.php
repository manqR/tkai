<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PencatatanKeuangan */

$this->title = 'Update Pencatatan Keuangan: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Pencatatan Keuangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcatat, 'url' => ['view', 'id' => $model->idcatat]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">

<?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>