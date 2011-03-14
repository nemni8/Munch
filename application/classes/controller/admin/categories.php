<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Categories extends Controller_Template_Admin
{
	public function action_add(){

		if( ! $this->_checkSupadmin())
		{
			echo 'you can not access to this page';
			die();
		}
        $category = ORM::factory('category');
        $this->template->content = View::factory('admin/categories/add&edit')
            ->set('type','add')
            ->set('category',$category)
            ->set('arr_input',$category->get_col());
	}

	public function action_edit($id)
	{
	
		$category = ORM::factory('category', $id);
				$type = 'edit';
		// check if the current user have access 
		if( ! $this->_checkSupadmin())
		{
			echo 'you can not access to this page';
			die();
		}
		$this->template->content = View::factory('admin/categories/add&edit')
            ->set('category',$category)
            ->set('type',$type)
            ->set('id',$id)
            ->set('arr_input',$category->get_col());
	}
	public function action_create($id = NULL)
	{
		$category = ORM::factory('category', $id);
		$type = (isset($id)) ? 'edit' : 'add';
		$this->template->content = View::factory('admin/categories/add&edit')
            ->set('post', $_POST)
            ->set('id',$id)
            ->set('category',$category)
            ->set('type',$type)
			->bind('errors', $errors);

		if ($_POST)
		{

            $category->values($_POST);

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
		$category->remove('ingredients');
		$category->remove('restaurants');
        $category->remove('dishes');
		$category->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}
}

