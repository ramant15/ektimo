<?php namespace App;
	 
use Illuminate\Database\Eloquent\Model;
 
 
class Customer  extends Model {

	protected $table = 'customers';
	
	protected $fillable = ['contact_name','company_name','address','telephone_number','mobile_number','email_address'];
	
	public static $rules = array(	
		'contact_name'              => 'required',
        'company_name'            	=> 'required',                 
        'address'            		=> 'required',
        'telephone_number'         	=> 'required|Numeric',
		'mobile_number'         	=> 'required|Numeric',
		'email_address'         	=> 'required|Email'       
    );
	
	 
 
	
}
