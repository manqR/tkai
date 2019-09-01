<?php

/* @var $this \yii\web\View */
/* @var $content string */

	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
    use common\widgets\Alert;
    use backend\models\Menu;
    use backend\models\RolePrivillage;    
    use backend\models\MenuDetail;
	

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
        
        <?php
            $model = Menu::find()
                    ->where(['flag'=>1])
                    ->all();
            $html = '';
           
            $html .='<ul class="nav">';
                       
            $x = 0;
            $d = 0;
            foreach($model as $models):
                $x += 1;
                
                $privileges = RolePrivillage::find()
                    ->where(['like', 'menu_name', $models->nama_menu])
                    ->AndWhere(['description'=>'HEAD'])
                    ->AndWhere(['idrole'=>Yii::$app->user->identity->role])
                    ->One();
                
                if($privileges){
                    if($privileges->flag == 1){
                        $checks = 1;
                    }else{
                        $checks = 0;
                    }
                    
                    $detail = MenuDetail::find()
                        ->where(['parent_id'=>$models->idmenu])
                        ->andWhere(['flag'=>1])
                        ->all();

                        $child = '';
                    
                        foreach($detail as $details):
                            
                            $privilege = RolePrivillage::find()
                                        ->where(['like', 'menu_name', $details->name])
                                        ->AndWhere(['description'=>'CHILD'])
                                        ->AndWhere(['idrole'=>Yii::$app->user->identity->role])
                                        ->One();
                            
                            if($privilege){
                            
                                if($privilege->flag == 1){
                                    $check = 1;
                                }else{
                                    $check = 0;
                                }
                                
                                $d += 1;
                                if($check == 1){
                                    $child .= '  <li>
                                                    <a href="'.$details->link.'">
                                                    <span>'.$details->name.'</span>
                                                    </a>
                                                </li>  ';
                                }
                            }

                endforeach;                

                if($checks == 1){   
                    if($models->link != '#'){
                        $html .='
                            <li>
                                <a href="'.$models->link.'">
                                <i class="material-icons '.$models->color.'">'.$models->icon.'</i>
                                <span>'.$models->nama_menu.'</span>
                                </a>
                            </li>';
                    }else{
                        $html .= '
                            <li>
                                <a href="javascript:;">
                                <span class="menu-caret">
                                <i class="material-icons">arrow_drop_down</i>
                                </span>
                                <i class="material-icons '.$models->color.'">'.$models->icon.'</i>
                                <span>'.$models->nama_menu.'</span>
                                </a>
                                <ul class="sub-menu">
                                    
                                   '.$child.'                               
                                </ul>
                            </li>';
                    }
                }
            }
            endforeach;
           
          

            $html .= '<li>
                        <hr/>
                    </li>
                    
                    <li>
                        <a href="http://milestone.nyasha.me/latest/documentation" target="_blank">
                        <i class="material-icons">local_library</i>
                        <span>Documentation</span>
                        </a>
                    </li>';
        
             $html .=' </ul>';
             echo $html;
        ?>
    </nav>
    <!-- /main navigation -->
</div>			