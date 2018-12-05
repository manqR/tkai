<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BiayaTidakTetap */

$this->title = 'Update Biaya Tidak Tetap: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Biaya Tidak Tetaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
