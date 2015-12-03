<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Process;
use App\ProcessItem;
use App\Test;
use Session;
use App\Parameter;
use App\State;
use App\Method;
use App\TestMethod;
use App\TestFile;
use File;
use Excel;

class TestsController extends Controller {

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
		
		$processes = array();
			$tests = DB::table('tests')
				->join('parameters', 'tests.parameter_id', '=', 'parameters.id')
				->join('states', 'tests.state_id', '=', 'states.id')
				->join('methods', 'tests.method_id', '=', 'methods.id')
				->join('test_methods', 'tests.test_method_id', '=', 'test_methods.id')
				->select('tests.id','tests.price','parameters.name as parameter','states.name as state','methods.name as method','states.name as state','test_methods.name as test_method')->paginate(20);
		
		$items = ProcessItem::where('status','=',1)->get();
		return view('admin.tests.index')->with(compact('items','tests'));
	}
	
	public function create()
	{	
		
		$processes = array();
		$tests = DB::table('tests')
			->join('parameters', 'tests.parameter_id', '=', 'parameters.id')
			->join('states', 'tests.state_id', '=', 'states.id')
			->join('methods', 'tests.method_id', '=', 'methods.id')
			->join('test_methods', 'tests.test_method_id', '=', 'test_methods.id')
			->select('tests.id','tests.price','parameters.name as parameter','states.name as state','methods.name as method','states.name as state','test_methods.name as test_method')->get();
		
		$items = ProcessItem::where('status','=',1)->get();
		
		return view('admin.tests.create')->with(compact('items','tests'));
	}
	
	function store(Request $request){
		$input = $request->all();
		$testArr = array();
		$files = $request->file('test_files');
		 
		
		$getParam = Parameter::where('name','=',$input['parameter'])->first();
		if(!empty($getParam)){
			$testArr['parameter_id'] = $getParam->id;
		}else{
			$parameter = new Parameter;		
			$parameter->create(array('name'=>$input['parameter']));
			$testArr['parameter_id'] = DB::getPdo()->lastInsertId();
		}
		
		$getState = Parameter::where('name','=',$input['state'])->first();
		if(!empty($getState)){
			$testArr['state_id'] = $getState->id;
		}
		else{
			$state = new State;		
			$state->create(array('name'=>$input['state']));
			$testArr['state_id'] = DB::getPdo()->lastInsertId();
		}
		
		$getMethod = Method::where('name','=',$input['method'])->first();
		
		if(!empty($getMethod)){
		$testArr['method_id'] = $getMethod->id;
		}else{
			$method = new Method;		
			$method->create(array('name'=>$input['method']));
			$testArr['method_id'] = DB::getPdo()->lastInsertId();
		}
		
		$getTestMethod = TestMethod::where('name','=',$input['test_method'])->first();
		
		if(!empty($getTestMethod)){
		$testArr['test_method_id'] = $getTestMethod->id;
		}else{
			$tmethod = new TestMethod;		
			$tmethod->create(array('name'=>$input['test_method']));
			$testArr['test_method_id'] = DB::getPdo()->lastInsertId();
		}
		
		$checkTest = Test::where('parameter_id','=',$testArr['parameter_id'])->where('parameter_id','=',$testArr['state_id'])->where('parameter_id','=',$testArr['method_id'])->where('parameter_id','=',$testArr['test_method_id'])->first();
		
		if($checkTest){
			$test_id = $checkTest->id;
			Session::flash('flash_message', 'Test already exist.');
		}else{
			$testArr['price'] = $input['price'];
			$test = new Test;
			$test::create($testArr);
			$test_id = DB::getPdo()->lastInsertId();
			Session::flash('flash_message', 'Test created successfully.');
		}
		
		if($test_id){
			if(!empty($files[0])){
				foreach($files as $file){
					$fileName = $file->getClientOriginalName();
					$file->move(public_path() . '/TestFiles/'.$test_id, $fileName);
					$file = new TestFile;
					$file::create(array('file_name' => $fileName));					
				}
			}
			DB::table('test_processes')->where('test_id','=',$test_id)->delete();
			
			if($request->has('test_item')) {
				$items = $request->get('test_item');
				foreach($items as $key => $value) {
				$process = new Process;
				$process::create(array('test_id'=> $test_id, 'item_id'=>$value, 'status'=>1) );					
				}
			}
		}
		
		Session::flash('flash_type', 'alert-success');		
		return redirect('admin/tests'); 
			   
	}
	
	public function process_items($test_id)
	{	
		$processes = array();
		if($test_id){
			 //$processes = DB::table('test_processes')->where('test_id','=',$test_id)->select('item_id')->get();
			 $items = DB::table('test_processes')
				->join('process_items', 'test_processes.item_id', '=', 'process_items.id')
				->where('test_processes.test_id','=',$test_id)
				->select('process_items.name','test_processes.id','test_processes.item_id')->orderBy('process_items.name')->get();
			 
		}
		
		return view('admin.tests.process_items')->with(compact('items','test_id'));
	}
	
	function edit($id){
	
		$test = Test::join('parameters', 'parameters.id', '=', 'tests.parameter_id')
			->join('test_methods', 'test_methods.id', '=', 'tests.test_method_id')
			->join('methods', 'methods.id', '=', 'tests.method_id')
			->join('states', 'states.id', '=', 'tests.state_id')
			->where('tests.id','=',$id)
			->select('tests.*','test_methods.name as test_method_name','methods.name as method_name','parameters.name as param_name','states.name as state_name')
			->first();
	
        if (is_null($test))
        {
            return redirect('admin/tests');
        }
		
		$selected_items = Process::where('test_id','=',$id)->join('process_items', 'test_processes.item_id', '=', 'process_items.id')->select('test_processes.item_id')->get();
	
		foreach($selected_items as $selected){
			$selected_ids[] = $selected['item_id'];
		}
		
		$path = public_path().'/TestFiles/'.$id;
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
		
		$items = ProcessItem::where('status','=',1)->get();
		return view('admin.tests.edit')->with(compact('items','selected_ids','test','documents'));
	
	}
	
	function update(Request $request, $id ){

		$input = $request->all();
		$files = $request->file('test_files');
		
		if(!empty($files[0])){
			foreach($files as $file){
				$fileName = $file->getClientOriginalName();
				$file->move(public_path() . '/TestFiles/'.$id, $fileName);
				$file = new TestFile;
				$file::create(array('file_name' => $fileName));					
			}
		}
		$getParam = Parameter::where('name','=',$input['parameter'])->first();
		if(!empty($getParam)){
			$arr['parameter_id'] = $getParam->id;
		}
		
		$getState = Parameter::where('name','=',$input['state'])->first();
		if(!empty($getState)){
			$arr['state_id'] = $getState->id;
		}
		
		$getMethod = Method::where('name','=',$input['method'])->first();
		if(!empty($getMethod)){
			$arr['method_id'] = $getMethod->id;
		}
		
		$getTestMethod = TestMethod::where('name','=',$input['test_method'])->first();
		if(!empty($getTestMethod)){
			$arr['test_method_id'] = $getTestMethod->id;
		}
	
		$test = Test::find($id);
		$test->update($arr);
		// update test items //
			DB::table('test_processes')->where('test_id','=',$id)->delete();
			
			if($request->has('test_item')) {
				$items = $request->get('test_item');
				foreach($items as $key => $value) {
				$process = new Process;
				$process::create(array('test_id'=> $id, 'item_id'=>$value, 'status'=>1) );					
				}
			}
		Session::flash('flash_message', 'Test has been updated successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/tests');
	}
	
	public function destroy(Request $request, $id){
		
		if($id){
			Test::destroy($id);
			Session::flash('flash_message', 'Test has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('admin/tests'); 
		
		
	}
	public function delete_file(){
		$path = \Input::get('path');
		$name = \Input::get('name');
		if($name){
			if(File::delete($path)){
			DB::table('test_files')->where('file_name','=',$name)->delete();
			Session::flash('flash_message', 'File deleted successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect()->back(); 
		}
	}
}
