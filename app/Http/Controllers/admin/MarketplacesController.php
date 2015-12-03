<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;
use Session;
use App\Marketplace;
	

class MarketplacesController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
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
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$marketplaces = Marketplace::all();
		return view('admin.marketplaces.index')->with('marketplaces',$marketplaces);
	}
	
	//create new marketplaces
	function create(){
		
		return view('admin.marketplaces.create');
	
	}
	
	//store marketplaces 
	function store(Request $request){
	
		$allInput = $request->all();
		
		$validator = Validator::make($allInput,Marketplace::$rules); 
		if ($validator->fails()) {
			return redirect()->back()->withInput($allInput)->withErrors($validator->errors());
		}
		$marketplace = new Marketplace;
		$marketplace::create($allInput);
		
		Session::flash('flash_message', 'Marketplace has been created successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/marketplaces'); 
		 
	}
	
	//edit marketplace
	function edit($id){
		
		if($id){
			$marketplace = Marketplace::find($id); 
			return view('admin/marketplaces.edit')->with('marketplace',$marketplace);
		}
		 
	}
	
	//update marketplace
	function update(Request $request, $id){
		
		$allInput = $request->all();
		$rules = Marketplace::$rules;
		$rules['name'].= ",id,$id";
		
		$validator = Validator::make($allInput,$rules); 
		if ($validator->fails()) {
			return redirect()->back()->withInput($allInput)->withErrors($validator->errors());
		}
		
		$marketplace = Marketplace::find($id);
		$marketplace->update($allInput);
		
		Session::flash('flash_message', 'Marketplace has been updated successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/marketplaces'); 
		
	}
	
	
	//delete marketplace
	public function destroy($id){
 
		if($id) {

			Marketplace::destroy($id);
			Session::flash('flash_message', 'Marketplace has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
			  
		}
		return redirect('admin/marketplaces');
		
	}
	

}
