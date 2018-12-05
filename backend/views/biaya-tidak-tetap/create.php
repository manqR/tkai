<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BiayaTidakTetap */

$this->title = 'Create Biaya Tidak Tetap';
$this->params['breadcrumbs'][] = ['label' => 'Biaya Tidak Tetaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
