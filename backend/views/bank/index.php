<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bank';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-index">


    <p>
        <?= Html::a(' Add Bank', ['create'], ['class' => 'btn btn-success fa fa-plus']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'bank_name',            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
