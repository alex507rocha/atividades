<?php 
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app->get('/admin', function() {

	


    
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get('/admin/login', function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("login", [
		'error'=>User::getError()
	]);	

	// $page->setTpl("login");
	

});

$app->post('/admin/login', function() {

	try {

		User::login($_POST['login'], $_POST['password']);

	} catch(Exception $e) {

		User::setError($e->getMessage());
		User::logout();
	    header("Location: /admin/login");
	exit;
		

		/* var_dump($e->getMessage());
		 exit;*/

	}

	header("Location: /admin");
	exit;

});

$app->post('/admin', function() {
	var_dump(aaa);
	header("Location: /admin/login");
	exit;

}); 		


$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});


 ?>