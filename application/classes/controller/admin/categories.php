<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Categories extends Controller_Template_Admin
{
	
	public function action_add($id = NULL)
	{

		if ( ! empty($_POST))
		{
			// set category to be new or old
			if ( ! empty($id))
			{
				$category = ORM::factory('category',$id);
				// check if the current user have access to change category details
				if(!$this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$category->edit($_POST);
			}
			else
			{
				$category = ORM::factory('category');
				$category->add_new($_POST);
			}
			// if user is new then add to table if old then update

			$this->request->redirect(Route::get('admin')->uri());

		}
		// NOT POST
		else
		{

			if ( ! empty($id))
				{
				$category = ORM::factory('category', $id);
				$type = 'edit';
				// check if the current user have access to change category details
				if(  ! $this->_checkSupadmin())
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
			// if category not exist
			else
			{
				if(  ! $this->_checkSupadmin())
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
		}
	}

	public function action_delete($id)
	{
		$category = ORM::factory('category',$id);
		$category->remove('ingredients');
		$category->remove('restaurants');
		$category->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}

}
