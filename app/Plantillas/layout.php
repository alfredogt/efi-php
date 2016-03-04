<?php 
use app\Widgets\WidgetMensajes;
use app\Widgets\WidgetNotificaciones;
use app\Widgets\WidgetPerfil;
use app\Widgets\WidgetMenuPrincipal;
use efi\general\Url;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Efi 2.0</title>

    <!-- Bootstrap Core CSS -->
    <?= $this->registraCSS('css/bootstrap/bootstrap.min.css'); ?>

    <!-- MetisMenu CSS -->
    <?= $this->registraCSS('css/menu/metisMenu.min.css'); ?>

    <!-- Custom CSS -->
    <?= $this->registraCSS('css/sb-admin-2.css'); ?>

    <!-- Custom Fonts -->
    <?= $this->registraCSS('css/font-awesome/css/font-awesome.min.css','text/css'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index">
                EFI v2.0
                <img width='90px' style='position: absolute; top: 5px; left: 80px; width: 40px;' src='<?= Url::imagen("logoefi1.png") ?>'>
                </a>   
                <center>
                    <div id='mensaje_loading' class="alert alert-success" style='display:none; position: absolute; padding: 5px; padding-right: 4%; padding-left: 4%; margin-left: 45%; box-shadow: 0px 0px 7px #BFBEBE;'>Cargando datos...</div>
                </center>                             
            </div>            
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <?= WidgetMensajes::ejecuta() ?>
                
                <?= WidgetNotificaciones::ejecuta() ?>
                
                <?= WidgetPerfil::ejecuta() ?>
                
            </ul>            
            <!-- /.navbar-top-links -->

            <?= WidgetMenuPrincipal::ejecuta() ?>

            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="wrapper">
            <!-- Page Content -->
            <div id="page-wrapper">            
                <div id="contenido_principal">
                    <?= $contenido ?>
                </div>
                <!-- /#page-wrapper -->
            </div>
        </div>

        <!-- Ventana Modal para mostrar erroes -->
        <div id="ModalEFI_error" class="modal fade" role="dialog">
          <div class="modal-dialog" style="width: 90%">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ocurrio un Error en la peticion a la API</h4>
              </div>
              <div class="modal-body">
                <code id='ModalEFI_contenido'></code>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?= $this->registraJS('js/jquery/jquery.min.js'); ?>

    <!-- JQuery_ujs -->
    <?= $this->registraJS('js/jquery/jquery_ujs.js'); ?>

    <!-- Bootstrap Core JavaScript -->
    <?= $this->registraJS('js/bootstrap/bootstrap.min.js'); ?>

    <!-- Metis Menu Plugin JavaScript -->
    <?= $this->registraJS('js/metisMenu/metisMenu.min.js'); ?>

    <!-- Custom Theme JavaScript -->
    <?= $this->registraJS('js/sb-admin-2.js'); ?>

    <!-- Javascript de EFI -->
    <?= $this->registraJS('js/efi.js'); ?>

</body>

</html>
