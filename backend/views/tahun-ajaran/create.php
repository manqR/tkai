<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TahunAjaran */

$this->title = 'Tambah Tahun Ajaran';
$this->params['breadcrumbs'][] = ['label' => 'Tahun Ajarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
