<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Template_Admin
{
	public function action_add(){

            if( ! $this->_checkSupadmin())
            {
                echo 'you can not access to this page';
                die();
            }
            $flag_admin = FALSE;
            $flag_supadmin = FALSE;
            $user = ORM::factory('user');
            $this->template->content = View::factory('admin/users/add&edit')
                    ->set('type','add')
                    ->set('is_admin',$this->_checkSupadmin())
                    ->set('flag_supadmin',$flag_supadmin)
                    ->set('flag_admin',$flag_admin)
                    ->set('arr_input',$user->get_col());

        }
        public function action_edit($id)
        {
            $flag_admin = FALSE;
            $flag_supadmin = FALSE;
            $user = ORM::factory('user',$id);
            $type = 'edit';
            // check if the current user have access to change restaurant details
            if( ($user->id !== $this->_user->id) AND ! $this->_checkSupadmin())
            {
                echo 'you can not access to this page';
                die();
            }
            $user_roles = DB::select()->from('roles_users')->where('user_id','=',$id)->execute()->as_array();
            // set the flags to the right value
            foreach($user_roles as $role)
                {
                if ($role['role_id'] == 2)
                    $flag_admin = TRUE;
                if ($role['role_id'] == 3)
                    $flag_supadmin = TRUE;
                }
            $this->template->content = View::factory('admin/users/add&edit')
                   ->set('user', $user)
                   ->set('type',$type)
                   ->set('id',$id)
                   ->set('is_admin',$this->_checkSupadmin())
                   ->set('flag_supadmin',$flag_supadmin)
                   ->set('flag_admin',$flag_admin)
                   ->set('arr_input',$user->get_col());

        }
        public function action_create($id = NULL)
        {
            $flag_admin = FALSE;
            $flag_supadmin = FALSE;
            $user_roles = DB::select()->from('roles_users')->where('user_id','=',$id)->execute()->as_array();
            // set the flags to the right value
            foreach($user_roles as $role)
                {
                if ($role['role_id'] == 2)
                    $flag_admin = TRUE;
                if ($role['role_id'] == 3)
                    $flag_supadmin = TRUE;
                }
            $user = ORM::factory('user',$id);
            $type = (isset($id)) ? 'edit' : 'add';
            $this->template->content = View::factory('admin/users/add&edit')
                ->set('post', $_POST)
                ->set('is_admin',$this->_checkSupadmin())
                ->set('user', $user)
                ->set('type',$type)
                ->set('id',$id)
                ->set('flag_supadmin',$flag_supadmin)
                ->set('flag_admin',$flag_admin)
                ->set('arr_input',$user->get_col())
                ->bind('errors', $errors);

            if ($_POST)
            {


                //$temp= ($_POST['password']=='') ? $user->password : $_POST['password'] ;
                //$user->values($_POST);
                //$user->password=$temp;
               /* $user->email = $_POST['email'];
                $user->username = $_POST['username'];
                if( ! empty($_POST['password']))
                    $user->password = $_POST['password'];*/


                try
                {
                    if ($type=='add')
                        $user->create_user($_POST,array('username','password',	'email', )   );
                    else
                        $user->update_user($_POST);


                    //$user->save();
                                // add role if not exist
                    if (isset($_POST['user_role_admin']) AND ! $flag_admin)
                        $user->add('roles', ORM::factory('role', array('name' => 'admin')));
                    if (isset($_POST['user_role_supadmin']) AND ! $flag_supadmin)
                        $user->add('roles', ORM::factory('role', array('name' => 'supadmin')));
                    // delete role if needed
                    if  ($this->_checkSupadmin()) {
                    if ( ! isset($_POST['user_role_admin']) AND $flag_admin)
                        DB::delete('roles_users')
                            ->where('user_id', '=', $user->id)
                            ->where('role_id', '=', 2)
                            ->execute();
                    if ( ! isset($_POST['user_role_supadmin']) AND $flag_supadmin)
                        DB::delete('roles_users')
                            ->where('user_id', '=', $user->id)
                            ->where('role_id', '=', 3)
                            ->execute();
                    }
                    die();
                }
                catch (ORM_Validation_Exception $e)
                {
                    $errors = $e->errors('models');
                }

            }
            $this->_ajax = TRUE;
        }
}
/*
{

	public function action_add($id = NULL)
	{
		//POST
		if ( ! empty($_POST))
		{
			// set user to be new or old
			if ( ! empty($id))
			{
				$user = ORM::factory('user',$id);
				// check if the current user have access to change user details
				if( ($user->id !== $this->_user->id) AND ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$user->edit($_POST,$this->_checkSupadmin());
			}
			else
			{
				$user = ORM::factory('user');
				$user->add_new($_POST);
			}
			// if user is new then add to table if old then update

			$this->request->redirect(Route::get('admin')->uri());

		}
		// NOT POST
		else
		{
			// flag for the role check boxes
			$flag_admin = FALSE;
			$flag_supadmin = FALSE;
			// IF user exist AND current user is trying to edit his profile THEN read all filed
			if ( ! empty($id))
				{
				$user = ORM::factory('user', $id);
					$type = 'edit';
				// check if the current user have access to change user details
				if( ($user->id !== $this->_user->id) AND ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$user_roles = DB::select()->from('roles_users')->where('user_id','=',$id)->execute()->as_array();
				// set the flags to the right value
				foreach($user_roles as $role)
				{
					if ($role['role_id'] == 2)
						$flag_admin = TRUE;
					if ($role['role_id'] == 3)
						$flag_supadmin = TRUE;
				}
				$this->template->content = View::factory('admin/users/add&edit')
										   ->set('user', $user)
										   ->set('type',$type)
										   ->set('id',$id)
										   ->set('is_admin',$this->_checkSupadmin())
										   ->set('flag_supadmin',$flag_supadmin)
										   ->set('flag_admin',$flag_admin)
										   ->set('arr_input',$user->get_col());
			}
			// if rest not exist
			else
			{
                if( ( ! $this->_checkSupadmin())) 
				    {
					    echo 'you can not access to this page';
					    die();
                    }
			    $user = ORM::factory('user');
				$this->template->content = View::factory('admin/users/add&edit')
				->set('type','add')
				->set('is_admin',$this->_checkSupadmin())
				->set('flag_supadmin',$flag_supadmin)
			   ->set('flag_admin',$flag_admin)
				->set('arr_input',$user->get_col());
			}
		}
	}
}*/
