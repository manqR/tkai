<?php

/* @var $this \yii\web\View */
/* @var $content string */

	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use common\widgets\Alert;

?>
<!-- top header -->
<nav class="header navbar">
    <div class="header-inner">
        <div class="navbar-item navbar-spacer-right brand hidden-lg-up">
            <!-- toggle offscreen menu -->
            <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen">
            <i class="material-icons">menu</i>
            </a>
            <!-- /toggle offscreen menu -->
            <!-- logo -->
            <a class="brand-logo hidden-xs-down">
            <img src="images/logo_white.png" alt="logo"/>
            </a>
            <!-- /logo -->
        </div>
        <a class="navbar-item navbar-spacer-right navbar-heading hidden-md-down" href="#">
			<span></span>
        </a>
        <div class="navbar-search navbar-item">
            <form class="search-form">
                <i class="material-icons">search</i>
                <input class="form-control" type="text" placeholder="Search" />
            </form>
        </div>
        <div class="navbar-item nav navbar-nav">
            <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <span>English</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;">English</a>                    
                </div>
            </div>
           
            
        </div>
    </div>
</nav>
<!-- /top header -->
					