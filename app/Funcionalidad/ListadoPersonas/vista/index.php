<?php
use app\helpers\VistaHelper;
use efi\general\Url;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="">Listado de Personas</h3>
            <table class="table table-hover table-condensed">
            	<tr>
            		<th>#</th>
            		<th>Nombre</th>
            		<th>Apellido</th>
            		<th>Teléfono</th>
            		<th>Correo</th>
            		<th>Fec. Nacimiento</th>
            		<th>Documento</th>
            		<th>Opciones</th>
            	</tr>
        		<?php foreach ($personas as $persona) { ?>
                    <tr>       
                		<td><?= $persona->per_id ?></td>
                		<td><?= $persona->per_nombre ?></td>
                        <td><?= $persona->per_telefono ?></td>
                		<td><?= $persona->per_apellido ?></td>
                		<td><?= $persona->per_correo ?></td>
                		<td><?= $persona->per_fecha_nacimiento ?></td>
                		<td><?= $persona->per_documento ?></td>
                		<td><?= VistaHelper::GrupoOpciones(['edita'=>'0/7/editar','elimina'=>'0/7/eliminar','params'=>['per_id'=>$persona->per_id]]) ?></td>
                    </tr>
        		<?php } ?>            	
            </table>
            <hr>
            <?= Url::link('nuevo','Nueva Persona',['class'=>'btn btn-success pull-left']) ?>
        </div>
    </div>
</div>
