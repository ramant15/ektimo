<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Process;
use App\ProcessItem;
use App\Test;
use Session;
 

class ProcessesController extends Controller {

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
	public function index(Request $request)
	{	
		$test = $request->get('test');
		$processes = array();
		if($test){
			$processData = DB::table('test_processes')->where('test_id','=',$test)->select('item_id')->get();
			$processes = array();
			foreach($processData as $key=>$value){
				$processes[] = $value->item_id;
			}
			
		}
		
			$tests = DB::table('tests')
				->join('parameters', 'tests.parameter_id', '=', 'parameters.id')
				->join('states', 'tests.state_id', '=', 'states.id')
				->join('methods', 'tests.method_id', '=', 'methods.id')
				->join('test_methods', 'tests.test_method_id', '=', 'test_methods.id')
				->select('tests.id','tests.price','parameters.name as parameter','states.name as state','methods.name as method','states.name as state','test_methods.name as test_method')->orderBy('parameters.name')->get();
		
		$items = ProcessItem::where('status','=',1)->get();
		return view('admin.processes.index')->with(compact('items','tests','processes'));
	}
	
	function store(Request $request){
		$data = array();
		$data['test_id'] = $request->get('test');
		$test_id = $request->get('test');
		DB::table('test_processes')->where('test_id','=',$test_id)->delete();
		if($request->has('test_item')){ 		
			//DB::table('test_processes')->where('test_id','=',$test_id)->delete();
				$items = $request->get('test_item');
				foreach($items as $key => $value) { 
				$process = new Process;
				$process::create(array('test_id'=> $test_id, 'item_id'=>$value, 'status'=>1) );					
				}
		Session::flash('flash_message', 'Process has been created successfully.');		
		}
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/processes?test='.$request->get('test')); 
	   
	}
	
	

}
