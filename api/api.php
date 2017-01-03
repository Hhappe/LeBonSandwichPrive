<?php
// Autoloaders
require_once("../vendor/autoload.php");

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$configuration = [
	'settings' => [
		'displayErrorDetails' => true ]
];
$c = new\Slim\Container($configuration);
$app = new \Slim\App($c);

$app->get('/commandes',
	function (Request $req, Response $resp, $args)
	{
		return (new lbs\control\lbscontrol($this))->toutesCommandes($req, $resp, $args);
	}
)->setName('toutesCommandes');

$app->run();