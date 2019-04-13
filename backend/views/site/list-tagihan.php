<?php
/* @var $this yii\web\View */

$this->registerJs("
    tableShow('.datatable','./api/list-tunggakan?thn=".$tahun."&grade=".$grade."');
");
   $this->title = 'List Tagihan';
?>
<h5>List Tagihan</h5>
<div class="card">
    <div class="card-block">
        <?php
            TablewithCrud($arrFields);            
        ?>
    </div>
</div>
