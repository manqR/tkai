<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<?php $form = ActiveForm::begin();  ?>
<div class="card">
    <div class="card-block">
        <?= $form->field($model, 'file')->fileInput(['class'=>'form-control']) ?>
        <?= $form->field($model, 'kategori')->dropDownList(['master' => 'Master Tagihan', 'tagihan' => 'Biaya Tagihan'], ['prompt'=>'Kategori...','class'=>'form-control']); ?>        
        <div class="form-group">
            <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
