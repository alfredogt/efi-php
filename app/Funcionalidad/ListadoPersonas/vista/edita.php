<?php 
use efi\general\Url;
use efi\vo\UsuarioVO;
use efi\helpers\FormularioEFI;
$form = new FormularioEFI();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel-heading">
            <h3 class="panel-title">Actualiza información de Persona</h3><hr>
        </div>
            <?= $form->inicia(['id'=>'form_persona','action'=>'/0/7/editar'],$persona); ?>
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                                <?= $form->field('per_id','text',['placeholder'=>'Id','required'=>'true','autofocus'=>'true'],['label'=>'ID']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_nombre','text',['placeholder'=>'Nombre'],['label'=>'Nombre']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_apellido','text',['placeholder'=>'Apellido'],['label'=>'Apellido']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                                <?= $form->field('per_telefono','text',['placeholder'=>'Teléfono'],['label'=>'Teléfono']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_direccion','text',['placeholder'=>'Dirección'],['label'=>'Dirección']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_correo','email',['placeholder'=>'Correo'],['label'=>'Correo']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                                <?= $form->field('per_sexo','text',['placeholder'=>'Sexo'],['label'=>'Sexo']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_tipo_sangre','text',['placeholder'=>'Tipo de Sangre'],['label'=>'Tipo de Sangre']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_fecha_nacimiento','date',['placeholder'=>'Fecha de Nacimiento'],['label'=>'Fecha de Nacimiento']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                                <?= $form->field('per_lugar_nacimiento','text',['placeholder'=>'Lugar de Nacimiento'],['label'=>'Lugar de Nacimiento']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_tipo_documento','text',['placeholder'=>'Tipo de Documento'],['label'=>'Tipo de Documento']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_documento','text',['placeholder'=>'Numero de Documento'],['label'=>'Numero de Documento']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                                <?= $form->field('per_lugar_expedicion','text',['placeholder'=>'Lugar de Expedicion'],['label'=>'Lugar de Expedicion']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_nacionalidad','text',['placeholder'=>'Nacionalidad'],['label'=>'Nacionalidad']); ?>
                        </div>
                        <div class="col-md-4">
                                <?= $form->field('per_estadocivil','text',['placeholder'=>'Estado Civil'],['label'=>'Estado Civil']); ?>
                        </div>
                    </div>
                        <?= $form->errores() ?>
                    <!-- Change this to a button or input when using this as a form -->
                    <?= Url::link('index','Volver',['class'=>'btn btn-success']) ?> 
                    <?= Url::linkF('editar','Guardar','form_persona',['class'=>'btn btn-info','params'=>['per_id'=>$persona->per_id]]) ?>
                </fieldset>
            <?= $form->fin() ?>
    </div>
</div>