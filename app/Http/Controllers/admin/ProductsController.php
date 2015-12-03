<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;
use Session;
use App\Product;
use App\Marketplace;
	

class ProductsController extends Controller {

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
	public function index(Request $request)
	{	
		if($request->has('q')){
			$q = $request->get('q');
			$products = Product::where('name','like',"%$q%")->orWhere('sku','like',"%$q%")->orWhere('price','like',"%$q%")->orWhere('tags','like',"%$q%")->paginate(15);
		}
		else{
			//$products = Product::all();
			$products = Product::orderBy('id', 'desc')->paginate(15);
		}
		return view('admin.products.index')->with('products',$products);
	}
	
	//create new products
	function create(){
		$marketplaces = Marketplace::lists('name', 'id'); 
		return view('admin.products.create')->with('marketplaces',$marketplaces);
	
	}
	
	//store products 
	function store(Request $request){
	
		$allInput = $request->all();
		 
		
		$validator = Validator::make($allInput,Product::$rules); 
		if ($validator->fails()) {
			return redirect()->back()->withInput($allInput)->withErrors($validator->errors());
		}
		
		$product = new Product;
		$product::create($allInput);
		
		Session::flash('flash_message', 'Product has been created successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/products'); 
		 
	}
	
	//edit products
	function edit($id){
		
		if($id){
			$product = Product::find($id);
			$marketplaces = Marketplace::lists('name', 'id'); 
			return view('admin.products.edit')->with(compact('product','marketplaces'));
		}
		 
	}
	
	//update products
	function update(Request $request, $id){
		
		$allInput = $request->all();
		$validator = Validator::make($allInput,Product::$rules); 
		if ($validator->fails()) {
			return redirect()->back()->withInput($allInput)->withErrors($validator->errors());
		}
		
		$product = Product::find($id);
		$product->update($allInput);
		
		Session::flash('flash_message', 'Product has been updated successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/products'); 
		
	}
	
	
	//delete products
	public function destroy($id){
 
		if($id) {

			Product::destroy($id);
			Session::flash('flash_message', 'Product has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
			  
		}
		return redirect('admin/products');
		
	}
	

}
