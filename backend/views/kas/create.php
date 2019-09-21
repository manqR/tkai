<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Kas */

$this->title = 'Create Kas';
$this->params['breadcrumbs'][] = ['label' => 'Kas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
