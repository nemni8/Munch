<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ingredients_Dishes extends Controller_Template_Admin
{
	
	public function action_add($id = NULL)
	{
		$admin_level = ($this->_checkSupadmin()) ? 1 : 0 ;
		//POST
		if ( ! empty($_POST))
		{
			// set ingredient_dish to be new or old
			if ( ! empty($id))
			{
				$ingredient_dish = ORM::factory('ingredient_dish',$id);
				// check if the current user have access to change user details
				if(!$this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$ingredient_dish->edit($_POST,$admin_level);
			}
			else
			{
				$ingredient_dish = ORM::factory('ingredient_dish');
				$ingredient_dish->add_new($_POST,$admin_level);
			}
			// if user is new then add to table if old then update

			$this->request->redirect(Route::get('admin')->uri());

		}
		// NOT POST
		else
		{
			// IF user exist AND current user is trying to edit his profile THEN read all filed
			if ( ! empty($id))
				{
				$ingredient_dish = ORM::factory('ingredient_dish', $id);
				// check if the current user have access to change user details
				if(  ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$this->template->content = View::factory('admin/ingredients_dishes/add&edit')
										   ->set('ingredient_dish',$ingredient_dish)
                                           ->set('type','edit')
										   ->set('admin_level',$admin_level)
                                           ->set('id',$id)
										   ->set('arr_input',$ingredient_dish->get_col());
			}
			// if rest not exist
			else
			{
				if(  ! $this->_checkAdmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$ingredient_dish = ORM::factory('ingredient_dish');
				$this->template->content = View::factory('admin/ingredients_dishes/add&edit')
										   ->set('type','add')
										   ->set('admin_level',$admin_level)
										   ->set('ingredient_dish',$ingredient_dish)
										   ->set('arr_input',$ingredient_dish->get_col());
			}
		}
	}
    public function action_delete($id)
	{
		$ingredient_dish = ORM::factory('ingredient_dish',$id);
		$ingredient_dish->remove('categories');
        $ingredient_dish->remove('dishes');
		$ingredient_dish->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}
}
