<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TagihanSiswa */

$this->title = 'Add Billing';
$this->params['breadcrumbs'][] = ['label' => 'Tagihan Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tagihan-siswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
