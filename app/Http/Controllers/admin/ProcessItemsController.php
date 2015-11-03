<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\ProcessItem;
use Session;
 

class ProcessItemsController extends Controller {

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
		$items = ProcessItem::get();
		return view('admin.processItems.index')->with(compact('items'));
	}
	
	public function create()
	{
		return view('admin.processItems.create');
	}
	
	function store(Request $request){
		 
		$input = $request->all();
		$image = $request->file('item_image');
		$imageName = $image->getClientOriginalName();
		$image->move(public_path() . '/ItemImages/', $imageName);
		$input['image'] = $imageName;
		$processItem = new ProcessItem;
		$processItem::create($input); 
		return redirect('admin/process-items'); 
	   
	}
	
	public function destroy(Request $request, $id){
		
		if($id){
			ProcessItem::destroy($id);
			Session::flash('flash_message', 'Process Item has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('admin/process-items'); 
		
	}
	
	function edit($id){
	
		$processItem = ProcessItem::find($id);
		
        if (is_null($processItem))
        {
            return redirect('admin/process-items');
        }
		return view('admin.processItems.edit')->with('item',$processItem);
	}
	
	function update(Request $request, $id ){
		
		$input = $request->all();
		$processItem =  ProcessItem::find($id);
		$processItem->update($input);
		Session::flash('flash_message', 'Process Item has been updated successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/process-items');
	}
	
	

}
