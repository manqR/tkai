<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kas';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if (Yii::$app->session->hasFlash('ok')): ?>
    <div>
        <div class="alert alert-success">Update Berhasil ! </div>
       
    </div>
<?php endif; ?>

<div class="kas-index card card-block">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'nominal',
                'format' => 'raw',
                'value'=>function ($model) {
                 return FormatRupiah($model->nominal);
             },
            ],      
            'last_update',
            'update_by',

            ['class' => 'yii\grid\ActionColumnk'],
        ],
    ]); ?>
</div>
