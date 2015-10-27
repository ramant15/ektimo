<?php namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Order extends Model {
	
	protected $table = 'orders';
	
	protected $fillable = ['user_id','site_id','test_location_id', 'total','customer_id','interval','status','field_tech','scheduled'];
	
	 
	public function details(){
		return $this->hasMany('App\OrderDetail');
	}
	
	public function customer(){
		return $this->belongsTo('App\Customer');
	} 

	public function pr(){
		return $this->hasMany('App\TestProcess');
	} 
	
	public function site(){
		return $this->belongsTo('App\Site');
	} 
	
	
}

