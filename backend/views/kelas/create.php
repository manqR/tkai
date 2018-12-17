<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Kelas */

$this->title = 'Tambah Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-create  card card-block">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
