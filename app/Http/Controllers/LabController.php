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

class LabController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');

	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index(request $request)
	{   
	
		$complete_events = DB::table('work_schedule.events')->where('work_schedule.events.status','=','1')->select('work_schedule.events.*')->get(); 
		 
		return view('lab/lab')->with(compact('complete_events'));
		
	}
	
public function lab_detail($id){
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
				 // $main_path = public_path().'/TestFiles/'.$userId."/".$id;
				 // $half_path = public_path().'/TestFiles/'.$userId;
				}
				if(File::exists($path)){
				/*$uploaded_file = \Input::File('test_files');
				print_r($uploaded_file);
					if($uploaded_file){echo "file_found";
						echo $fileName = $uploaded_file->getClientOriginalName();
						$uploaded_file->move($path, $fileName);
						// read uploaded file //
						/*Excel::load($path.'/'.$fileName, function($reader) {
							// Getting all results
							$results = $reader->toArray();
								
						});
							*/
						/*if(File::exists($main_path)){
						
						} else {
						 File::makeDirectory($main_path, 0775, true, true);
						}*/
					} else {
					// File::makeDirectory($half_path, 0775, true, true);
					 File::makeDirectory($path, 0775, true, true);
					}
					
					//Session::flash('flash_type', 'alert-success');	
					//Session::flash('flash_message', 'File uploaded successfully.');
				
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
		 $items = DB::table('users')->select('id','name')->where('type','=','laboratory')->get();	
		  
		return view('lab/lab_detail')->with(compact('job','detail','documents','job_file','test_material','items'));
			
	}
/**new function for file upload by technician**/
	public function lab_upload($id){
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
				 //$main_path = public_path().'/TestFiles/'.$userId."/".$id;
				 // $half_path = public_path().'/TestFiles/'.$userId;
				  
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
					//Session::flash('flash_type', 'alert-success');	
					//Session::flash('flash_message', 'File uploaded successfully.');
				
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
			$items = DB::table('users')->select('id','name')->where('type','=','laboratory')->get();	
		return view('lab/lab_detail')->with(compact('job','detail','documents','job_file','test_material','items'));
			
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
