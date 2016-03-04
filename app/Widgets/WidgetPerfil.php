<?php
namespace app\Widgets;

use efi\general\Widget;
use efi\general\Url;

class WidgetPerfil extends Widget{

	public static function ejecuta(){
		?>
			<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Datos</a></li>
                        <li><?= Url::link('1/1/cambiaclave','<i class="fa fa-key fa-fw"></i> Cambiar Contraseña',[]) ?></li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuración</a></li>                        
                        <li class="divider"></li>
                        <li>
                                <a href="<?= Url::creaUrl('0/2/logout')  ?>" data-method="POST"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                </li>
		<?php
	}
}