<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Spp;
use backend\models\Kelas;

/* @var $this yii\web\View */
/* @var $model backend\models\Tagihan */

$this->title = $model->idtagihan;
$this->params['breadcrumbs'][] = ['label' => 'Tagihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

function formatRupiah($val){
	$rupiah = number_format($val,2,',','.');
	return 'Rp '.$rupiah;
}
?>
<div class="card card-block">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idtagihan' => $model->idtagihan, 'idjurusan' => $model->idjurusan, 'idkelas' => $model->idkelas], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idtagihan' => $model->idtagihan, 'idjurusan' => $model->idjurusan, 'idkelas' => $model->idkelas], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>

<?php
	$kode = Kelas::find()
			->where(['idkelas'=>$model->idkelas])
			->One();
?>
<div class="col-lg-6">
	<div class="card card-block">
		<div class="card-header no-bg b-a-0">			
			<b>Basic Information</b>
		</div>
		<div class="card-block">
			<div class="table-responsive">
				<table class="table m-b-0">
					
					<tbody>
						<tr>
							<td>
								<span>
								</span>
								Billing Number
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= $model->idtagihan; ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								Majors
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= $model->idjurusan; ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								Class
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= $kode->kode; ?></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class="col-lg-6">
	<div class="card card-block">
		<div class="card-header no-bg b-a-0">			
			<b>Billing Options</b>
		</div>
		<div class="card-block">
			<div class="table-responsive">
				<table class="table m-b-0">
					
					<tbody>
						<tr>
							<td>
								<span>
								</span>
								Administration
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->administrasi); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								Development
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->pengembangan); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								Practice
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->praktik); ?></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
	

<div class="col-lg-12">
	<div class="card card-block">
		<div class="card-header no-bg b-a-0">
			<b>Fixed Charges</b>
		</div>
		<div class="card-block">
			<div class="table-responsive">
				<table class="table m-b-0">
					
					<tbody>
						<tr>
							<td>
								<span>
								</span>
								Semester_A
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->semester_a); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								Semester_B
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->semester_b); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								English Lab
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->lab_inggris); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								LKS
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->lks); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								Library
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->perpustakaan); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								OSIS
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->osis); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								MPLS
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->mpls); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<span>
								</span>
								Assurance
							</td>
							
							<td class="align-middle">
								<span class="label label-success"><?= formatRupiah($model->asuransi); ?></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal" style="float:right">View SPP</button>		
		
		
		<div class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">SPP Detail</h4>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table m-b-0">								
								<tbody>
									<?php
										$spp = Spp::find()
												->where(['idtagihan'=>$model->idtagihan])
												->all();
										foreach($spp as $spps):
									?>
									<tr>
										<td>
											<span>
											</span>
											<?= $spps->bulan ?>
										</td>
										
										<td class="align-middle">
											<span class="label label-success"><?= formatRupiah($spps->besaran); ?></span>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>						
					</div>
				</div>
			</div>
		</div>

	</div>
</div>