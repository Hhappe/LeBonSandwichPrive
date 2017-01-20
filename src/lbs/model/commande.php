<?php
namespace lbs\model;

class commande extends \Illuminate\Database\Eloquent\Model
{
	// Database
	protected $table = 'commande';
	protected $primaryKey = 'id';
	
	public $timestamps = false;

	public function sandwichCommande()
	{
		return $this->belongsToMany("\lbs\model\sandwich","id","id");
	}
}