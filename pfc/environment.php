<?php
    
    $ds = DIRECTORY_SEPARATOR;
	$pasta = explode($ds,getcwd());
	$pasta = end($pasta);

	header("Content-type: text/html; charset=utf-8");
	define('DEBUG',true);
    define('ABSOLUTE_PATH', dirname( __FILE__ )); //Absolute path

	
	if(DEBUG === true){
		define('URI_BASE',"http://".$_SERVER['SERVER_NAME']."/".$pasta."/index.php"); //Root URI
		define('ROOT_URL',"http://".$_SERVER['SERVER_NAME']."/".$pasta."/"); //Root directory
		define('DOWNLOAD_URL',"http://".$_SERVER['SERVER_NAME']."/index.php/");
		define('VIEW_BASE',"http://".$_SERVER['SERVER_NAME']."/".$pasta."/views/");//Recupera a pasta da view
		define('MEDIA_BASE',ABSOLUTE_PATH."/media/");
		
		define("HOST","localhost");
		define("USERDB","root");
		define("PASSDB","");
		define("NAMEDB","pfc");
		define('CHARSETDB', 'utf8mb4' );       	
	}else{

		define('URI_BASE',"http://".$_SERVER['SERVER_NAME']."/index.php/"); //Root URI
		define('ROOT_URL',"http://".$_SERVER['SERVER_NAME']."/index.php/"); //Root directory
		define('DOWNLOAD_URL',"http://".$_SERVER['SERVER_NAME']."/");
		define('VIEW_BASE',"http://".$_SERVER['SERVER_NAME']."/views/");//Recupera a pasta da view
		define('MEDIA_BASE',ABSOLUTE_PATH."/media/");

        define("HOST","localhost");
		define("USERDB","id4162191_emertest");
		define("PASSDB","12345@");
		define("NAMEDB","id4162191_pfc");
		define('CHARSETDB', 'utf8' );
    }

    if (!defined('ABSOLUTE_PATH')) {
		exit;
	}
     
	if(defined('DEBUG') || DEBUG === true){
		error_reporting(E_ALL);
		ini_set("display_errors",1);
	}
    
