<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Kelas */

$this->title = 'Add Student Class';
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
