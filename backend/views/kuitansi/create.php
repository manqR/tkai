<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Kuitansi */

$this->title = 'Create Kuitansi';
$this->params['breadcrumbs'][] = ['label' => 'Kuitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kuitansi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
