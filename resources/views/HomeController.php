<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Order;
use App\User;
use App\OrderDetail;
use App\TestProcess;
use App\TechnicianSchedule;
use Session;
 

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
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$id  = \Auth::user()->id;
		$orders = Order::with(array('customer','site'))->where('user_id','=',$id)->orderBy('id','DESC')->get();
		return view('home')->with('orders',$orders);
	}
	
	function complete_order(Request $request){
		$input = $request->all(); 
		if($input){
			$messages = [
				'technician_id.required' => 'Please select the technician.',
			];
			
			$validator = Validator::make($request->all(), [
				'technician_id' => 'required'
			],$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
		$schedule = explode(' -',$input['schedule']);
		$start_date = trim($schedule[0]);
		$end_date = trim($schedule[1]);
			
		$data = array(
			'order_id'     => $input['id'],
			'technician_id'=> $input['technician_id'],
			'start_date'   => $start_date,
			'end_date'     => $end_date
			);
			
			$tech_schedule = new TechnicianSchedule;		
			$tech_schedule->create($data);
		
			// update order status //
			$order  = Order::find($input['id']);
			$order_detail  = OrderDetail::find($input['detail_id']);
			if($order){
				$order->update(array(
					'status' => 1
				));
				
			//update order detail (quantitiy,price) //
			$order_detail->update(array(
				'quantity'  => $input['quantity'],
				'price' 	=> $input['price']
			));
				
			Session::flash('flash_message', 'Order has been completed successfully.');
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
		return redirect()->back(); 
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
		$technicians = User::where('role_id','=',4)->where('status','=',1)->get();
		$tech_schedule = TechnicianSchedule::select('start_date','end_date')->get();
		return view('order_review')->with(compact('order','technicians','tech_schedule'));
		
	}
	
	function get_booked(Request $request){
		$tech_id = $request->input('tech_id');  
		$booked = TechnicianSchedule::select('start_date','end_date')->where('technician_id','=',$tech_id)->get();
		return json_encode($booked);
	}
	 
}
