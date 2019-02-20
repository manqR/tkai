<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registrasi Siswa';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    tableShow('.datatable','./api/register');

    $(\"#checkAll\").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
");

?>


<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div>
        <div class="alert alert-success">Simpan Berhasil ! </div>
        <!-- <?= Yii::$app->session->getFlash('success') ?> -->
    </div>
<?php endif; ?>

<form method="POST" action="registrasi-proses">

<?= Html::hiddenInput(
   Yii::$app->request->csrfParam,
   Yii::$app->request->csrfToken
);?>
    <div class="card">
        <div class="card-block">
            <p><?= Html::a(' Registrasi', ['create'], ['class' => 'btn btn-success fa fa-plus']) ?></p>
            <?php
                TablewithCrud($arrFields);            
            ?>
        </div>
    </div>



    <div class="form-group">
        <select class = "select2 m-b-1" name="status" style="width:20%">
            <option value="1">Approve<option>
            <option value="3">Reject<option>
        </select>
        <input class="btn btn-success" type="submit" style="position: absolute;margin-left: 5px;" value="Proses"/>
        
    </div>
</form>