<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $model backend\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
/* @ROOT */
$root = '@web';
/* @JS */
$this->registerJsFile($root."/vendors/select2/select2.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/bootstrap-maxlength/src/bootstrap-maxlength.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);

$this->registerJsFile($root."/scripts/forms/plugins.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/scripts/forms/masks.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);

/* @var $this yii\web\View */
/* @var $model backend\models\TahunAjaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-block">
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'tahun_ajaran')->textInput(['maxlength' => true,'id'=>'thnajaran'])->label('Tahun Ajaran') ?>

    <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Non-Active']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
