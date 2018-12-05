<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Jurusan */

$this->title = 'Add Majors';
$this->params['breadcrumbs'][] = ['label' => 'Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <!-- <h1 style="margin:10px"><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
