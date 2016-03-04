<?php
namespace app\Widgets;

use efi\general\Widget;
use efi\vo\ModuloVO;

class WidgetMenuPrincipal extends Widget{


	public static function ejecuta(){
        $modulos = ModuloVO::busca()->todo();
		?>
		<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
	                    <li class="sidebar-search">
		                    <center><b>Alfredo</b></center>
		                </li>
                        <?php foreach ($modulos as $modulo) { $funcionalidades = $modulo->getFuncionalidades(['fun_visible'=>'1']); ?>
                            <li>
                                <a href="#"><i class="fa fa-folder fa-fw"></i> <?= $modulo->mod_nombre ?><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php foreach ($funcionalidades as $funcionalidad) { ?>
                                        <li>
                                            <a href="#" onclick='peticion_general(<?= $modulo->mod_id ?>,<?= $funcionalidad->fun_id ?>,"index",event)'><?= $funcionalidad->fun_nombre ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
		<?php

	}
}