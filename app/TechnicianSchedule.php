<?php namespace App;

use Illuminate\Database\Eloquent\Model;
 
class TechnicianSchedule extends Model {
	
	protected $table = 'technician_schedules';
	
	protected $fillable = ['order_id','technician_id','start_date', 'end_date','comment'];
	
	public function user(){
		return $this->belongsTo('App\User','technician_id');
	} 
}

