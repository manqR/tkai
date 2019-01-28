<?php
/* @var $this yii\web\View */

$this->title = 'Kasir';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(" 
        $('.app').addClass('offcanvas');
      
                               
    ");
$this->registerCss("
    .cari{
        cursor:pointer;
    }
");
?>

<div class="card card-block">
    <i class="material-icons cari" style="float:right;margin:10px" title="Cari Siswa" aria-hidden="true" data-id="">find_in_page</i>
    <div class="col-md-12">
      
        <div class="col-md-6">
            <div class="form-group">
                <label>NIS Siswa</label>
                <input type="text" class="form-control" name="nis" id="nis" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Siswa</label>
                <input type="text" class="form-control" name="nama" id="nama" readonly>
            </div>
        </div>
    </div>
        
</div>


<div class="card">
    <div class="card-block">
        <div class="text-xs-right">
            <button type="button" class="btn btn-info btn-icon btn-sm addCart" data-toggle="modal" data-target=".bd-example-modal"><i class="material-icons">add</i>Cari Tagihan</button>        
        </div>
        <div class="table-responsive p-t-2 p-b-2">
            <table class="table table-bordered m-b-0">
                <thead>
                    <tr>
                        <th>
                            NIS
                        </th>
                        <th>
                            Keterangan
                        </th>
                        <th>
                            Nominal
                        </th>
                        <th>
                            Qty
                        </th>
                    </tr>
                </thead>
                <tbody id="show">
                    <tr>
                        <td colspan="4" class="text-xs-center">No data available in table</td>
                    </tr>            
                </tbody>
            </table>
        </div>
        <div class="invoice-totals p-t-2 p-b-2" id="jml">
            <div class="invoice-totals-row">
                <strong class="invoice-totals-title">
                Subtotal
                </strong>
                <span class="invoice-totals-value">
                <b>Rp 0</b>
                </span>
                <input type='hidden' id='nominal' name='nominal' value=0>
            </div>        
        </div>      
    </div>
    <div class="card-footer text-xs-right" style="background-color:#f7f7f700">      
        <button type="button" class="btn btn-danger btn-icon btn-sm checkout">
        <i class="material-icons">shopping_basket</i>
        Bayar
        </button>
        <button type="button" class="btn btn-warning btn-icon btn-sm print">
        <i class="material-icons">print</i>
        Cetak
        </button>        
    </div>
</div>


<!-- ------------ MODAL ADD CART------------------>
<div class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="max-width: 800px" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">List Tagihan</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					 <table class="table table-bordered datatable" style="width:100%">
						<thead>
							<tr>
								<th>
									NIS
								</th>
								<th>
									Keterangan
								</th>
								<th>
									Nominal
								</th>
								<th>
									Tahun Ajaran
								</th>								
								<th>
									Aksi
								</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>						
			</div>
		</div>
	</div>
</div>
<!-- ------------ /MODAL ADD SISWA ------------------>
