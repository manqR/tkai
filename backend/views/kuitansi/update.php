<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kuitansi */

$this->title = 'Update Kuitansi: ' . $model->no_kuitansi;
$this->params['breadcrumbs'][] = ['label' => 'Kuitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_kuitansi, 'url' => ['view', 'no_kuitansi' => $model->no_kuitansi, 'urutan' => $model->urutan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kuitansi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
