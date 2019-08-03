<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Tambah Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h4><b><?= Html::encode($this->title) ?></b></h4>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
