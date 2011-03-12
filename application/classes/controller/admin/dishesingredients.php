<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Dishesingredients extends Controller_Template_Admin
{
	
	public function action_add($id = NULL)
	{

		//POST
		if ( ! empty($_POST))
		{
			// set dishesingredient to be new or old
			if ( ! empty($id))
			{
				$dishesingredient = ORM::factory('dishesingredient',$id);
				// check if the current user have access to change user details
				if(!$this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$dishesingredient->edit(1,3,1);
			}
			else
			{
				$dishesingredient = ORM::factory('dishesingredient');
				$dishesingredient->add_new(1,3,1);
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
				$dishesingredient = ORM::factory('dishesingredient', $id);
				// check if the current user have access to change user details
				if(  ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$this->template->content = View::factory('admin/dishesingredients/add&edit')
										   ->set('dishesingredient',$dishesingredient)
                                           ->set('type','edit')

                                           ->set('id',$id);

			}
			// if rest not exist
			else
			{
				if(  ! $this->_checkAdmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$dishesingredient = ORM::factory('dishesingredient');
				$this->template->content = View::factory('admin/dishesingredients/add&edit')
										   ->set('type','add')
										   
										   ->set('dishesingredient',$dishesingredient);

			}
		}
	}
    public function action_delete($id)
	{
		$dishesingredient = ORM::factory('dishesingredient',$id);
		$dishesingredient->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}
}
