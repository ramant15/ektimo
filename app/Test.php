<?php namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Test extends Model {
	
	protected $table = 'tests';
	
	public $timestamps = false;
	
	protected $fillable = array(
			'parameter_id', 
			'state_id',
			'method_id', 
			'test_method_id',
			'price'
	);	
	/*
	public static $rules = array(
        'name'        => 'required',  
		'price'       => 'required|Numeric',
        'sku'         => 'required',      
		'link_to_product' => 'url', 
		'shipping_cost_swiss' => 'Numeric', 
		'shipping_cost_dutch' => 'Numeric'
		  
    ); */
	
	
}

