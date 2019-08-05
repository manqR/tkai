<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */

$this->title = 'Update Role: ' . $model->role;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-update card card-block">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
