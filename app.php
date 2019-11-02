<?php


require 'vendor/autoload.php';


use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

if (strpos($_SERVER['HTTP_HOST'], '.local') !== false) {
	//local testing version
	$capsule->addConnection([
		'driver'    => 'mysql',
		'host'      => 'localhost',
		'database'  => 'playgroundideas-app',
		'username'  => 'root',
		'password'  => 'root',
		'charset'   => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix'    => '',
	]);
	define('APPROOT_URL', "http://".$_SERVER['SERVER_NAME'] ."/RHoK-playgroundideas-app-api/");
} else {
	//hosted version
	$capsule->addConnection([
		'driver'    => 'mysql',
		'host'      => 'localhost',
		'database'  => '{database}',
		'username'  => '{username}',
		'password'  => '{password}',
		'charset'   => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix'    => '',
	]);

	define('APPROOT_URL', "http://".$_SERVER['SERVER_NAME'] . "/designer_api" . DIRECTORY_SEPARATOR);

}




// Make this Capsule instance available globally via static methods
$capsule->setAsGlobal();

// Setup the Eloquent ORM
$capsule->bootEloquent();

define("SCREENSHOT_UPLOAD_DIR",  __DIR__.'/uploads/');
define("SCREENSHOT_URL_DIR",   APPROOT_URL. 'uploads/');

?>
