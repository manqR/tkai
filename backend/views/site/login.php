<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-content">
    <div class="card card-block form-layout">
	 
		<?php $form = ActiveForm::begin(['id' => 'validate']); ?>        
            <div class="text-xs-center m-b-3">
                <img src="images/logo-icon.png" height="80" alt="" class="m-b-1"/>
                <h5>
                    Welcome back!
                </h5>
                <p class="text-muted">
                    Sign in with your app id to continue.
                </p>
            </div>
            <fieldset class="form-group">
                <label for="username">
                Enter your username
                </label>
				<?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class'=>'form-control form-control-lg', 'placeholder'=>'username'])->label(false) ?>                
            </fieldset>
            <fieldset class="form-group">
                <label for="password">
                Enter your password
                </label>
				<?= $form->field($model, 'password')->passwordInput(['class'=>'form-control form-control-lg','placeholder'=>'**********'])->label(false) ?>                
            </fieldset>
           
            <button class="btn btn-primary btn-block btn-lg" type="submit">Login</button>
           
       <?php ActiveForm::end(); ?>
    </div>
</div>