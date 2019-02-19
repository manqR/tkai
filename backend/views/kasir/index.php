<?php
/* @var $this yii\web\View */
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Kasir';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(" 
        $('.app').addClass('offcanvas');
        tableShow('.daftarsiswa','./api/listsiswa');        
        
        function listTagihan(kode){
            tableShow('.datatagihan','./api/listtagihanall?kode='+kode);
        }

        

        function listCart(kode) {
            $.ajax({
                type: 'GET',
                url: 'api/listcart?kode='+kode,
                cache: false,
                success: function(html) {											
                    $('#show').html(html);  
                   
                     				
                }
            });
            
            $.ajax({
                type: 'GET',
                url: 'api/jumlah-list?kode='+kode,
                cache: false,
                success: function(html) {											
                    $('#jml').html(html);   	
                   		
                }
            });
            
           
        };

        $(document).on(\"click\", \".add\", function () {		
            var datas = $(this).data('id');
           
            $.post('api/postsiswa',{
                data: datas
            },
            function(data, status){                                                                       
                $(\"#nis\").val(data.data.nis);	                                                                         
                $(\"#nama\").val(data.data.nama);	
                $('.daftarsiswa').modal('hide');      
                
                listTagihan(data.data.kode_siswa);
                listCart(data.data.kode_siswa);

                
            });
                                                           
        })    
        $(document).on(\"click\", \".addCart\", function () {		
            var datas = $(this).data('id');

            $.post('api/add-cart',{
                data:datas
            },
            function(data, status){   
                if(data.error == 'success'){
                    listTagihan(data.siswa);
                    listCart(data.siswa);
                }
               
            });                        
        })    

        $(document).on(\"click\", \".checkout\", function (){
            var nominal = document.getElementById('nominal').value;
            swal({
              title: 'Jumlah Uang',
              text: 'Masukan jumlah uang dibayarkan ',
              type: 'input',
              showCancelButton: true,
              closeOnConfirm: false,
              animation: 'slide-from-top',
              inputPlaceholder: 'Write something'
            }, function(inputValue) {
                console.log(nominal)
                if (inputValue === false) {
                    return false;
                }else if (inputValue === '' ) {
                    console.log(inputValue);
                    console.log(nominal);
                    swal.showInputError('Nilai Tidak boleh kosong');
                    return false;
                }else if (inputValue === 0 ) {
                    console.log(inputValue);
                    console.log(nominal);
                    swal.showInputError('Nilai Tidak boleh kosong');
                    return false;
                }else if (inputValue < nominal) {
                    console.log(inputValue);
                    console.log(nominal);
                    swal.showInputError('Nominal yang dimasukan tidak cukup');
                    return false;
                }else{

                    var urutan = $(\"input[name='urutan[]']\").map(function(){return $(this).val();}).get();
                    var bayar = $(\"input[name='nominal_bayar[]']\").map(function(){return $(this).val();}).get();
                    var kode = $(\"input[name='kode[]']\").map(function(){return $(this).val();}).get();

                    for(var i = 0 ; i < urutan.length ; i++){

                        $.post('kasir/checkout',{
                            urutan: urutan[i],
                            bayar: bayar[i],
                            kode: kode[i],
                        },
                        function(data, status){ 
                                                                                                
                        });
                    }
                }
                    
              
            });
          });
    

    ");
$this->registerCss("
    .cari, .add, .cariTagihan, .addCart{
        cursor:pointer;
    }
");


$root = '@web';
$this->registerJs("
                
    function findTotal(){
        var arr = document.getElementsByName('nominal_bayar[]');
        var tot=0;
        for(var i=0;i<arr.length;i++){
            if(parseInt(arr[i].value))
                tot += parseInt(arr[i].value);
        }
        console.log(tot)
       
       var	number_string = tot.toString(),
            sisa 	= number_string.length % 3,
            rupiah 	= number_string.substr(0, sisa),
            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
       $('#total').html('<span class=\"invoice-totals-value\"><b>Rp '+rupiah+'</b></span>'); 
    }
   
	function formatRupiah(angka, prefix){
		var number_string = angka.value.replace(/[^,\d]/g, '').toString(),
			split    = number_string.split(','),
			sisa     = split[0].length % 3,
			rupiah     = split[0].substr(0, sisa),
			ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	
	function formatAsRupiah(el) {
		
		el.value = formatRupiah(el);					
	}",
View::POS_HEAD);					



?>

<div class="card card-block">
    <i class="material-icons cari" style="float:right;margin:10px" title="Cari Siswa" data-toggle="modal" data-target=".daftarsiswa" aria-hidden="true" data-id="">find_in_page</i>
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
            <button type="button" class="btn btn-info btn-icon btn-sm cariTagihan" data-toggle="modal" data-target=".bd-example-modal"><i class="material-icons">add</i>Cari Tagihan</button>        
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
                            Tahun Ajaran
                        </th>
                        <th>
                            Nominal
                        </th>
                        <th>
                            Jumlah Bayar
                        </th>                        
                        <th>
                            Aksi
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
    </form>
</div>


<!-- ------------ MODAL ADD SISWA------------------>
<div class="modal fade daftarsiswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="max-width: 800px" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Daftar Siswa</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					 <table class="table table-bordered daftarsiswa" style="width:100%">
						<thead>
							<tr>
								<th>
									NIS
								</th>
								<th>
									Nama
								</th>
								<th>
									Tempat Lahir
								</th>
								<th>
									Tanggal Lahir
								</th>								
								<th>
									Jenis Kelamin
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



<!-- ------------ MODAL LIST TAGIHAN ------------------>
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
            <?php $form = ActiveForm::begin([
                    'action' => 'cart'
                ]);
                ?>
				<div class="table-responsive">
					 <table class="table table-bordered datatagihan" style="width:100%">
						<thead>
							<tr>
								<th>
									NIS
								</th>
								<th>
									Kategori
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
            <?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
<!-- ------------ /MODAL LIST TAGIHAN ------------------>
