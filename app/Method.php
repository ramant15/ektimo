<?php namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Method extends Model {
	
	protected $table = 'methods';
	
	public $timestamps = false;
	
	protected $fillable = ['name'];
	
	/*protected $fillable = array(
			'name', 
			'sku',
			'link_to_product', 
			'price', 
			'shipping_cost_swiss', 
			'shipping_cost_dutch',
			'marketplace_id',
			'marketplace',
			'tags'
			 
	);	
	
	public static $rules = array(
        'name'        => 'required',  
		'price'       => 'required|Numeric',
        'sku'         => 'required',      
		'link_to_product' => 'url', 
		'shipping_cost_swiss' => 'Numeric', 
		'shipping_cost_dutch' => 'Numeric'
		  
    ); */
	
}

