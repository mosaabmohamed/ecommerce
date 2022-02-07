<?php 
session_start();
require_once("vendor/autoload.php");
$app = new \Slim\Slim();
Use Hcode\Model\User;
$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Hcode\Page();

	$page->setTpl("index");

});
$app->get('/admin', function() {
    
    User::verifyLogin();

	$page = new Hcode\PageAdmin();

	$page->setTpl("index");

});
$app->get('/admin/login', function(){

	$page = new Hcode\PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("login");
});
$app->post('/admin/login', function(){

	User::login($_POST["login"], $_POST["password"]);
	header("Location: /admin");
	exit;
});

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

}); 

$app->run();

 ?>