<?php
    //Request the environment file
    require_once './environment.php';
    spl_autoload_register(function($class){
			if(strpos($class,"Controller") > -1){
				if(file_exists(ABSOLUTE_PATH.'/controllers/'.$class.'.php')){
					require_once(ABSOLUTE_PATH.'/controllers/MainController.php');
					require_once(ABSOLUTE_PATH.'/controllers/'.$class.'.php');
				}
			}
			else if(strpos($class,"DAO") > -1){
				if(file_exists(ABSOLUTE_PATH.'/DAO/'.$class.'.php')){
					require_once(ABSOLUTE_PATH.'/DAO/DAO.php');
					require_once(ABSOLUTE_PATH.'/DAO/'.$class.'.php');
				}
			}else if(strpos($class,"Exception") > -1){
				if(file_exists(ABSOLUTE_PATH.'/exceptions/'.$class.'.php')){
					require_once(ABSOLUTE_PATH.'/exceptions/'.$class.'.php');
				}
			}
			else if(file_exists(ABSOLUTE_PATH .'/models/'.$class.'.php')){
				require_once(ABSOLUTE_PATH.'/models/'.$class.'.php');
			}
			else{
				require_once './Router.php';
			}
	});

    $router = new Router();
	$router->run();