<?php
namespace lbs\control;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \lbs\AppInit;

// Connexion à la BDD
$connexion = new AppInit();
$connexion->bootEloquent("../conf/config.ini");

class lbscontrol
{
    protected $c=null; 
    
    public function __construct($c)
	{
        $this->c = $c;
    }
	
	public function toutesCommandes(Request $req, Response $resp, $args)
	{
		$limit = $req->getQueryParams()['limit'];
		$offset = $req->getQueryParams()['offset'];
		$commandes = [];
		if(!is_null($limit) && !is_null($offset))
		{
			$commandes = \lbs\model\commande::orderBy('dateretrait')
							->skip($offset)
							->take($limit)
							->get();
		}
		else
		{
			$commandes = \lbs\model\commande::orderBy('dateretrait')
							->get();
		}
		return (new \lbs\view\lbsview($commandes->toJson()))->render('toutesCommandes', $req, $resp, $args);
    }
    public function detailsCommande(Request $req, Response $resp, $args)
	{
		$id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);
		$json = \lbs\model\commande::where('id', $id)->get()->toJson();
		return (new \lbs\view\lbsview($json))->render('detailsCommande', $req, $resp, $args);
    }
}