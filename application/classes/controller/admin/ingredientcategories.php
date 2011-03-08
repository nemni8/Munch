<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ingredientcategories extends Controller_Template_Admin
{
	
	public function action_add($id = NULL)
	{

		if ( ! empty($_POST))
		{
			// set ingredient to be new or old
			if ( ! empty($id))
			{
				$ingredientcategory = ORM::factory('ingredientcategory',$id);
				// check if the current user have access to change user details
				if(!$this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$ingredientcategory->edit($_POST);
			}
			else
			{
				$ingredientcategory = ORM::factory('ingredientcategory');
				$ingredientcategory->add_new($_POST);
			}
			// if user is new then add to table if old then update

			$this->request->redirect(Route::get('admin')->uri());

		}
		// NOT POST
		else
		{

			if ( ! empty($id))
				{
				$ingredientcategory = ORM::factory('ingredientcategory', $id);
                //$user = ORM::factory('user',$_SESSION['auth_user_munch']->id);
				$type = 'edit';
				// check if the current user have access to change user details
				if(  ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}


				$this->template->content = View::factory('admin/ingredientcategories/add&edit')
										   ->set('ingredientcategory',$ingredientcategory)
                                           ->set('type',$type)
                                           ->set('id',$id)

										   ->set('arr_input',$ingredientcategory->get_col());
			}
			// if rest not exist
			else
			{
                	if(  ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$ingredientcategory = ORM::factory('ingredientcategory');
				$this->template->content = View::factory('admin/ingredientcategories/add&edit')
				->set('type','add')
                 ->set('ingredient_category',$ingredientcategory)
                
                ->set('arr_input',$ingredientcategory->get_col());
			}
		}
	}
}
