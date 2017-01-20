<?php
namespace lbs\view;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class lbsview
{
	protected $data = null ;
    
    public function __construct($data)
	{
        $this->data = $data;
    }

	private function toutesCommandes($req, $resp)
	{
		$json = '{ "commandes" : '.$this->data.' , "links" : { "all" : { "href" : "/commandes" } "previous" : { "href" : "/commandes?limit=20&offset=0" } "next" : { "href" : "/commandes?limit=20&offset=20" }';
		$resp = $resp->withStatus(200)->withHeader('Content-Type', 'application/json');
		$resp->getBody()->write($json);
		return $resp;
	}

	private function detailsCommande($req, $resp, $args)
	{
		$json = "";
		if($this->data == "[]")
		{
			$tab = array("error" => "ressource not found : ".$req->getUri());
			$json = json_encode($tab);
			$resp = $resp->withStatus(404);
			$resp = $resp->withHeader('Content-Type', 'application/json');
		}
		else
		{
			$json = $this->data;
			$json = substr($json, 0, -1);
			$json = substr($json, 1);
			$json = '{ "commande" : '.$json.', "links" : { "all" : { "href" : "/commandes" } , "sandwichs" : { "href" : "/commandes/'.$args['id'].'/sandwich" } } }';
			$resp = $resp->withStatus(200)->withHeader('Content-Type', 'application/json');
		}
		$resp->getBody()->write($json);
		return $resp;
    }

	private function filtrageCommandes($req, $resp)
	{
		
	}

	private function changementEtat($req, $resp)
	{
		
	}

	public function render($selector, $req, $resp, $args)
	{
		switch($selector)
		{
			case "toutesCommandes":
				$this->resp = $this->toutesCommandes($req, $resp, $args);
				break;
			case "detailsCommande":
				$this->resp = $this->detailsCommande($req, $resp, $args);
				break;
			case "filtrageCommandes":
				$this->resp = $this->filtrageCommandes($req, $resp, $args);
				break;
			case "changementEtat":
				$this->resp = $this->changementEtat($req, $resp, $args);
				break;
		}
		

		return $this->resp;
	}
}