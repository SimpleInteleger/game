<?php
	
ob_start();
session_start();


//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','game');

$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
$db -> exec("set names utf8");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//set timezone
date_default_timezone_set('Europe/London');

//load classes as needed
 $class ="user";
 
    $class = strtolower($class);
    
    $classpath = 'classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }
    
    $classpath = '../classes/class.'.$class . '.php';
    if( file_exists($classpath)) {
        require_once $classpath;
    }
	$classpath = '../../../assets/site/php/classes/class.'.$class . '.php';
    if( file_exists($classpath)) {
        require_once $classpath;
    }
	$classpath = '../../assets/site/php/classes/class.'.$class . '.php';
    if( file_exists($classpath)) {
        require_once $classpath;
    }
	$classpath = 'assets/site/php/classes/class.'.$class . '.php';
    if( file_exists($classpath)) {
        require_once $classpath;
    }
    
    
    
    


$user = new User($db);
