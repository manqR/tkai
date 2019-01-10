<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tagihan */

$this->title = 'Update Tagihan' . $model->idtagihan;
$this->params['breadcrumbs'][] = ['label' => 'Tagihan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtagihan, 'url' => ['view', 'idtagihan' => $model->idtagihan, 'urutan' => $model->urutan]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="tagihan-update  card card-block">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

