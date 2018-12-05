<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */

$this->title = 'Update Siswa: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idsiswa, 'url' => ['view', 'id' => $model->idsiswa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
