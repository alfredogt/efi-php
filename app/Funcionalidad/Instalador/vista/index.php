<?php 
use efi\general\Url;
?>
<div class="container">
    <div class="row">
    	<div class="col-md-5 col-md-offset-4">
    		<div class="login-panel panel panel-default">

    			<div class="panel-heading">
                    <center><h3 class="panel-title">Bienvenido al asistente de instalación de EFI 2.0</h3></center>
                </div>
                <div class="panel-body">
                	<p>Este asistente le guiara para poder configurar EFI de la mejor forma</p>
                	<?= $form->inicia(['id'=>'form_installbd','action'=>'install']); ?>

                		<?= $form->field('host','text',['placeholder'=>'Nombre del host','required'=>'true','autofocus'=>'true'],['label'=>'Nombre del host']); ?>
                		<hr>
                		<?= $form->field('user','text',['placeholder'=>'Usuario','required'=>'true'],['label'=>'Nombre de Usuario']); ?>
                		<?= $form->field('password','password',['placeholder'=>'Contraseña','required'=>'true'],['label'=>'Contraseña']); ?>
                		<?= $form->field('bd','text',['placeholder'=>'Base de datos','required'=>'true'],['label'=>'Nombre de la Base de datos']); ?>
                		
                		<br><hr>
                		<button class="btn btn-success">Continuar >> </button>
                	<?= $form->fin() ?>
                </div>

    		</div>
    	</div>
    </div>
</div>        