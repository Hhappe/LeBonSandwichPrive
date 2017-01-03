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
		$json = '{ "commandes" : '.$this->data.'}';
		$resp = $resp->withStatus(200)->withHeader('Content-Type', 'application/json');
		$resp->getBody()->write($json);
		return $resp;
	}

	public function render($selector, $req, $resp, $args)
	{
		switch($selector)
		{
			case "toutesCommandes":
				$this->resp = $this->toutesCommandes($req, $resp, $args);
				break;
		}

		return $this->resp;
	}
}