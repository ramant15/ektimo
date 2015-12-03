<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Parameter;
use App\Test;
use App\State;
use App\Method;
use App\TestMethod;
use App\Order;
use App\OrderDetail;
use App\Customer;
use Mail;
use App\Site;
class OrderController extends Controller {

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
	
		if($request->input('st')){
			$site_id = $request->input('st');
			$state_id = DB::table('site_details')->where('id','=',$site_id)->pluck('state_id');
			
			if($state_id){
				$parameters = DB::table('parameters')->join('tests', 'tests.parameter_id', '=', 'parameters.id')->where('tests.state_id', '=', $state_id)->orderBy('parameters.name')->get();
			}
			
		}else{
			$state_id = ""; 
			$parameters = DB::table('parameters')->orderBy('parameters.name')->get();
		}
		$users = DB::table('users')->where('role_id','=',3)->select('id','name','email')->get(); 
		$customers  = Customer::all();   
		$orders = Order::where('customer_id','=',14)->get(); 
		 
		return view('order/index')->with(compact('parameters','users','orders','customers','state_id'));
		
	}
	
	public function getState(Request $request)
	{
		$input = $request->all(); 
		if($input['state_id']){
			//$states = DB::table('states')->where('id', '=',  $input['state_id'])->select('id as state_id','name')->get();
			$states = DB::table('tests')->where('tests.state_id', '=',  $input['state_id'])->where('state_id', '=',  $input['state_id'])->join('states', 'tests.state_id', '=', 'states.id')->groupBy('tests.state_id')->get();
			
		}elseif($input['site_id'] &&  empty($input['state_id'])) {		
			$state_id = DB::table('site_details')->where('id','=',$input['site_id'])->pluck('state_id');
			//$states = DB::table('states')->where('id', '=',  $state_id)->select('id as state_id','name')->get();
			$states = DB::table('tests')->where('tests.parameter_id', '=',  $input['param_id'])->where('state_id', '=',  $state_id)->join('states', 'tests.state_id', '=', 'states.id')->groupBy('tests.state_id')->get();
		}elseif($input['param_id'] && empty($input['state_id']) && empty($input['site_id'])){
			$states = DB::table('tests')->where('tests.parameter_id', '=',  $input['param_id'])->join('states', 'tests.state_id', '=', 'states.id')->groupBy('tests.state_id')->get();
		}
	
		return json_encode( $states );
	
	}
	
	public function getMethod(Request $request)
	{
		$input = $request->all();
	
		$methods['method'] = DB::table('tests')->where('tests.parameter_id', '=',  $input['param_id'])->where('tests.state_id', '=',  $input['state_id'])->join('methods', 'tests.method_id', '=', 'methods.id')->groupBy('tests.method_id')->get();
		$methods['test_method'] = array();
			
		foreach($methods['method'] as $method){
			$methods['test_method'] = DB::table('test_methods')
					->where('test_methods.id', '=',  $method->test_method_id)->first();
				
		}
	
		return json_encode( $methods );
	
	}
	
	public function getTestMethod(Request $request)
	{
	$input = $request->all();
	
	$methods = DB::table('tests')
	->where('tests.parameter_id', '=',  $input['param_id'])
	->where('tests.state_id', '=',  $input['state_id'])
	->where('tests.method_id', '=',  $input['method_id'])
	->join('test_methods', 'tests.test_method_id', '=', 'test_methods.id')
	->select('tests.*','test_methods.name')->groupBy('tests.test_method_id')->get();
	
	return json_encode( $methods );	
	}
	
	public function saveClientOrder(Request $request)
	{
		
		$input = $request->all();
		
		if(!empty($input['qty'])){
		
			$mainArr = array();
			$hbody = '';
			
			$loc_info = DB::table('test_locations')->where('id','=',$input['test_location_id'])->first();
			$orderData = array(
				'user_id'     => $input['user_id'],
				'customer_id' => $input['customer_id'],
				'site_id'     => $input['site_id'],
				'test_location_id' => $input['test_location_id'],
				'interval' =>  $input['interval']
			);
			
			$order = new Order;		
			$order->create($orderData);
			$order_id = DB::getPdo()->lastInsertId();
			
			$total = 0;	
			
			foreach($input['qty'] as $test_id => $qty){
			
				$data = DB::table('tests')
				->where('tests.id', '=',  $test_id)
				->join('parameters', 'tests.parameter_id', '=', 'parameters.id')
				->join('states', 'tests.state_id', '=', 'states.id')
				->join('methods', 'tests.method_id', '=', 'methods.id')
				->join('test_methods', 'tests.test_method_id', '=', 'test_methods.id')
				->select('tests.id','tests.price','parameters.name as parameter','states.name as state','methods.name as method','states.name as state','test_methods.name as test_method')->first();
		
				$orderArr = array();
				$orderArr['order_id'] = $order_id;
				$orderArr['test_id'] = $test_id;
				$orderArr['location_id'] = $loc_info->location_id;
				$orderArr['location_type'] = $loc_info->type;
				$orderArr['location_name'] = $loc_info->name;
				$orderArr['location_description'] = $loc_info->description;
				$orderArr['quantity'] = $qty;
				$orderArr['price'] = round($qty*$data->price,2);
				$orderArr['parameter'] = $data->parameter;
				$orderArr['state'] = $data->state;
				$orderArr['method'] = $data->method.'-'.$data->test_method;
				$orderArr['test_method'] = $data->test_method;
				$orderArr['total'] = $orderArr['price'] * $orderArr['quantity'];
				
				$hbody .= 	"<tr>
					<td width='300px'>".$orderArr['location_id']."</td>
					<td width='300px'>".$orderArr['location_type']."</td>
					<td width='300px'>".$orderArr['location_description']."</td>
					<td width='300px'>".$orderArr['parameter']."</td>
					<td width='30px'>".$orderArr['state']."</td>
					<td width='50px'>".$orderArr['method']."</td>
					<td width='200px'>".$orderArr['test_method']."</td>
					<td width='20px'>".$orderArr['quantity']."</td>
					<td width='50px'>$".$orderArr['price']."</td></tr>";
							
				$orderDetails = new OrderDetail;		
				$orderDetails->create($orderArr);
				$total +=  $orderArr['total'];
			}
			
			$order  = Order::find($order_id);
			$order->update(array('total' => $total));
			
			$html = "<p>Hi Admin,</p>";
			$html .= "<p>There is order requested by Customer Id: ".$input['customer_id']."</p>";
			$html .= "<table style='border:1px solid #ccc'>
					<thead style='border-bottom:1px solid #ccc'>
					<td width='300px'><strong>Location ID</strong></td>
					<td width='30px'><strong>Location type</strong></td>
					<td width='50px'><strong>Location Description</strong></td>
					<td width='300px'><strong>Parameter</strong></td>
					<td width='30px'><strong>State</strong></td>
					<td width='50px'><strong>Method</strong></td>
					<td width='200px'><strong>Test Method</strong></td>
					<td width='20px'><strong>Qty</strong></td>
					<td width='50px'><strong>Price</strong></td>
					</thead>
					<tbody>";	
		
			$hend = "</tbody></table><p>Thanks</p>";
			$allhtml = 	$html.$hbody.$hend;
			//mail('deep@nascenture.com', 'Order Request', $allhtml);
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <ghostcoder15@gmail.com>' . "\r\n";
			
			$to = "deep@nascenture.com";
			$subject = "Order Request";
			mail($to,$subject,$allhtml,$headers);
			
			 
		}
	
		if($order_id){
			Session::flash('flash_message', 'Request Submitted Successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('order');
	}
	
	function customerOrders($customerId){
		if($customerId){
			$orders['order'] = Order::with('details')->where('customer_id','=',$customerId)->orderBy('id','DESC')->get();
			
			//$orders = DB::table('orders')->where('orders.customer_id', '=', $customerId)->rightJoin('order_details', 'order_details.order_id', '=', 'orders.id')->orderBy('orders.id','DESC')->get();
			
			$orders['site'] = DB::table('site_details')->where('customer_id','=',$customerId)->orderBy('name','DESC')->get();
			
			if($orders){ 
				return $orders;
			}
		}
		
		return array();
	}
	
	function getOrder($orderId){
		
		if($orderId){
			$order = Order::with('details')->where('id','=',$orderId)->orderBy('id','DESC')->get();
		
			if($order){ 
				return $order;
			}
		}
	}
	
	public function getParameter($site_id)
	{ 
		if($site_id){
			$state_id = DB::table('site_details')->where('id','=',$site_id)->pluck('state_id');
			$parameters = DB::table('parameters')->join('tests', 'tests.parameter_id', '=', 'parameters.id')->where('tests.state_id', '=', $state_id)->select('parameters.id as id','name')->orderBy('parameters.name')->get();
		}else{
			$parameters = DB::table('parameters')->orderBy('parameters.name')->get();
		}
		
		return $parameters;
	
	}
	
}
