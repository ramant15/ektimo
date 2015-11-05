<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\LocationType;
use Session;

class LocationTypeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = LocationType::get();
		return view('admin.locationTypes.index')->with(compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.locationTypes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{ 
		$input = $request->all();
		$processItem = new LocationType;
		$processItem::create($input); 
		return redirect('admin/location-types'); 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$LocationType = LocationType::find($id);
		
        if (is_null($LocationType))
        {
            return redirect('admin/location-types');
        }
		return view('admin.locationTypes.edit')->with('item',$LocationType);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{ 
		$input = $request->all();
		$LocationType =  LocationType::find($id);
		$LocationType->update($input);
		Session::flash('flash_message', 'Location type has been updated successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/location-types');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{ 
		if($id){
			LocationType::destroy($id);
			Session::flash('flash_message', 'Location type has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('admin/location-types'); 
	}

}
