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

    <!-- Css de EFI -->
    <?= $this->registraCSS('css/efi.css','text/css'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- ____Imprime el contenido generado en la vista___ -->
        <?= $contenido ?>

    <!-- jQuery -->
    <?= $this->registraJS('js/jquery/jquery.min.js'); ?>

    <!-- Bootstrap Core JavaScript -->
    <?= $this->registraJS('js/bootstrap/bootstrap.min.js'); ?>

    <!-- Metis Menu Plugin JavaScript -->
    <?= $this->registraJS('js/metisMenu/metisMenu.min.js'); ?>

    <!-- Custom Theme JavaScript -->
    <?= $this->registraJS('js/sb-admin-2.js'); ?>

</body>

</html>
