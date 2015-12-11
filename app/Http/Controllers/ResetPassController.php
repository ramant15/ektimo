<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Order;
use App\User;
use App\Role;
use App\OrderDetail;
use App\TestProcess;
use Redirect;
use App\TechnicianSchedule;
use Excel;
use Session;
use Mail;
use Response;
use App\Http\Controllers\Controller;
use Hash;
use Input;
 use Auth;

class ResetPassController extends Controller {

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
		public function change_password(Request $request)
		{
			$input = $request->all(); 
			  $user 		= $request->user();
			  $user_detail 		= json_decode($user,true);
			  $user_id 			= $user_detail['id'];
			  $current_password = $input['current_password'];
			  $new_password 	= $input['new_password'];
			  $confirm_password = $input['confirm_password'];
			  
			$validator = Validator::make($request->all(), [
	            'current_password' => 'required|min:6',
	            'new_password' => 'required|min:6',
				'confirm_password' => 'required|same:new_password'
	        ]);
	
	        if ($validator->fails()) {
	            return redirect('/change-password')
	                        ->withErrors($validator)
	                        ->withInput();
	        }
	        
		if (Hash::check(Input::get('current_password'), Auth::user()->password))
		{ 
		     $user->password = bcrypt($new_password);
		   $user->save();
		  	 $request->session()->flash('alert-success', 'Password changed successful.');
   			 return view("auth/change_password");
		   
		}else {
			return Redirect::back()->withErrors(['Sorry! Your current password not match,Please try again']);
		}
			/* echo "<pre>";
			print_r($input);
			die;*/
		}
}
