<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password','type','role_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	public static $rules = array(
        'name'             => 'required|unique:users',                     
        'email'            => 'required|email',    
		'password'         => 'required',
        'password_confirmation' => 'required|same:password' ,
		'type'		       => 'required',		
    );
	 /**
     * Get the roles a user has
     */
	public function roles()
    {
       return $this->belongsToMany('App\Role', 'user_roles');
	}
	 /**
     * Find out if User is an employee, based on if has any roles
     *
     * @return boolean
      */
     public function isEmployee()
     {
         $roles = $this->roles->toArray();
         return !empty($roles);
     }
	 /**
      * Find out if user has a specific role
      *
      * $return boolean
      */
     public function hasRole($check)
     {
	
        return in_array($check, array_fetch($this->roles->toArray(), 'name'));
		
     }
 
     /**
      * Get key in array with corresponding value
      *
      * @return int
      */
     private function getIdInArray($array, $term)
     {
         foreach ($array as $key => $value) {
             if ($value == $term) {
                 return $key;
             }
         }
		throw new UnexpectedValueException;
     }
 
    
}
