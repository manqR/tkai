<?php

/* @var $this \yii\web\View */
/* @var $content string */

	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use common\widgets\Alert;
	

	$this->registerJs('
		
			$(function () {				
				
				var url = window.location.pathname; 
				var activePage = url.substring(url.lastIndexOf("/") + 1);				
				$(".nav li a").each(function () { 
					var linkPage = this.href.substring(this.href.lastIndexOf("/") + 1);
					
					var $this = $(this);
					var activePageSplit = activePage.split("-");
					
					if (activePage == linkPage || activePageSplit[0] == linkPage) {																										
						$(this).parents("li").addClass("open");												
					}
					
				});
			})
			
		');

?>



<!--sidebar panel-->
<div class="off-canvas-overlay" data-toggle="sidebar"></div>
<div class="sidebar-panel">
    <div class="brand">
        <!-- toggle offscreen menu -->
        <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen hidden-lg-up">
        <i class="material-icons">menu</i>
        </a>
        <!-- /toggle offscreen menu -->
        <!-- logo -->
        <a class="brand-logo">
			<img class="expanding-hidden" src="images/logo.png" alt=""/>
        </a>
        <!-- /logo -->
    </div>
    <div class="nav-profile dropdown">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <div class="user-image">
                <img src="images/avatar.jpg" class="avatar img-circle" alt="user" title="user"/>
            </div>
            <div class="user-info expanding-hidden">
                <?= Yii::$app->user->identity->username ?>
                <small class="bold">Administrator</small>
            </div>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="javascript:;">Profile</a>                       
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:;">Help</a>			
			<?=				  
				  Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton(
					'Logout',
					['class' => 'dropdown-item']
				)
				. Html::endForm()
			?>
           
        </div>
    </div>
    <!-- main navigation -->
    <nav>
        <p class="nav-title">NAVIGATION</p>
        <ul class="nav">
            <!-- dashboard -->
            <li>
                <a href="<?= Yii::$app->homeUrl; ?>">
                <i class="material-icons text-primary">home</i>
                <span>Home</span>
                </a>
            </li>
            <!-- /dashboard -->
         
			<!-- student -->
            <li>
                <a href="javascript:;">
                <span class="menu-caret">
                <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-success">account_balance</i>               
                <span>Siswa</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="registration">
                        <span>Registrasi</span>
                        </a>
                    </li>
					<li>
                        <a href="class">
                        <span>Kelas</span>
                        </a>
                    </li>      
                    <li>
                        <a href="billing">
                        <span>Tagihan</span>
                        </a>
                    </li> 					            
                </ul>
            </li>
            <!-- /student -->			
			
            <!-- setup -->
            <li>
                <a href="javascript:;">
                <span class="menu-caret">
                <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-danger">settings</i>
                <span>Pengaturan</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="tagihan">
                        <span>Tagihan</span>
                        </a>
                    </li>
                    <li>
                        <a href="kelas">
                        <span>Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="jurusan">
                        <span>Jurusan</span>
                        </a>
                    </li>      
					<li>
                        <a href="ajaran">
                        <span>Tahun Ajaran</span>
                        </a>
                    </li>                   
					<li>
                        <a href="biaya_tidak_tetap">
                        <span>Biaya Tidak Tetap</span>
                        </a>
                    </li>                   
                </ul>
            </li>
            <!-- /setup -->

           <!-- Laporan pemasukan / pengeluaran -->
           <li>
                <a href="javascript:;">
                <span class="menu-caret">
                <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-default">description</i>
                <span>Pencatatan Keuangan</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="pencatatan">
                        <span>Tambah Pencatatan</span>
                        </a>
                    </li>                                                 
                </ul>
            </li>
            <!-- /Laporan pemasukan / pengeluaran -->

             <!-- Kasir -->
             <li>
                <a href="kasir">
                    <i class="material-icons text-danger">attach_money</i>
                    <span>Kasir</span>
                </a>
            </li>
            <!-- /kasir -->

             <!-- Spp -->
             <li>
                <a href="spp">
                    <i class="material-icons">receipt</i>
                    <span>Spp</span>
                </a>
            </li>
            <!-- /spp -->

             <!-- Import -->
             <li>
                <a href="upload">
                    <i class="material-icons text-success">cloud_upload</i>
                    <span>Upload</span>
                </a>
            </li>
            <!-- /Import -->


            <!-- report -->
            <li>
                <a href="javascript:;">
                <span class="menu-caret">
                <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-warning">assessment</i>
                <span>Laporan</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="tunggakan">
                        <span>Surat Tunggakan</span>
                        </a>
                    </li>
                    <li>
                        <a href="keuangan">
                        <span>Laporan Keuangan</span>
                        </a>
                    </li>                                 
                </ul>
            </li>
            <!-- /report -->

            
            
			
            <li>
                <hr/>
            </li>
			
            <!-- documentation -->
            <li>
                <a href="http://milestone.nyasha.me/latest/documentation" target="_blank">
                <i class="material-icons">local_library</i>
                <span>Documentation</span>
                </a>
            </li>
            <!-- /documentation -->
        </ul>
    </nav>
    <!-- /main navigation -->
</div>			