<?php namespace App\Http\Controllers\Admin;
	
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Validator;
	use App\User;
	use DB;
	use Session;
	
class UsersController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware( 'auth' );
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	 
	public function index()
	{  
		$id  = \Auth::user()->id;
		
		//$users = User::where('id', '<>', $id)->get();
		//$users = User::paginate(20);
		$users = User::orderBy('id', 'desc');
  		$users->where('id', '<>', $id);
  
  		$users = $users->paginate(20);
		return view('admin.users.index')->with('users',$users);	 
	}
	
	public function create()
	{
		return view('admin.users.create');
	}
	 
	function store(Request $request){
		 
		$input = $request->all();
			$rules = User::$rules;
			$rules['username'] = array('regex:/^[a-z0-9_-]{3,15}$/');
		$validator = Validator::make($input, $rules);
		
		if ($validator->fails()) {
			return redirect()->back()->withInput($input)->withErrors($validator->errors());	
		}
		 
		$user = new User;
		$input['password'] = bcrypt($request->password);
		//$input['role_id']  = ($input['type'] == 'client manager') ? 3 : 4;
		if($input['type'] == 'client manager') {$role= 3; } else if($input['type'] == 'operation_manager') {$role=5;}else if($input['type'] == 'laboratory') {$role=6;}else{$role=4;}
		$input['role_id']  = $role;
		$user::create($input); 
		return redirect('admin/users'); 
	   
	}
	
	public function destroy(Request $request, $id){
		
		if($id){
			User::destroy($id);
			Session::flash('flash_message', 'User has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('admin/users'); 
		
	}
	
	function edit($id){
	
		$user = User::find($id);
		
        if (is_null($user))
        {
            return redirect('admin/users');
        }
		return view('admin.users.edit')->with('user',$user);
	}
	
	function update(Request $request, $id ){
		
		$input = $request->all();
		$rules = User::$rules;
		$rules['email'] .= ',email,'.$id.',id';
		
		//$rules['email'].= ',id,'.$id;
		/*echo "<pre>";
		print_r($rules);die;*/
		if(empty($input['password']) && empty($input['password_confirmation'])){
			unset($rules['password'],$rules['password_confirmation'],$input['password'],$input['password_confirmation']);
		}
		if(!empty($input['username'])){
			unset($rules['username'],$rules['username'],$input['username'],$input['username']);
		}
		
		$validator = Validator::make($input,$rules);
		
		if ($validator->fails()) {
			return redirect()->back()->withInput($input)->withErrors($validator->errors()); 	
		}
		if(!empty($input['password']) && !empty($input['password_confirmation'])){
			$input['password'] = bcrypt($request->password);
		}
		$user =  User::find($id);
		$user->update($input);
		Session::flash('flash_message', 'User has been updated successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/users');
}

}
