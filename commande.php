<?php
// Autoloaders
require_once("conf/autoload.php");
require_once("vendor/autoload.php");

// Connexion � la BDD
$connexion = new AppInit();
$connexion->bootEloquent("conf/config.ini");

// Retour en JSON
if(isset($_GET["id"]))
{
	$json = model\commande::where('id', $_GET["id"])->get()->toJson();
	
	header("Content-Type: application/json");
	echo $json;
}
else
{
	if((isset($_POST["dateretrait"])) && (isset($_POST["etat"])))
	{
		$cat = new model\commande();
		$cat->dateretrait = $_POST["dateretrait"];
		$cat->description = $_POST["etat"];
		$cat->save();
		
		http_response_code(201);
	}
	else
	{
		$res = model\commande::select('id', 'dateretrait')->get();
		$tab = array("nb" => $res->count(), "commandeses" => $res);
		$json = json_encode($tab);
		
		header("Content-Type: application/json");
		echo $json;
	}
}