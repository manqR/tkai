<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Siswa;

/* @var $this yii\web\View */
/* @var $model backend\models\KuitansiSearch */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs("  
    $(document).ready(function() {
        $(\".datepicker\").datepicker({ 
            format: 'yyyy-mm-dd'
        });
    });
");
?>

<div class="kuitansi-search card card-block">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'no_kuitansi') ?>
    <?= $form->field($model, 'kode_siswa', ['options' => ['tag' => 'false']])-> dropDownList(
        ArrayHelper::map(Siswa::find()->all(),'kode_siswa','nama_lengkap'),
        ['prompt'=>'- Select -','class'=>'select2 m-b-1','style' => 'width: 100%'])->label('Nama Siswa');  
    ?>
    <?= $form->field($model, 'date')->textInput(['class'=>'form-control m-b-1 datepicker','date-provide'=>'datepicker'])->label('Tanggal Pembayaran') ?>    


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
