<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Tagihan */

$this->title = 'Tambah Tagihan';
$this->params['breadcrumbs'][] = ['label' => 'Tagihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="kelas-create">

    <!-- <h5><?= Html::encode($this->title) ?></h5> -->

    <?= $this->render('_form', [
         'model' => $model,
         'kode' =>$kode,
         'cabang' => $cabang,
         'grade' => $grade,
         'spp' => $spp
    ]) ?>

</div>

