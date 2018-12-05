<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PencatatanKeuangan */

$this->title = 'Create Pencatatan Keuangan';
$this->params['breadcrumbs'][] = ['label' => 'Pencatatan Keuangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
