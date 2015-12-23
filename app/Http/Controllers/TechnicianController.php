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
use Excel;

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
		'work_schedule.events.description','work_schedule.events.order_id','work_schedule.events.create_date')->orderBy('create_date', 'desc')->get();
		$jobModified = array();
		foreach($jobs as $key => $value){
				$test_material = DB::table('site_details')->rightJoin('orders','site_details.customer_id','=','orders.customer_id')->where('orders.id','=',$value->order_id)->select('site_details.created_at')->first();
			/*echo $test_material->created_at;
			echo "<pre>";
				print_r($test_material);*/
			$jobModified[$key]['created'] = $test_material->created_at;
			$jobModified[$key]['order'] = $value->order_id;
			$jobModified[$key]['title'] = $value->title;
			$jobModified[$key]['description'] = $value->description;
			//$createdAt=$test_material->created_at;
			//$jobModified->put('create',$createdAt);
				/*echo "<pre>";
				print_r($jobModified);*/ //die;
		}
          // $new_arra =  array_merge($jobs,$jobModified);
           	/*echo "<pre>";
				print_r($jobModified);*/
		return view('technician/jobs')->with(compact('jobs','jobModified'));
	}
	
	
	public function job_detail($id){
		  $user  = \Auth::user();   
        $userId = $user->id;   
		if($id){
			$job = DB::table('work_schedule.events')
			->join('work_schedule.calendars', 'work_schedule.events.calendar_id', '=', 'work_schedule.calendars.calendar_id')
			->leftjoin('raman.reporting_schedule', 'raman.reporting_schedule.order_id', '=', 'work_schedule.events.order_id')
			->leftjoin('raman.laboratory_schedule', 'raman.laboratory_schedule.order_id', '=', 'work_schedule.events.order_id')
			->where('work_schedule.events.order_id','=',$id)
			->select('work_schedule.events.*','work_schedule.calendars.*','raman.reporting_schedule.start_date as rstart','raman.reporting_schedule.start_time as rstart_time','raman.laboratory_schedule.start_date as lstart','raman.laboratory_schedule.start_time as lstart_time')
			->first();
			$file_path = base_path().'/storage/excel/'.$id;
			/*echo "<pre>";
			print_r($job);*/
			if(File::exists($file_path)){
				$job_file = 'exist';
			}else{
			File::makeDirectory($file_path, 0775, true, true);
				$job_file = '';
			}
			
			$detail = Order::with('details')->join('site_details','site_details.id','=','orders.site_id')->where('orders.id','=',$id)->first();
		
			foreach($detail['details'] as $value){
				$test_material[] = DB::table('test_processes')->join('process_items', 'test_processes.item_id', '=', 'process_items.id')->select('process_items.name','process_items.image','process_items.type')->where('test_id','=',$value['test_id'])->get();
			}
			
			$documents = array();
			foreach($detail['details'] as $item){
				  $test_id = $item['test_id'];
				  //$path = public_path().'/TestFiles/'.$test_id;
				  $path = public_path().'/TestFiles/'.$id;
				}
				if(File::exists($path)){
					} else {
					 File::makeDirectory($path, 0775, true, true);
					}
					
				
					$files = File::allFiles($path);
					if(!empty($files)){
						foreach($files as $file){
							$documents[] = array(
							'name' => $file->getfileName(),
							'path' =>  $file->getpathName()
							);
						}
					}
				//}
			//}
		}
			
		return view('technician/job_detail')->with(compact('job','detail','documents','job_file','test_material'));
			
	}
	/**new function for file upload by technician**/
	public function job_upload($id){
		 $user  = \Auth::user();   
        $userId = $user->id;   
		if($id){
			$job = DB::table('work_schedule.events')->join('work_schedule.calendars', 'work_schedule.events.calendar_id', '=', 'work_schedule.calendars.calendar_id')->where('work_schedule.events.order_id','=',$id)->first();
			$file_path = base_path().'/storage/excel/'.$id;
			
			if(File::exists($file_path)){
				$job_file = 'exist';
			}else{
				$job_file = '';
			}
			
			$detail = Order::with('details')->join('site_details','site_details.id','=','orders.site_id')->where('orders.id','=',$id)->first();
		
			foreach($detail['details'] as $value){
				$test_material[] = DB::table('test_processes')->join('process_items', 'test_processes.item_id', '=', 'process_items.id')->select('process_items.name','process_items.image','process_items.type')->where('test_id','=',$value['test_id'])->get();
			}
			
			$documents = array();
			foreach($detail['details'] as $item){
				  $test_id = $item['test_id'];
				   // $path = public_path().'/TestFiles/'.$userId."/".$id;
				   $path = public_path().'/TestFiles/'.$id;
				  
				if(File::exists($path)){
				$uploaded_file = \Input::File('test_files');
				
					if($uploaded_file){
						 $fileName = $uploaded_file->getClientOriginalName();
						$uploaded_file->move($path, $fileName);
						// read uploaded file //
						Excel::load($path.'/'.$fileName, function($reader) {
							// Getting all results
							$results = $reader->toArray();
								
						});
						
					}
				
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
		}
			
		return view('technician/job_detail')->with(compact('job','detail','documents','job_file','test_material'));
			
	}
	
	public function job_submit($id){
		  $user  = \Auth::user();   
        $userId = $user->id; 
        DB::table('work_schedule.events')
            ->where('work_schedule.events.order_id', $id)
            ->update(['status' => '1']);
            return redirect('technician/jobs');
	}
	
	public function download_files(){
		$order = \Input::get('order');
		$path = \Input::get('path');
		$name = \Input::get('name');
		if($order){
			 $file = base_path()."/storage/excel/".$order."/job_pack.xls";
			 return response()->download($file, "Ektimo_Flows_Spreadsheet.xlsm");
		}elseif($path){
			return response()->download($path,$name);
		}
		
	}
	
}
