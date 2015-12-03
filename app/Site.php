<?php namespace App;
	 
use Illuminate\Database\Eloquent\Model;
 
 
class Site  extends Model {

	protected $table = 'site_details';
	
	protected $fillable = ['customer_id','company_name','contact','name','address','state_id','phone','email','description','contact'];
	
	public static $rules = array(	
		'company_name'  => 'required',
        'name'          => 'required',                 
        'address'       => 'required',
		'state_id'      => 'required',
        'phone'         => 'required|Numeric',
		'email'         => 'required|Email',
		'contact'       => 'required' ,
		'description'   => 'required'
		
    );
	
	 
 
	
}
