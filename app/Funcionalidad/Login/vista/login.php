<?php 
use efi\general\Url;
use efi\vo\UsuarioVO;
use efi\helpers\FormularioEFI;
?>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Registrar nuevo usuario</h3>
                    </div>
                    <div class="panel-body">
                        <?= $form->inicia(['action'=>Url::creaUrl('/0/2/login')]); ?>
                            <fieldset>
                                <div class="form-group">
                                    <?= $form->field('username','text',['class'=>'form-control','placeholder'=>'Usuario','required'=>'true','autofocus'=>'true']); ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field('password','password',['class'=>'form-control','placeholder'=>'Contraseña','required'=>'true']); ?>
                                </div>
                                <div class="checkbox">
                                    <?= $form->checkBox('recuerda',['value'=>'1'],['label'=>'Recuerdame']); ?>
                                </div>
                                <div class="pull-right">
                                    ¿No tienes un usuario? - 
                                    <?= Url::a('registra','Registrate') ?>
                                </div><br>
                                <div class="form-group">
                                    <?= $form->errores() ?>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Entrar</button>
                            </fieldset>
                        <?= $form->fin() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <!-- <div class="col-xs-10"></div> -->
            <div class="col-xs-12">
                <img width='200px' class='pull-right'  src='<?= Url::imagen("logoefi1.png") ?>'>
            </div>
        </div> 
</div>