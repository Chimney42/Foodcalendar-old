<?php
ini_set('session.use_trans_sid', true);
ini_set('session.use_cookies', false);
ini_set('session.use_only_cookies', false);
session_start();
//phpinfo();


// autoloading

define('APPROOT', '/workspace/lli/foodcalendar/application/');

set_include_path(APPROOT.'models/:'.APPROOT.'controllers/:'.APPROOT.'views/');

spl_autoload_register('autoload_class');

function autoload_class($classname) {
	
	$classname .= '.php';
	
	$classname = str_replace('_', '/', $classname);

	include($classname);
}


// Routing

$requestURI = $_SERVER['REQUEST_URI'];

$jpg = strpos($requestURI, '.jpg');
$png = strpos($requestURI, '.png');

if($jpg === false || $png === false) {

	$strpos = strpos($requestURI, '?');
	
	if($strpos !== false) {
		
		$requestURI = substr($requestURI, 0, $strpos);
	}
	
	$requestParts = explode('/', $requestURI);
	
	$controller = ucfirst(strtolower($requestParts[1]));
	$action = strtolower($requestParts[2]);
	
	if($controller == ''){
		$controller = 'Index';
	}
	
	if($action == ''){
		$action = 'index';
	}
	
	$controller .= 'Controller';
	$action .= 'Action';
	
	
    if (!isset($_SESSION['login'])) {
        $controller='IndexController';
        if(!$action==='loginAction') {
            $action='indexAction';
        }
    }

    $controller = new $controller();

// Header - Content - Footer

    include 'Header.php';

	$controller->$action();
	
	include 'Footer.php';
	
}