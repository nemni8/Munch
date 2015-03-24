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
	public function action_delete($id)
	{
		$rest = ORM::factory('restaurant',$id);
			if (($rest->user_id == $_SESSION['auth_user_munch']->id) OR ($this->_checkSupadmin())) 
		  {
				$rest->remove('dishes');
		      $rest->delete();
            $this->request->redirect(Route::get('admin')->uri());
        }
        else
		  {
            echo "you don't have permission to delete this ingredient" ;
            die();
        }
	}

} // End Welcome
