<?php namespace App;
	 
use Illuminate\Database\Eloquent\Model;
 
 
class TestLocation  extends Model {

	protected $table = 'test_locations';
	
	protected $fillable = ['name','test_id','site_id','description','type','location_id'];
	
	public static $rules = array(	
		'name'          => 'required',                 
        'description'   => 'required',
		'location_id'   => 'required',
		'type'          => 'required'
		
    );
	
}
