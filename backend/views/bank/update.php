<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Bank */

$this->title = 'Update Bank: ' . $model->bank_name;
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bank_name, 'url' => ['view', 'id' => $model->bank_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bank-update">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
