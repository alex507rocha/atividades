<?php 

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;

class Atividade extends Model {

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_atividades ORDER BY desctituloatividade");

	}

	public static function checkList($list)
	{

		foreach ($list as &$row) {
			
			$p = new Atividades();
			$p->setData($row);
			$row = $p->getValues();


		}

		return $list;

	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_atividades_save(
			:idatividades,
			:desctituloatividade,
			:descatvidade,
			:dtinicioatividade,
			:dtfimatividades,
			:idimagematividade,
			:linkatividade,
			:dtregistroatividade)",	 array(
			":idatividades"=>$this->getidatividades(),
			":desctituloatividade"=>$this->getdesctituloatividade(),
			":descatvidade"=>$this->getdescatvidade(),
			":dtinicioatividade"=>$this->getdtinicioatividade(),
			":dtfimatividades"=>$this->getdtfimatividades(),
			":idimagematividade"=>$this->getidimagematividade(),
			":linkatividade"=>$this->getlinkatividade(),
			":dtregistroatividade"=>$this->getldtregistroatividade()
		));

/* 		var_dump($this->getidatividades());
		var_dump($this->getdesctituloatividade());
		var_dump($this->getdescatvidade());		
        var_dump($this->getdtinicioatividade());
		var_dump($this->getdtfimatividades());
		var_dump($this->getidimagematividade());
		var_dump($this->getldtregistroatividade()); 		
		var_dump($this->getlinkatividade());
		exit; 
		var_dump($sql);
		var_dump($results);
		exit;
		*/



		$this->setData($results[0]);

	}

	public function get($idatividade)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_atividades WHERE idatividade = :idatividade", [
			':idatividade'=>$idatividade
		]);

		$this->setData($results[0]);

	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_atividades WHERE idatividade = :idatividade", [
			':idatividade'=>$this->getidatividade()
		]);

	}

	public function checkPhoto()
	{

		if (file_exists(
			$_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"site" . DIRECTORY_SEPARATOR . 
			"img" . DIRECTORY_SEPARATOR . 
			"atividadea" . DIRECTORY_SEPARATOR . 
			$this->getidatividade() . ".jpg"
			)) {

			$url = "/res/site/img/atividade/" . $this->getidatividade() . ".jpg";

		} else {

			$url = "/res/site/img/Atividade.jpg";

		}

		return $this->setdesphoto($url);

	}

	public function getValues()
	{

		$this->checkPhoto();

		$values = parent::getValues();

		return $values;

	}

	public function setPhoto($file)
	{

		$extension = explode('.', $file['name']);
		$extension = end($extension);

		switch ($extension) {

			case "jpg":
			case "jpeg":
			$image = imagecreatefromjpeg($file["tmp_name"]);
			break;

			case "gif":
			$image = imagecreatefromgif($file["tmp_name"]);
			break;

			case "png":
			$image = imagecreatefrompng($file["tmp_name"]);
			break;

		}

		$dist = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"site" . DIRECTORY_SEPARATOR . 
			"img" . DIRECTORY_SEPARATOR . 
			"products" . DIRECTORY_SEPARATOR . 
			$this->getidatividade() . ".jpg";

		imagejpeg($image, $dist);

		imagedestroy($image);

		$this->checkPhoto();

	}

	public function getFromURL($desurl)
	{

		$sql = new Sql();

		$rows = $sql->select("SELECT * FROM tb_atividades WHERE linkatividade = :desurl LIMIT 1", [
			':desurl'=>$desurl
		]);

		$this->setData($rows[0]);

	}

/* 	public function getCategories()
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_categories a INNER JOIN tb_productscategories b ON a.idcategory = b.idcategory WHERE b.idproduct = :idproduct
		", [

			':idproduct'=>$this->getidproduct()
		]);

	} */

	public static function getPage($page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_atividades 
			ORDER BY desctituloatividade
			LIMIT $start, $itemsPerPage;
		");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_atividades 
			WHERE desctituloatividade LIKE :search
			ORDER BY desproduct
			LIMIT $start, $itemsPerPage;
		", [
			':search'=>'%'.$search.'%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

}

 ?>