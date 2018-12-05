<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */
/* @var $form yii\widgets\ActiveForm */


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
$this->registerJsFile($root."/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/vendors/jquery-labelauty/source/jquery-labelauty.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);

$this->registerJsFile($root."/scripts/forms/plugins.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);
$this->registerJsFile($root."/scripts/forms/masks.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);

$this->registerJsFile($root."/vendors/parsleyjs/dist/parsley.min.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);


$this->registerJsFile($root."/scripts/helpers/tsf/js/tsf-wizard-plugin.js",
['depends' => [\yii\web\JqueryAsset::className()],
'position' => View::POS_END]);

/* @CSS */
$this->registerCssFile('vendors/select2/select2.css');
$this->registerCssFile('vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker4.css');    

// $this->registerJs("$.getJSON('http://dev.farizdotid.com/api/daerahindonesia/provinsi', 
			// function(data) {   
				// console.log(data);
			// });");
	
$this->registerJs("

	window.onload =  function(){
        $('#siswa-no_kps').attr('readonly','readonly');
    };",
	View::POS_HEAD
	
	
);	
	
$this->registerJs("

	function statusKPS(){

			 var radioValue = $('input[name=\"status_kps\"]:checked').val();
			 if(radioValue == 0){				 
				 $('#siswa-no_kps').attr('readonly','readonly');				 
				 $('#siswa-no_kps').val('0');
			 }else{
				$('#siswa-no_kps').removeAttr('readonly');
				$('#siswa-no_kps').val('');
			 }			
	}
	
	$('.tsf-wizard-1').tsfWizard({
		stepEffect: 'slideLeftRight',
		stepStyle: 'style2',
		navPosition: 'top',
		stepTransition: true,
		validation: false,
		showButtons: true,
		showStepNum: true,	
		 prevBtn: '<i class=\"material-icons\">arrow_back</i> Prev',
        nextBtn: 'Next <i class=\"material-icons\">arrow_forward</i>',
		finishBtn: 'Simpan',
		onNextClick: function (e) {
			console.log('onNextClick');
		},
		onPrevClick: function (e) {
			console.log('onPrevClick');
		},
		onFinishClick: function (e) {
			console.log($('form').serialize())
		}
	});
	
	",
	View::POS_END
);

$this->registerCssFile("styles/gsi-step-indicator.css");
$this->registerCssFile("styles/tsf-step-form-wizard.css");			
?>

<div class="layout-column-md">
    <div class="p-a-1 wizards">
        <h6 class="text-center m-b-1">Register Siswa</h6>
        <!-- BEGIN STEP FORM WIZARD -->
        <div class="tsf-wizard tsf-wizard-1">
            <!-- BEGIN NAV STEP-->
            <div class="tsf-nav-step">
                <!-- BEGIN STEP INDICATOR-->
                <ul class="gsi-step-indicator triangle gsi-style-1 gsi-transition ">
                    <li class="current" data-target="step-1">
                        <a href="javascript:;">
                            <div class="number">
                                1
                            </div>
                            <div class="desc">
                                <label>
                                Register Siswa
                                </label>
                                <span>
                                Informasi Pribadi
                                </span>
                            </div>
                        </a>
                    </li>
                    <li data-target="step-2">
                        <a href="javascript:;">
                            <div class="number">2</div>
                            <div class="desc">
                                <label>
                                Informasi Penanggung
                                </label>
                                <span>
                                Orang Tua / Wali
                                </span>
                            </div>
                        </a>
                    </li>
                    <li data-target="step-3">
                        <a href="javascript:;">
                            <div class="number">3</div>
                            <div class="desc">
                                <label>
                                Informasi Tambahan
                                </label>
                                <span>
                                Prestasi Siswa
                                </span>
                            </div>
                        </a>
                    </li>
                    <li data-target="step-4">
                        <a href="javascript:;">
                            <div class="number">4</div>
                            <div class="desc">
                                <label>
                                Informasi Beasiswa
                                </label>
                                <span>
                                Beasiswa
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- END STEP INDICATOR -->
            </div>
            <!-- END NAV STEP-->
			
			
            <!-- BEGIN STEP CONTAINER -->
            <div class="tsf-container">
                <!-- BEGIN CONTENT-->
                <form class="tsf-content">
                    <!-- BEGIN STEP 1-->
                    <div class="tsf-step step-1 active">
                        <fieldset>
                            <legend>
                                Profile Siswa
                            </legend>
                            <div class="row">
                                <!-- BEGIN STEP CONTENT-->
                                <div class="tsf-step-content">
								
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="nis">
                                            NIS
                                            </label>
                                            <input class="form-control m-b-1" maxlength="8" name="nis" id="nis" type="text" />
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap">
                                            Nama Lengkap
                                            </label>
                                            <input class="form-control" id="nama_lengkap" name="nama_lengkap" type="text"/>
                                        </div>
										<div class="form-group">
                                            <label for="nama_lengkap">
                                            Email
                                            </label>
                                            <input class="form-control" id="email" name="email" type="email"/>
                                        </div>
										
                                        <div class="form-group">
                                            <label for="nik">
                                            NIK
                                            </label>
											<input class="form-control" id="nik" name="nik" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="gender">
                                            Jenis Kelamin
                                            </label>
											<select class="form-control" name="gender" style="font-size:12px">
												<option value="" disabled selected>- Pilih Jenis Kelamin -</option>
												<option value="L">Laki-Laki</option>
												<option value="P">Perempuan</option>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label for="agama">
                                            Agama
                                            </label>
											<select class="form-control" name="agama" style="font-size:12px">
												<option value="" disabled selected>- Pilih Kepercayaan -</option>
												<option value="Muslim">Muslim</option>
												<option value="Kristen">Kristen</option>
												<option value="Hindu">Hindu</option>
												<option value="Budha">Budha</option>
												<option value="Konghucu">Konghucu</option>
											</select>                                         
                                        </div>
										<div class="form-group">
                                            <label for="tempat_lahir">
                                            Tempat Lahir
                                            </label>
											<input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="tinggi_badan">
                                            Tanggal Lahir
                                            </label>
											<input class="form-control" id="tinggi_badan" name="tinggi_badan" data-provide="datepicker" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="tlp_rumah">
                                            Tlp. Rumah
                                            </label>
											<input class="form-control" id="tlp_rumah" name="tlp_rumah" type="text"/>                                            
                                        </div>
										
										
										<div class="form-group">
                                            <label for="hp">
                                            HandPhone
                                            </label>
											<input class="form-control" id="hp" name="hp" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="kendaraan">
                                            Kendaraan
                                            </label>
											<input class="form-control" id="kendaraan" name="kendaraan" type="text"/>                                            
                                        </div>		
											
										<div class="form-group">
                                            <label for="jarak">
                                            Jarak Tempat Tinggal
                                            </label>
											<input class="form-control" id="jarak" name="jarak" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="nisn">
                                            NISN
                                            </label>
											<input class="form-control m-b-1" maxlength="10" id="maxlength" name="nisn" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="skhun">
                                            Nomor Ijazah SMP
                                            </label>
											<input class="form-control" id="skhun" name="skhun" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="jarak">
                                            Nomor SKHUN
                                            </label>
											<input class="form-control" id="jarak" name="jarak" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="uan">
                                            Nomor Ujian Nasional
                                            </label>
											<input class="form-control" id="uan" name="uan" type="text"/>                                            
                                        </div>
										
										
										<div class="form-group">
                                            <label for="waktu_tempuh">
                                            Waktu Tempuh
                                            </label>
											<input class="form-control" id="waktu_tempuh" name="waktu_tempuh" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="jml_saudara">
                                            Jumlah Saudara
                                            </label>
											<input class="form-control" id="jml_saudara" name="jml_saudara" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="nik">
                                            Tinggi Badan
                                            </label>
											<input class="form-control" id="tinggi_badan" name="tinggi_badan" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="nik">
                                            Berat Badan
                                            </label>
											<input class="form-control" id="berat_badan" name="berat_badan" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="alamat">
                                            Alamat
                                            </label>
											<textarea class="form-control" rows="6" name="alamat"></textarea>
                                        </div>
										
										<div class="form-group">
                                            <label for="provinsi">
                                            Provinsi
                                            </label>
											<input class="form-control" id="provinsi" name="provinsi" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="kelurahan">
                                            Kelurahan
                                            </label>
											<input class="form-control" id="kelurahan" name="kelurahan" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="nik">
                                            Kecamatan
                                            </label>
											<input class="form-control" id="kecamatan" name="kecamatan" type="text"/>                                            
                                        </div>
										
										<div class="form-group">
                                            <label for="nik">
                                            Kota
                                            </label>
											<input class="form-control" id="kota" name="kota" type="text"/>                                            
                                        </div>
										
										
										<div class="form-group">
                                            <label for="gender">
                                            Status KPS
                                            </label>
											<select class="form-control" name="status_kps" style="font-size:12px" onclick="statusKPS();">
												<option value="" disabled selected>- Pilih Status KPS -</option>
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label for="no_kps">
                                            No KPS
                                            </label>
											<input class="form-control" id="siswa-no_kps" name="no_kps" type="text"/>                                            
                                        </div>
										
										
										
                                    </div>
                                   
                                </div>
                                <!-- END STEP CONTENT-->
                            </div>
                        </fieldset>
                    </div>
                    <!-- END STEP 1-->
                    <!-- BEGIN STEP 2-->
                    <div class=" tsf-step step-2 ">
                        <fieldset>
                            <legend>
                                Provide your profile details
                            </legend>
                            <!-- BEGIN STEP CONTENT-->
                            <div class="tsf-step-content">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                    Fullname
                                    </label>
                                    <input class="form-control" id="example_Fullname" placeholder="Enter fullname " required="" type="email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword2">
                                    Phone Number
                                    </label>
                                    <input class="form-control" id="exampleInputPassword2" placeholder="Phone Number" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputAddress">
                                    Address
                                    </label>
                                    <input class="form-control" id="exampleInputAddress" placeholder="Street address" type="text">
                                </div>
                                <label>
                                Gender
                                </label>
                                <div class="radio">
                                    <label>
                                    <input checked="" name="optionsRadios" required="" type="radio" value="option1">
                                    Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input name="optionsRadios" type="radio" value="option2">
                                    Female
                                    </label>
                                </div>
                            </div>
                            <!-- END STEP CONTENT-->
                        </fieldset>
                    </div>
                    <!-- END STEP 2-->
                    <!-- BEGIN STEP 3-->
                    <div class=" tsf-step step-3 ">
                        <fieldset>
                            <legend>
                                Provide your billing and credit card details
                            </legend>
                            <!-- BEGIN STEP CONTENT-->
                            <div class="tsf-step-content">
                                <div class="form-group">
                                    <label for="example_cardName">
                                    Card Holder Name
                                    </label>
                                    <input class="form-control" id="example_cardName" placeholder="Enter Card Holder Name" required="" type="email">
                                </div>
                                <div class="form-group">
                                    <label for="example_cardNumber">
                                    Card Number
                                    </label>
                                    <input class="form-control" id="example_cardNumber" placeholder="Card Number" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="example_cvc">
                                    CVC
                                    </label>
                                    <input class="form-control" id="example_cvc" placeholder="CVC" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="example_expiration">
                                    Expiration(MM/YYYY)
                                    </label>
                                    <input class="form-control" id="example_expiration" placeholder="MM/YYYY" type="text">
                                </div>
                            </div>
                            <!-- END STEP CONTENT-->
                        </fieldset>
                    </div>
                    <!-- END STEP 3-->
                    <!-- BEGIN STEP 4-->
                    <div class="tsf-step step-4">
                        <fieldset>
                            <legend>
                                Agreement
                            </legend>
                            <!-- BEGIN STEP CONTENT-->
                            <div class="tsf-step-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="checkbox">
                                                    <label>
                                                    <input type="checkbox">
                                                    I read agreement and i have not any objection
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END STEP CONTENT-->
                        </fieldset>
                    </div>
                    <!-- END STEP 4-->
                </form>
                <!-- END CONTENT-->
                <!-- BEGIN CONTROLS-->
                <div class="tsf-controls ">
                    <!-- BEGIN PREV BUTTTON-->
                    <button class="btn btn-primary btn-icon btn-left tsf-wizard-btn" data-type="prev" type="button">
                    <i class="material-icons">arrow_back</i>
                    <span>Prev</span>
                    </button>
                    <!-- END PREV BUTTTON-->
                    <!-- BEGIN NEXT BUTTTON-->
                    <button class="btn btn-primary btn-icon btn-right tsf-wizard-btn" data-type="next" type="button">
                    <i class="material-icons">arrow_forward</i>
                    <span>Next</span>
                    </button>
                    <!-- END NEXT BUTTTON-->
                    <!-- BEGIN FINISH BUTTTON-->
                    <button class="btn btn-right tsf-wizard-btn" data-type="finish" type="button">
                    FINISH
                    </button>
                    <!-- END FINISH BUTTTON-->
                </div>
                <!-- END CONTROLS-->
            </div>
            <!-- END STEP CONTAINER -->
        </div>
    </div>
</div>