<?php namespace App;
	 
use Illuminate\Database\Eloquent\Model;
 
 
class TestFile  extends Model {

	protected $table = 'test_files';
	
	protected $fillable = ['file_name'];
	
	public static $rules = array(	
		
		
    );
	
	 
 
	
}
