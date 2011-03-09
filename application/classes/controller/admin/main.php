<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Main extends Controller_Template_Admin
{
	public function action_index()
	{
		// check if user is logged in the system
		if ( ! empty($this->_user->id))
		{
			$rest = ORM::factory('restaurant');
			$user = ORM::factory('user');
            $ingredient = ORM::factory('ingredient');
            $category = ORM::factory('category');
            $all_ingredients = $ingredient->get_all_ingredients();
            $all_ingredient_categories = $category->get_all_categories('ingredient');
			$all_restaurant_categories = $category->get_all_categories('restaurant');

			if (empty($this->_supadmin))
			{
				$user_rest = $rest->get_user_restaurants($this->_user->id);
				$all_users = array();

            
			}
			else
			{
				$user_rest = $rest->get_all_restaurants();
				$all_users = $user->get_all_users();
			}
			$this->template->content = View::factory('admin/dashboard')
									   ->set('user_rest',$user_rest)
									   ->set('all_users',$all_users)
                                       ->set('all_ingredients',$all_ingredients)
                                       ->set('all_ingredient_categories',$all_ingredient_categories)
										->set('all_restaurant_categories',$all_restaurant_categories)
									   ->set('is_supadmin', (bool)$this->_supadmin);
		}
		// if not logged in THEN show login page
		else
		{
			$this->template->content = View::factory('admin/login')
									   ->bind('post', $_POST)
									   ->bind('errors', $errors);
		}
		
	}

} // End Welcome
