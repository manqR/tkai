<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TagihanLain */

$this->title = 'Create Tagihan Lain';
$this->params['breadcrumbs'][] = ['label' => 'Tagihan Lains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tagihan-lain-create card card-block">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
