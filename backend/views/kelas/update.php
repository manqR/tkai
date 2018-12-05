<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kelas */

$this->title = 'Update Class';
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idkelas, 'url' => ['view', 'id' => $model->idkelas]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">
    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
