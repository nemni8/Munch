<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User
{

	protected $_has_many = array(
		'restaurants' => array(),
		'user_tokens' => array('model' => 'user_token'),
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
						'password'   => array('col_name' => 'password','title' => 'User Password', 'type' => 'text'),
				 )
		;
	}
	public function get_all_users()
	{
		return DB::select()->from('users')->as_object()->execute();
	}
/*	public function add_new($post)
	{
		$user = ORM::factory('user');
		$user->email = $post['email'];
		$user->username = $post['username'];
		if( ! empty($post['password']))
			$user->password = $post['password'];
		$user->save();
		$user->add('roles', ORM::factory('role', array('name' => 'login')));
		if (isset($post['user_role_admin']))
			$user->add('roles', ORM::factory('role', array('name' => 'admin')));
		if (isset($post['user_role_supadmin']))
			$user->add('roles', ORM::factory('role', array('name' => 'supadmin')));

	}
	public function edit($post,$issupadmin)
	{
		$flag_admin = FALSE;
		$flag_supadmin = FALSE;

		$this->email = $post['email'];
		$this->username = $post['username'];
		if( ! empty($post['password']))
			$this->password = $post['password'];
		$this->save();
		$user_roles = DB::select()->from('roles_users')->where('user_id','=',$this->id)->execute()->as_array();
		foreach($user_roles as $role)
		{
			if ($role['role_id'] == 2)
				$flag_admin = TRUE;
			if ($role['role_id'] == 3)
				$flag_supadmin = TRUE;
		}

		// add role if not exist
		if (isset($post['user_role_admin']) AND ! $flag_admin)
			$this->add('roles', ORM::factory('role', array('name' => 'admin')));
		if (isset($post['user_role_supadmin']) AND ! $flag_supadmin)
			$this->add('roles', ORM::factory('role', array('name' => 'supadmin')));
		// delete role if needed
		if  ($issupadmin) {
        if ( ! isset($post['user_role_admin']) AND $flag_admin)
			DB::delete('roles_users')
				->where('user_id', '=', $this->id)
				->where('role_id', '=', 2)
				->execute();
		if ( ! isset($post['user_role_supadmin']) AND $flag_supadmin)
			DB::delete('roles_users')
				->where('user_id', '=', $this->id)
				->where('role_id', '=', 3)
				->execute();
        }

	}*/
} // End User Model