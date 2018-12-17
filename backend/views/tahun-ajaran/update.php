<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TahunAjaran */

$this->title = 'Update Tahun Ajaran: ' . $model->idtahun_ajaran;
$this->params['breadcrumbs'][] = ['label' => 'Tahun Ajarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtahun_ajaran, 'url' => ['view', 'id' => $model->idtahun_ajaran]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tahun-ajaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
