<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TahunAjaran */

$this->title = 'Update Tahun Ajaran: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tahun Ajarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idajaran, 'url' => ['view', 'id' => $model->idajaran]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
