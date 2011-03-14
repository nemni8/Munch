<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Restaurants extends Controller_Template_Admin
{
	public function action_add(){
		$admins = DB::select('users.id','username')
			->from('users')
			->join('roles_users')
			->on('users.id','=','roles_users.user_id')
			->where('role_id','=',2)
			->execute()->as_array('id','username');
		if( ! $this->_checkSupadmin())
		{
			echo 'you can not access to this page';
			die();
		}
		$rest = ORM::factory('restaurant');
		$this->template->content = View::factory('admin/restaurants/add&edit')
			->set('type','add')
			->set('admins', $admins)
			->set('active',$rest->active)
			->set('is_admin',$this->_checkSupadmin())
			->set('arr_input',$rest->get_col());

	}
	public function action_edit($id)
	{
		$admins = DB::select('users.id','username')
			->from('users')
			->join('roles_users')
			->on('users.id','=','roles_users.user_id')
			->where('role_id','=',2)
			->execute()->as_array('id','username');
		$rest = ORM::factory('restaurant', $id);
		$type = 'edit';
		// check if the current user have access to change restaurant details
		if( ($rest->user_id !== $this->_user->id) AND ! $this->_checkSupadmin())
		{
			echo 'you can not access to this page';
			die();
		}			
		$this->template->content = View::factory('admin/restaurants/add&edit')
			->set('rest', $rest)
			->set('type',$type)
			->set('active',$rest->active)
			->set('id',$id)
			->set('admins', $admins)
			->set('is_admin',$this->_checkSupadmin())
			->set('arr_input',$rest->get_col());
	}
	public function action_create($id = NULL)
	{
		$rest = ORM::factory('restaurant',$id);
		$admins = DB::select('users.id','username')
			->from('users')
			->join('roles_users')
			->on('users.id','=','roles_users.user_id')
			->where('role_id','=',2)
			->execute()->as_array('id','username');
		$type = (isset($id)) ? 'edit' : 'add';
		$this->template->content = View::factory('admin/restaurants/add&edit')
			->set('post', $_POST)
			->set('is_admin',$this->_checkSupadmin())
			->set('type', $type)
			->set('id',$id)
			->set('rest', $rest)
			->set('active',$rest->active)
			->set('admins', $admins)
			->set('arr_input',$rest->get_col())
			->bind('errors', $errors);

		if ($_POST)
		{

            $rest->values($_POST);

			try
			{

				$rest->save();
                if(isset($_POST['category_id']))
                {
                    $rest->remove('categories');
                    foreach($_POST['category_id'] as $cat)
                    {
                            $rest->add('categories',$cat);
                    }
                }

				die();
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('models');
			}
		}
		$this->_ajax = TRUE;

		//$this->response->body($this->template->content);
	}
/*
	public function action_add($id = NULL)
	{
		
		//POST
		if ( ! empty($_POST))
		{
			// set rest to be new or old
			if ( ! empty($id))
			{
				$rest = ORM::factory('restaurant',$id);
				// check if the current user have access to change restaurant details
				if( ($rest->user_id !== $this->_user->id) AND ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
			}
			else
			{
				$rest = ORM::factory('restaurant');
			}
			// if rest is new then add to table if old then update

			$rest->add_new($_POST);
			$this->request->redirect(Route::get('admin')->uri());
		}
		// NOT POST
		else
		{
			$admins = DB::select('users.id','username')
						  ->from('users')
						  ->join('roles_users')
				 		  ->on('users.id','=','roles_users.user_id')
						  ->where('role_id','=',2)
						  ->execute()->as_array('id','username');
			// IF rest exist AND current user is trying to edit his profile THEN read all filed
			if ( ! empty($id))
			{
				$rest = ORM::factory('restaurant', $id);
					$type = 'edit';
				// check if the current user have access to change restaurant details
				if( ($rest->user_id !== $this->_user->id) AND ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
					
				$this->template->content = View::factory('admin/restaurants/add&edit')
										   ->set('rest', $rest)
										   ->set('type',$type)
                                           ->set('active',$rest->active)
										   ->set('id',$id)
										   ->set('admins', $admins)
										   ->set('is_admin',$this->_checkSupadmin())
										   ->set('arr_input',$rest->get_col());

			}
			// if rest not exist
			else
			{
				if( ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
                $rest = ORM::factory('restaurant');
				$this->template->content = View::factory('admin/restaurants/add&edit')
				->set('type','add')
				->set('admins', $admins)
                ->set('active',$rest->active)
				->set('is_admin',$this->_checkSupadmin())
				->set('arr_input',$rest->get_col());
			}
		}

	}
/*
public function action_add($id = NULL)
{
    $view = View::factory('admin/restaurants/add&edit')
        ->set('post', $_POST)
        ->bind('errors', $errors);

    if ($_POST)
    {
		$rest = ORM::factory('restaurant',$id);
		// check if the current user have access to change restaurant details
		if( ($rest->user_id !== $this->_user->id) AND ! $this->_checkSupadmin())
		{
			echo 'you can not access to this page';
			die();
		}
		else
		{
			$rest = ORM::factory('restaurant');
		}
		$rest->values($_POST);
        try
        {
            $rest->save();
            // Redirect the user to his page
            $this->request->redirect(Route::get('admin')->uri());
        }
        catch (ORM_Validation_Exception $e)
        {
            $errors = $e->errors('models');
        }
		$this->response->body($view);
    }
	else
	{
		echo 'ddd';
		$admins = DB::select('users.id','username')
						  ->from('users')
						  ->join('roles_users')
				 		  ->on('users.id','=','roles_users.user_id')
						  ->where('role_id','=',2)
						  ->execute()->as_array('id','username');
		if ( ! empty($id))
		{
			$rest = ORM::factory('restaurant', $id);
			$type = 'edit';
			// check if the current user have access to change restaurant details
			if( ($rest->user_id !== $this->_user->id) AND ! $this->_checkSupadmin())
			{
				echo 'you can not access to this page';
				die();
			}
		}
		else
		{
			if( ! $this->_checkSupadmin())
			{
				echo 'you can not access to this page';
				die();
			}
			$type = 'add';

		}
		$view
			->set('type',$type)
			->set('admins', $admins)
			->set('active',$rest->active)
			->set('is_admin',$this->_checkSupadmin())
			->set('arr_input',$rest->get_col());;
	}
}

 */

/*	public function action_show($id)
	{
		$rest = ORM::factory('restaurant', $id);
		$this->template->content = View::factory('admin/restaurants/item')
			->set('rest', $rest)
			->set('rest_arr', $rest->as_array())
			->set('items', ORM::factory('restaurant')
				->find_all()->as_array());
	}
*/

} // End Welcome
