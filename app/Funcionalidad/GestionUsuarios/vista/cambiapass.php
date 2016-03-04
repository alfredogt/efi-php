<?php 
use efi\general\Url;
use efi\vo\UsuarioVO;
use efi\helpers\FormularioEFI;
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel-heading">
            <h3 class="panel-title">Cambiar Contraseña</h3><hr>
        </div>
            <?= $form->inicia(['id'=>'form_cambiapass','action'=>'/0/7/editar']); ?>
                <fieldset>
                    <?= $form->field('password_old','password',['required'=>'true','autofocus'=>'true'],['label'=>'Su contraseña']); ?>
                    <?= $form->field('password_new','password',[],['label'=>'Nueva Contraseña']); ?>
                    <?= $form->field('confirm_password','password',[],['label'=>'Confirme Contraseña']); ?>                        
                    <?= $form->errores() ?>
                    
                    <?= Url::link('index','Volver',['class'=>'btn btn-success']) ?> 
                    <?= Url::linkF('editar','Guardar','form_persona',['class'=>'btn btn-info']) ?>
                </fieldset>
            <?= $form->fin() ?>
    </div>
</div>