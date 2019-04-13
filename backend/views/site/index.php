<?php

/* @var $this yii\web\View */

$this->title = 'TKAI - Jakarta';
?>
<div class="site-index">
    <div class="row">     
        
        <?php
            foreach($model as $models):
                $tahun = explode("/",$models['tahun_ajaran']);
        ?>
        <a href="tunggakan-list-<?= $tahun[0].'-'.$tahun[1] ?>-<?= $models['keterangan'] ?>">
            <div class="col-md-3">
                <div class="card card-block">
                    <h5 class="m-b-0 v-align-middle text-overflow">
                        <span class="small pull-xs-right tag bg-danger p-y-0 p-x-xs" style="line-height: 24px;">
                        <span >Tunggakan</span>
                        </span>
                        <span><?= number_format($models['nominal'],2,".",".") ?></span>
                    </h5>
                    <div class="small text-overflow text-muted">
                    <?= $models['tahun_ajaran'] ?>
                    </div>
                    <div class="small text-overflow">
                        <?= $models['keterangan'] ?>
                    </div>
                </div>
            </div>
        </a>
        
        <?php endforeach; ?>

       
        
        
    </div>
      

</div>
