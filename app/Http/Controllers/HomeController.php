<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Order;
use App\User;
use App\Role;
use App\OrderDetail;
use App\TestProcess;
use Redirect;
use App\TechnicianSchedule;
use Excel;
use Session;
use Mail;

class HomeController extends Controller {

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
		if (!$user->hasRole('client manager') && $user->hasRole('field technician')){
			Redirect::to('technician/jobs')->send();
		} else if($user->role_id=="5"){
			Redirect::to('order')->send();
		}
		
		
	}
	

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$id  = \Auth::user()->id;
		$user  = \Auth::user();
		
		$user_role = \Auth::user()->role_id;
		 
		if($user_role == 4){
			
			$tech = DB::table('raman.orders')
			->join('raman.customers', 'raman.orders.customer_id', '=', 'raman.customers.id')
			->join('raman.site_details', 'raman.orders.site_id', '=', 'raman.site_details.id')
			->join('work_schedule.events', 'raman.orders.id', '=', 'work_schedule.events.order_id')
			->join('work_schedule.calendars', 'work_schedule.events.calendar_id', '=', 'work_schedule.calendars.calendar_id')
			->select('raman.orders.id','raman.customers.contact_name','raman.site_details.name as site_name','work_schedule.calendars.name as field_tech','work_schedule.events.*')
			->where('work_schedule.calendars.technician_id','=', $id )
			->where('raman.orders.status','=', 1 )
			->get();
			
			 
			
		}
		
		
		$orders = Order::with(array('customer','site'))->where('user_id','=',$id)->orderBy('id','DESC')->get();
		
		foreach($orders as $progress){
			if($progress['status'] == 1){ 
				$tech1 = DB::table('work_schedule.events')
				->join('work_schedule.calendars', 'work_schedule.events.calendar_id', '=', 'work_schedule.calendars.calendar_id')
				->leftjoin('raman.reporting_schedule', 'raman.reporting_schedule.order_id', '=', 'work_schedule.events.order_id')
				->leftjoin('raman.laboratory_schedule', 'raman.laboratory_schedule.order_id', '=', 'work_schedule.events.order_id')
				->where('work_schedule.events.order_id','=',$progress['id'])
				->select('work_schedule.events.*','work_schedule.calendars.*','raman.reporting_schedule.start_date as rstart','raman.reporting_schedule.start_time as rstart_time','raman.laboratory_schedule.start_date as lstart','raman.laboratory_schedule.start_time as lstart_time')
				->first();
				//$tech = TechnicianSchedule::with('user')->where('order_id','=',$progress['id'])->first();
				$technician[$progress['id']] = $tech1;
				
			}
		}
		/*echo "<pre>";
		print_r($technician);*/
		return view('home')->with(compact('orders','technician','tech'));
	}
	
	function complete_order(Request $request){
		$input = $request->all(); 
		$email = '';
		if($input){
			$events = DB::table('work_schedule.events')->join('work_schedule.calendars', 'work_schedule.events.calendar_id', '=', 'work_schedule.calendars.calendar_id')->where('work_schedule.events.order_id','=',$input['id'])->select('work_schedule.calendars.name')->get();
	
		if(empty($events)){
			Session::flash('flash_message', 'Please assign and schedule technician first.');
			Session::flash('flash_type', 'alert-danger');
			return redirect('home/order-reveiw/'.$input['id']); 
		}else{
			//get email of technician 
			
			foreach($events as $event){
			
				$technician_email = DB::table('users')->where('name','=',$event->name)->select('email')->first();
				
				$email = $technician_email->email;
			
				Mail::send('emails.tech_notification', array('key' => 'value'), function($message) use($email)
				{
					$message->to($email, 'welcome')->subject('Ektimo jobs to do');
				});
			}
		}
		
		
		// update order status //
		$order = Order::with(array('details'))->find($input['id']);
		
		$data  = array();
		$i=0;
		foreach($order['details'] as $value){
			
			$test_processes = DB::table('test_processes')->join('process_items', 'test_processes.item_id', '=', 'process_items.id')->select('process_items.name','process_items.image')->where('test_id','=',$value->test_id)->get();
		
	
		$order_id = $value->order_id;
		$data[$i] = array(
			'parameter'   => $value['parameter'],
			'state' 	  => $value['state'],
			'method_type' => $value['method'],
			'method'  	  => $value['test_method'],
			'sampling'   => '',
			'Analysis'  => '',
			'quantity'  =>  $value['quantity']
		);
		
			foreach($test_processes as $item){
				$data[$i][$item->name] = $item->name.$item->image;
			}
			$i++;
		}
		
		// This is new code for excel image generate
		Excel::create('job_pack', function($excel) use($data, $order, $test_processes){
			
			$excel->sheet('excel', function($sheet) use($data, $order, $test_processes){
				$sheet->loadView('excel')->with('data', $data)->with('order', $order)->with('test_processes', $test_processes);
			});	
				
		})->store('xls', storage_path('excel/'.$order_id));
		
		/*Excel::create('job_pack', function($excel) use($data,$order_id){
			$excel->sheet('Sheet1', function($sheet) use($data,$order_id) {
				$head = array(
					'Parameter',
					'State',
					'Method type',
					'Test Method',
					'Sampling',
					'Analysis',
					'quantity'
				);
			
			$sheet->fromArray($head, null, 'A1', false, false);
			$r = 2;
			
			foreach($data as $val){
				$sheet->row($r,$val);
				$r++;
			}
			});
		})->store('xls', storage_path('excel/'.$order_id));
		*/
			
			if($order){
				$order->update(array(
					'status' => 1
				));
				
				//update order detail (quantitiy,price) //
				if(isset($input['quantity'])){
					foreach($input['quantity'] as $key => $qty){
						$order_detail  = OrderDetail::find($key);
						$order_detail->update(array(
							'quantity'  => $qty
						));
					}
				}
				
				if(isset($input['price'])){
					foreach($input['price'] as $key => $prc){
						$order_detail  = OrderDetail::find($key);
						$order_detail->update(array(
							'price'  => $prc
						));
					}
				}
				Session::flash('flash_message', 'Order has been approved successfully.');
				Session::flash('flash_type', 'alert-success');
			}
		}
		return redirect('home'); 
	}
	
	function cancel_order($id){
		if($id){
			$order  = Order::find($id);
			if($order){
				$order->update(array('status' =>2));
				Session::flash('flash_message', 'Order has been cancelled successfully.');
				Session::flash('flash_type', 'alert-success');
				
			}
		}
		return redirect('home'); 
	}
	
	function edit_order($id){
		if($id){
			$parameters = DB::table('parameters')->orderBy('parameters.name')->get();
		 
			//$order  = Order::with(array('customer','details'))->find($id);
			$order = array();
			$ord = DB::table('orders')
				->join('order_details', 'order_details.order_id', '=', 'orders.id')
				->join('customers', 'customers.id', '=', 'orders.customer_id')
				//->join('test_processes as t2', 't2.test_id', '=', 'order_details.test_id')
				//->join('process_items', 'process_items.id', '=', 't2.item_id')
				->select('orders.customer_id as customer_id','customers.contact_name','order_details.*')
				->where('orders.id','=',$id)
				->get();
			$order['details'] = $ord;
			foreach($ord as $key=>$value){
			$order['id'] = $value->order_id;
			$order['contact_name'] = $value->contact_name;
				$order['items'][$value->test_id] = DB::table('test_processes')
				->join('process_items', 'process_items.id', '=', 'test_processes.item_id')
				->select('process_items.name','test_processes.item_id')
				->where('test_processes.test_id','=',$value->test_id)
				->get();
			}	
			
			return view('edit_order')->with(compact('order','parameters'));
		}
		return redirect()->back(); 
	}
	
	function update_order(Request $request,$id){
		
		$input = $request->all();  
		if($id){
			$total = 0;
			$order  = Order::find($id);
			 
			foreach($input['parameter'] as $key => $parameter){
				 
				$orderArr = array();
				$orderArr['parameter'] = $parameter;
				$orderArr['state'] = $input['state'][$key];
				$orderArr['method'] = $input['method'][$key];
				$orderArr['test_method'] = $input['test_method'][$key];
				$orderArr['quantity'] = $input['quantity'][$key];
				$orderArr['price'] = $input['price'][$key];
				$orderArr['total'] = $orderArr['price'] * $orderArr['quantity'];
				if(isset($input['test_id'][$key])){
					$orderArr['test_id'] = $input['test_id'][$key]; 
				}
				$total += $orderArr['price'] * $orderArr['quantity']; 
				
				$orderDetails = OrderDetail::find($key);
				$orderDetails->update($orderArr);
				 
			}
			 
			if($total){ 
				$order->update(array('total' => $total));
			}
			Session::flash('flash_message', 'Order has been updated successfully.');
			Session::flash('flash_type', 'alert-success'); 
		}
		return redirect('home'); 
	}
	
	function order_reveiw($id){
		$order = Order::with(array('customer','site'))->where('orders.id','=',$id)->first();
		//$technicians = User::where('role_id','=',4)->where('status','=',1)->get();
		//$tech_schedule = TechnicianSchedule::where('order_id','=',$id)->first();
		
		$tech = DB::table('work_schedule.events')
		->join('work_schedule.calendars', 'work_schedule.events.calendar_id', '=', 'work_schedule.calendars.calendar_id')
		->leftjoin('raman.reporting_schedule', 'raman.reporting_schedule.order_id', '=', 'work_schedule.events.order_id')
		->leftjoin('raman.laboratory_schedule', 'raman.laboratory_schedule.order_id', '=', 'work_schedule.events.order_id')
		->where('work_schedule.events.order_id','=',$id)->select('work_schedule.calendars.name','raman.reporting_schedule.start_date as rstart','raman.reporting_schedule.start_time as rstart_time','raman.laboratory_schedule.start_date as lstart','raman.laboratory_schedule.start_time as lstart_time')->first();
		/*echo "<pre>";
		print_r($tech);die;*/
		return view('order_review')->with(compact('order','tech'));
		
	}
	
	function get_booked(Request $request){
		$tech_id = $request->input('tech_id');  
		$booked = TechnicianSchedule::select('start_date','end_date')->where('technician_id','=',$tech_id)->get();
		return json_encode($booked);
	}
	 
}
