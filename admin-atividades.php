<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Atividade;

$app->get("/admin/atividades", function(){

	User::verifyLogin();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = Atividade::getPageSearch($search, $page);

	} else {

		$pagination = Atividade::getPage($page);

	}

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/atividades?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	$atividade = Atividade::listAll();

	$page = new PageAdmin();

	$page->setTpl("atividades", [
		"atividades"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	]);

});

$app->get("/admin/atividades/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("atividades-create");

});

$app->post("/admin/atividades/create", function(){

	User::verifyLogin();

	$atividade = new Atividade();

	$atividade->setData($_POST);
/*     var_dump($_POST);
	exit; */
	$atividade->save();

	header("Location: /admin/atividades");
	exit;

});

$app->get("/admin/atividades/:idatividade", function($idatividade){

	User::verifyLogin();

	$atividade = new Atividade();
	$atividade->get((int)$idatividade);
	
	

	$page = new PageAdmin();

	$page->setTpl("atividades-update", [
		'atividade'=>$atividade->getValues()
	]);
});

$app->post("/admin/atividades/:idatividade", function($idatividade){

	

	User::verifyLogin();

	$atividade = new Atividade();

	$atividade->get((int)$idatividade);

	$atividade->setData($_POST);

	
 	/* var_dump($atividade);
	exit; */

	$atividade->save();

	## $atividade->setPhoto($_FILES["file"]);

	header('Location: /admin/atividades');
	exit;

});

$app->get("/admin/atividades/:idatividade/delete", function($idatividade){

	User::verifyLogin();

	$atividade = new Atividade();

	$atividade->get((int)$idatividade);

	$atividade->delete();

	header('Location: /admin/atividades');
	exit;

});

 ?>