<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */

$this->title = 'Registration';
$this->params['breadcrumbs'][] = ['label' => 'Register', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrasi-create">


    <?= $this->render('_form', [
        'model' => $model,
        'kode'  => $kode
    ]) ?>

</div>
