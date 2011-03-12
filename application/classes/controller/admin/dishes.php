<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Dishes extends Controller_Template_Admin
{

	public function action_add($id = NULL)
	{

		//POST
		if ( ! empty($_POST))
		{
			// set ingredient to be new or old
			if ( ! empty($id))
			{
				$dish = ORM::factory('dish',$id);
				// check if the current user have access to change user details
				if(!$this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$dish->edit($_POST);
			}
			else
			{
				$dish = ORM::factory('dish');
				$dish->add_new($_POST);
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
				$dish = ORM::factory('dish', $id);
				// check if the current user have access to change user details
				if(  ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$this->template->content = View::factory('admin/dishes/add&edit')
										   ->set('dish',$dish)
                                           ->set('id',$id)
                                           ->set('type','edit')
										   ->set('price',$dish->price)
                                           ->set('description',$dish->description)
                                           ->set('arr_input',$dish->get_col());
			}
			// if rest not exist
			else
			{
				if(  ! $this->_checkAdmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$dish = ORM::factory('dish');
				$this->template->content = View::factory('admin/dishes/add&edit')
                                           ->set('type','add')
                                           
                                           ->set('dish',$dish)
                                           ->set('arr_input',$dish->get_col());
			}
		}
	}
    public function action_delete($id)
	{
		$dish = ORM::factory('dish',$id);
        $dish->remove('ingredients');
		$dish->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}
    
}

