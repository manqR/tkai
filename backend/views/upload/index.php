<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div>
        <div class="alert alert-success">Upload Berhasil ! </div>
        <!-- <?= Yii::$app->session->getFlash('success') ?> -->
    </div>
<?php endif; ?>

<?php $form = ActiveForm::begin();  ?>
<div class="card">
    <div class="card-block">
        <?= $form->field($model, 'filename')->fileInput(['class'=>'form-control']) ?>        
        <div class="form-group">
            <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
