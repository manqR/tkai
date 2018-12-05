<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Jurusan */

$this->title = 'Update Majors';
$this->params['breadcrumbs'][] = ['label' => 'Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idjurusan, 'url' => ['view', 'id' => $model->idjurusan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">

    <h1 style="margin:10px"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
