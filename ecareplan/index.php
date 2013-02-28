<?php
/**
 * @version		Version 1.0
 * @copyright           EcarePlan made by Robin Moors & Joris Jacobs
 */
define('ECP_AC', 1);
define('DS', '/');
define('PHP','.php');
$paths = explode(DIRECTORY_SEPARATOR,__FILE__);
array_pop($paths);
define("ECPPATH_SITE",implode(DS,$paths));
header('Access-Control-Allow-Origin: *'); //moorskeshoeve
//load system application
require_once DS.'includes'.DS.'framework.php';


// Instantiate
$app = ECPFactory::getApp('Site');

$app->initialise();

$app->route();
$app->dispatch();
$app->render();
echo $app;
ob_end_flush();
?>