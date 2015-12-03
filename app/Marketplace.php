<?php namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Marketplace extends Model {
	
	protected $table = 'marketplaces';
	
	protected $fillable = array(
			'name',
			'commission',
			'shipping_category'
			 
	);	
	
	public static $rules = array(
        'name'              => 'required|unique:marketplaces',                       
        'commission'        => 'required|Numeric',      
        'shipping_category' => 'required|Numeric'
		  
    ); 
}

