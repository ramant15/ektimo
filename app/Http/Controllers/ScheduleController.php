<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Response;
use DateTime;

class ScheduleController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		//return redirect('schedule');
		return view('schedule')->with('id',$id);
	}
	
	public function save_schedule(Request $request)
	{
		$input = $request->all(); 
		$start_date= $input['start_date'];
		$end_date= $input['end_date'];
		$start_time= $input['start_time'];
		$end_time= $input['end_time'];
		$title = $input['title'];
		$order_id =  $input['order_id'];
		$description = $input['description'];
		$dt = new DateTime;
         $new_date = $dt->format('m-d-y H:i:s');
		$result = DB::table('laboratory_schedule')
						    ->where('order_id', '=', $order_id)
						    ->first();
	
		if (is_null($result)) {
			// not exists- create new entry
			DB::table('laboratory_schedule')->insert(
		    ['title' => $title,'order_id' => $order_id, 'created_at'=> $new_date,'description' => $description,'start_date' => $start_date, 'end_date' => $end_date,'start_time' => $start_time, 'end_time' => $end_time]
			);
			 return Response::json(array('success' => true), 200);
		} else {
		// Already added - delete the existing
		    DB::table('laboratory_schedule')
           ->where('order_id', '=', $order_id)
            ->update(
		    ['title' => $title,'order_id' => $order_id, 'created_at'=> $new_date,'description' => $description,'start_date' => $start_date, 'end_date' => $end_date,'start_time' => $start_time, 'end_time' => $end_time]
			);
		    return Response::json(array('success' => true), 200);
		}
		
	}

	public function get_schedule(Request $request)
	{
		$input = $request->all(); 
		$order_id= $input['order_id'];
		$users = DB::table('laboratory_schedule')->select('title', 'start_date as start','end_date as end')->where('order_id', '=', $order_id)->get();
		$new_arr=array();
		foreach($users as $key=>$value){
		$y = date('Y',strtotime($value->start));
		$m =date('m',strtotime($value->start));
		$d = date('d',strtotime($value->start));
		/*for end ddate*/
		$ey = date('Y',strtotime($value->end));
		$em =date('m',strtotime($value->end));
		$ed = date('d',strtotime($value->end));
		$new_arr[$key]['end']= $ey ."-".$em."-".$ed;
		$new_arr[$key]['start']= $y ."-".$m."-".$d;
		$new_arr[$key]['title']=$value->title;
		}
		//print_r($new_arr);
		return json_encode($new_arr);
	}
	
	public function schedule_report($id)
	{
		return view('schedule_report')->with('id',$id);;
	}
	
	public function save_schedule_report(Request $request)
	{
		$input = $request->all(); 
		$start_date= $input['start_date'];
		$end_date= $input['end_date'];
		$start_time= $input['start_time'];
		$end_time= $input['end_time'];
		$title = $input['title'];
		$description = $input['description'];
		$dt = new DateTime;
        $new_date = $dt->format('m-d-y H:i:s');
        $order_id =  $input['order_id'];
		
		$result = DB::table('reporting_schedule')
						    ->where('order_id', '=', $order_id)
						    ->first();
	
		if (is_null($result)) {
			// not exists- create new entry
			DB::table('reporting_schedule')->insert(
		    ['title' => $title,'order_id' => $order_id, 'created_at'=> $new_date,'description' => $description,'start_date' => $start_date, 'end_date' => $end_date,'start_time' => $start_time, 'end_time' => $end_time]
			);
			 return Response::json(array('success' => true), 200);
		} else {
		// Already added - delete the existing
		    DB::table('reporting_schedule')
           ->where('order_id', '=', $order_id)
            ->update(
		    ['title' => $title,'order_id' => $order_id, 'created_at'=> $new_date,'description' => $description,'start_date' => $start_date, 'end_date' => $end_date,'start_time' => $start_time, 'end_time' => $end_time]
			);
		    return Response::json(array('success' => true), 200);
		}
	}
	
	public function get_schedule_report(Request $request)
	{
		$input = $request->all(); 
		$order_id= $input['order_id'];
		$users = DB::table('reporting_schedule')->select('title', 'start_date as start','end_date as end')->where('order_id', '=', $order_id)->get();
		$new_arr=array();
		foreach($users as $key=>$value){
		$y = date('Y',strtotime($value->start));
		$m =date('m',strtotime($value->start));
		$d = date('d',strtotime($value->start));
		/*for end ddate*/
		$ey = date('Y',strtotime($value->end));
		$em =date('m',strtotime($value->end));
		$ed = date('d',strtotime($value->end));
		$new_arr[$key]['end']= $ey ."-".$em."-".$ed;
		$new_arr[$key]['start']= $y ."-".$m."-".$d;
		$new_arr[$key]['title']=$value->title;
		}
		//print_r($new_arr);
		return json_encode($new_arr);
	}
}
