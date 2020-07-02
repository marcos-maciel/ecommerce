<?php 

require_once("vendor/autoload.php");

use \Hcode\Model\User;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new \Hcode\Page();

	$page->setTpl("index");

});

$app->get('/admin', function () {

	$page = new \Hcode\PageAdmin();

	$page->setTpl("index");
});

$app->get('/admin/login', function () {

	$page = new \Hcode\PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("login");
});

$app->post('/admin/login', function () {

	User::login($_POST["login"], $_POST["password"]);

	header("location: /admin");
	exit;
});

$app->run();

?>
