<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Customer;
use App\Site;
use App\State;
use App\TestLocation;
use App\LocationType;
use Session;
 

class CustomersController extends Controller {

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
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		/*
		$id  = \Auth::user()->id;
		$orders  = Order::with('requestedBy')->where('user_id','=',$id)->orderBy('id','DESC')->get();
	
		return view('home')->with('orders',$orders);
		*/
	}
	
	 
	public function create()
	{
		return view('customers.create');
	}
   
	//store customer 
	function store(Request $request){
		
		$allInput = $request->all();
		$validator = Validator::make($allInput,Customer::$rules);
		
		if ($validator->fails()) {
			return redirect()->back()->withInput($allInput)->withErrors($validator->errors());
		}
		$customer = new Customer;
		$customer::create($allInput); 
		$customer_id = DB::getPdo()->lastInsertId();
		Session::flash('flash_message', 'Customer created successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('order?c='.$customer_id); 
		
	}
	
	function edit($id){
		if(!$id){
			return redirect()->back();
		}
		$customer = Customer::find($id);
		return view('customers.edit')->with('customer',$customer);
	}
	
	function update(Request $request,$id){
		
		if($id){
			$allInput = $request->all();
			$customer = Customer::find($id);
			$customer->update($allInput);
			Session::flash('flash_message', 'Customer updated successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('order?c='.$id); 
		
	}
	
	public function siteDetail()
	{
		
		$user = DB::table('customers')->where('id','=',$_GET['c'])->first();
		$states = State::get();
		return view('customers.sitedetail')->with(compact('states','user'));
	}
	
	public function addSiteDetail(Request $request){
		$allInput = $request->all();
		$messages = [
			'state_id.required' => 'Please select state.',
			'name.required' => 'The site name field is required.'
		];
		$validator = Validator::make($allInput,Site::$rules,$messages);
		
		if ($validator->fails()) {
			return redirect()->back()->withInput($allInput)->withErrors($validator->errors());
		}
		$customer = new Site;
		$customer::create($allInput); 
		$customer_id = $allInput['customer_id'];
		Session::flash('flash_message', 'Site detail added successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('order?c='.$customer_id);
	}
	
	function siteTestLocation($siteId){
		
		if($siteId){
					
			$locations = DB::table('test_locations')->where('site_id','=',$siteId)->orderBy('name','DESC')->get();
			//echo '<pre>'; print_r($orders['site']);  die;
			if($locations){ 
				return $locations;
			}
		}
		
		return array();
	}
	
	public function testLocation()
	{
		$locations_type = LocationType::get();
		$tests = DB::table('tests')
				->join('parameters', 'tests.parameter_id', '=', 'parameters.id')
				->join('states', 'tests.state_id', '=', 'states.id')
				->join('methods', 'tests.method_id', '=', 'methods.id')
				->join('test_methods', 'tests.test_method_id', '=', 'test_methods.id')
				->select('tests.id','tests.price','parameters.name as parameter','states.name as state','methods.name as method','states.name as state','test_methods.name as test_method')->orderBy('parameters.name')->get();
	
		return view('customers.testLocation')->with(compact('tests','locations_type'));
	}
	
	public function addTestLocation(Request $request){
		$allInput = $request->all();
		$messages = [
			'test_id.required' => 'Please select test.',
		];
		$validator = Validator::make($allInput,TestLocation::$rules,$messages);
		
		if ($validator->fails()) {
			return redirect()->back()->withInput($allInput)->withErrors($validator->errors());
		}
		$customer = new TestLocation;
		$customer::create($allInput);
		$customer_id = $allInput['customer_id'];		
		Session::flash('flash_message', 'Test location added successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('order?c='.$customer_id);
	}
	
	function siteEdit(Request $request){
		$id =  $request->input('st');
		if(!$id){
			return redirect()->back();
		}
		
		$site = Site::find($id);
		$states = State::get();
		return view('customers.siteEdit')->with(compact('site','states'));
	}
	
	function siteUpdate(Request $request){
		$allInput = $request->all();
		$site = Site::find($allInput['id']);
		if($site){
			$site->update($allInput);
			Session::flash('flash_message', 'Site Detail updated successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('order?c='.$allInput['c_id'].'&st='.$allInput['id']); 
		
	}
	
	function locationEdit(Request $request){
		$id =  $request->input('lc');
		if(!$id){
			return redirect()->back();
		}
		$tests = DB::table('tests')
				->join('parameters', 'tests.parameter_id', '=', 'parameters.id')
				->join('states', 'tests.state_id', '=', 'states.id')
				->join('methods', 'tests.method_id', '=', 'methods.id')
				->join('test_methods', 'tests.test_method_id', '=', 'test_methods.id')
				->select('tests.id','tests.price','parameters.name as parameter','states.name as state','methods.name as method','states.name as state','test_methods.name as test_method')->orderBy('parameters.name')->get();
		$location = TestLocation::find($id);
		$locations_type = LocationType::get();
		return view('customers.locationEdit')->with(compact('location','tests', 'locations_type'));
	}
	
	function locationUpdate(Request $request){
		$allInput = $request->all();
		$location = TestLocation::find($allInput['id']);
		if($location){
			$location->update($allInput);
			Session::flash('flash_message', 'Location Detail updated successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('order?c='.$allInput['c_id'].'&st='.$allInput['site_id'].'&lc='.$allInput['id']); 
		
	}
}
