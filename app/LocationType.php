<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationType extends Model {

	protected $table = 'location_types';
	
	protected $fillable = ['id','name'];
	
	public static $rules = array(
     
    );

}
