<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kas */

$this->title = 'Update Kas: ' . $model->idkas;
$this->params['breadcrumbs'][] = ['label' => 'Kas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idkas, 'url' => ['view', 'id' => $model->idkas]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kas-update card card-block">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
