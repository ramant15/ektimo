<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Order;
use App\User;
use App\OrderDetail;
use App\TestProcess;
use App\Test;
use App\TechnicianSchedule;
use App\Input;
use Session;
use Redirect;
use File;

class TechnicianController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$user  = \Auth::user();
		if (!$user->hasRole('field technician')){
			Redirect::to('order')->send();
		}
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function jobs(){
		$user  = \Auth::user();
	
		$jobs = DB::table('work_schedule.events')->join('work_schedule.calendars', 'work_schedule.events.calendar_id', '=', 'work_schedule.calendars.calendar_id')->where('work_schedule.calendars.name','=',$user['name'])->select('work_schedule.events.title',
		'work_schedule.events.description','work_schedule.events.order_id')->get();
		
		return view('technician/jobs')->with(compact('jobs'));
	}
	
	
	public function job_detail($id){
		if($id){
			$job = DB::table('work_schedule.events')->join('work_schedule.calendars', 'work_schedule.events.calendar_id', '=', 'work_schedule.calendars.calendar_id')->where('work_schedule.events.order_id','=',$id)->first();
			$file_path = base_path().'/storage/excel'.$id;
			if(File::exists($file_path)){
				$job_file = 'exist';
			}else{
				$job_file = '';
			}
			$detail = Order::with('details')->where('id','=',$id)->get();
			$documents = array();
			foreach($detail as $item){
				$test_id = $item['details'][0]['test_id'];
				$path = public_path().'/TestFiles/'.$test_id;
				if(File::exists($path)){
					$files = File::allFiles($path);
					if(!empty($files)){
						foreach($files as $file){
							$documents[] = array(
							'name' => $file->getfileName(),
							'path' =>  $file->getpathName()
							);
						
						}
					}
					
				}
			}
		
			return view('technician/job_detail')->with(compact('job','detail','documents','job_file'));
			
		}
	}
	
	public function download_files(){
		$order = \Input::get('order');
		$path = \Input::get('path');
		$name = \Input::get('name');
		if($order){
			 $file = base_path()."/storage/excel/".$order."/job_pack.xls";
			// return response()->download($file, "n-job_pack.xls");
		}elseif($path){
			return response()->download($path,$name);
		}
		
	}
	
}
