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
                        <a href="tahun-ajaran">
                        <span>Tahun Ajaran</span>
                        </a>
                    </li>    
                    <li>
                        <a href="kelas">
                        <span>Kelas</span>
                        </a>
                    </li>    
                    <li>
                        <a href="tagihan">
                        <span>Tagihan</span>
                        </a>
                    </li>
                    <li>
                        <a href="tagihan-lain">
                        <span>Tagihan Lain</span>
                        </a>
                    </li>                                                 
                    <li>
                        <a href="karyawan">
                        <span>Karyawan</span>
                        </a>
                    </li>                                  
                    <li>
                        <a href="role">
                        <span>Role Karyawan</span>
                        </a>
                    </li>                                  
                </ul>
            </li>
            <!-- /setup -->


			<!-- student -->
            <li>
                <a href="javascript:;">
                <span class="menu-caret">
                <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-success">face</i>               
                <span>Siswa</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="registrasi">
                        <span>Registrasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="siswa">
                        <span>Siswa</span>
                        </a>
                    </li>
					<li>
                        <a href="kelassiswa">
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
			
           
            <!-- Kasir -->
            <li>
                <a href="kasir">
                    <i class="material-icons text-danger">attach_money</i>
                    <span>Kasir</span>
                </a>
            </li>
            <!-- /kasir -->

            <!-- kuitansi -->
            <li>
                <a href="kwitansi">
                    <i class="material-icons text-warning">print</i>
                    <span>Kwitansi</span>
                </a>
            </li>
            <!-- /kuitansi -->
            
            <!-- Import -->
             <li>
                <a href="upload">
                    <i class="material-icons text-success">cloud_upload</i>
                    <span>Upload</span>
                </a>
            </li>
            <!-- /Import -->


              <!-- Import -->
              <li>
                <a href="kas">
                    <i class="material-icons text-danger">account_balance_wallet</i>
                    <span>Kas</span>
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
                        <a href="admin-keuangan">
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