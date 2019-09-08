<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Bank */

$this->title = 'Create Bank';
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-create">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
