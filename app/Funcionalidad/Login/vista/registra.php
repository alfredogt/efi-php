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
                        <h3 class="panel-title">Ingreso al Sistema</h3>
                    </div>
                    <div class="panel-body">
                        <?= $form->inicia(['action'=>Url::creaUrl('/0/2/registra')]); ?>
                            <fieldset>
                                <div class="form-group">
                                    <?= $form->field('usu_login','text',['class'=>'form-control','placeholder'=>'Usuario','required'=>'true','autofocus'=>'true']); ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field('password','password',['class'=>'form-control','placeholder'=>'Contraseña']); ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field('confirm_password','password',['class'=>'form-control','placeholder'=>'Confirme Contraseña']); ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field('estado','password',['class'=>'form-control','placeholder'=>'Estado']); ?>
                                </div>
                                    <?= $form->errores() ?>
                                <!-- Change this to a button or input when using this as a form -->
                                <?= Url::a('login','Volver',['class'=>'btn btn-info']) ?>
                                <button class="btn btn-success">Registrar</button>
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