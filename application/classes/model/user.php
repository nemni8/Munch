<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User
{
	protected $_has_many = array(
		'restaurants' => array('model' => 'restaurant','far_key'=>'id'),
		'user_tokens' => array('model' => 'user_token','far_key'=>'id'),
		'roles'       => array('model' => 'role', 'through' => 'roles_users'),
	);
    public function get_col()
	{
		return
				array(
						'username'   => array('col_name' => 'username','title' => 'User Name', 'type' => 'text'),
						'email'      => array('col_name' => 'email','title' => 'User Email', 'type' => 'text'),
						'password'   => array('col_name' => 'password','title' => 'User Password', 'type' => 'password'),
						'password_confirm'   => array('col_name' => 'password_confirm','title' => 'Repeat Password', 'type' => 'password'),
				 )
		;
	}
    	public function get_headers()
	{
		return
				array(
						'username'   => array('col_name' => 'username','title' => 'User Name', 'type' => 'text'),
						'email'      => array('col_name' => 'email','title' => 'User Email', 'type' => 'text'),

				 )
		;
	}
	public function get_all_users()
	{
		return DB::select()->from('users')->as_object()->execute();
	}

} // End User Model