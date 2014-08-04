<?php namespace Dasigr\Core\Entities;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends \Eloquent implements UserInterface, RemindableInterface {
    
    use UserTrait;
    use RemindableTrait;
    use SoftDeletingTrait;
    
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table;
    
    /**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
    
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('username', 'email', 'password');
    
    /**
     * Field validation rules.
     * 
     * @var array
     */
    static $rules = array(
        'username' => 'required|unique:users,username',
        'email' => 'required|unique:users,email',
        'password' => 'required'
    );
}
