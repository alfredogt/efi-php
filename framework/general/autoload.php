<?php 

ini_set('display_errors', false);
error_reporting(-1);


register_shutdown_function(function(){
        $error = error_get_last();
        if(null !== $error) {
        	$mysql = mysqli_init();
        	if(($mysql->connect_errno == 0)){
	            echo "<pre>";
	            print_r($error);
	            echo "</pre>";
	            exit;
	        }
        }
        return true;
	});

spl_autoload_register(function ($clase) {
	$path=__DIR__."/../../";
	$ori=$clase;
	$clase= str_replace("efi", "framework", $clase);
	$clase= str_replace("\\", "/", $clase);	

	if($clase=="Efi"){	
		include_once $path.'framework/general/efi.php';
		return;

	}else{
		if(str_replace('framework/vo/', '', $clase)!=='Efi'){
			if(file_exists($path.$clase . '.php')){
				include_once $path.$clase . '.php';
				return;
			}    
		}
	}

	if(file_exists($ori . '.php')){
		require_once $clase;
		return;
	}else{
		if (ob_get_contents()) ob_end_clean();	
		$trace = debug_backtrace();		
		echo '<b>Error: </b> No es posible encontrar la clase: '.$clase.'<br>';
		echo '<b>Archivo: </b>'.$trace[1]['file'].'<br>';
		echo '<b>Linea: </b>'.$trace[1]['line'];		
		exit;
	}
});

