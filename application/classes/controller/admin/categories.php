<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Categories extends Controller_Template_Admin
{
	public function action_add(){

		if( ! $this->_checkAdmin())
		{
			echo 'you can not access to this page';
			die();
		}
        $admin_level = ($this->_checkSupadmin()) ? 1 : 0 ;
        $category = ORM::factory('category');
        $this->template->content = View::factory('admin/categories/add&edit')
            ->set('type','add')
            ->set('admin_level',$admin_level)
            ->set('category',$category)
            ->set('arr_input',$category->get_col());
	}

	public function action_edit($id)
	{
	
		$category = ORM::factory('category', $id);
				$type = 'edit';
		// check if the current user have access 
		if(!( ($this->_checkSupadmin()) || ($category->user_id==$_SESSION['auth_user_munch']->id)))
            {
                echo 'you can not access to this page';
                die();
            }
            $admin_level = ($this->_checkSupadmin()) ? 1 : 0 ;
		$this->template->content = View::factory('admin/categories/add&edit')
            ->set('category',$category)
            ->set('type',$type)
            ->set('id',$id)
            ->set('admin_level',$admin_level)
            ->set('arr_input',$category->get_col());
	}
	public function action_create($id = NULL)
	{
		$admin_level = ($this->_checkSupadmin()) ? 1 : 0 ;
        $category = ORM::factory('category', $id);
		$type = (isset($id)) ? 'edit' : 'add';
		$this->template->content = View::factory('admin/categories/add&edit')
            ->set('post', $_POST)
            ->set('id',$id)
            ->set('category',$category)
            ->set('admin_level',$admin_level)
            ->set('type',$type)
            ->set('arr_input',$category->get_col())
			->bind('errors', $errors);

		if ($_POST)
		{

            $category->values($_POST);
            $category->user_id = (!$admin_level) ? $_SESSION['auth_user_munch']->id  : 0 ;
            $category->approval_level=$admin_level;


			try
			{

				$category->save();
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
		$category = ORM::factory('category',$id);
        if (! (($category->user_id==$_SESSION['auth_user_munch']->id) || ($this->_checkSupadmin())))
		{
			echo 'you can not access to this page';
			die();
		}
		$category->remove('ingredients');
		$category->remove('restaurants');
        $category->remove('dishes');
		$category->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}
}

