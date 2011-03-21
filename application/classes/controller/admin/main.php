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
			$dish = ORM::factory('dish');

            $all_ingredient_categories = $category->get_all_categories('ingredient');
			$all_restaurant_categories = $category->get_all_categories('restaurant');
            $all_dish_categories = $category->get_all_categories('dish');

			if (empty($this->_supadmin))
			{
				$user_rest = $rest->get_user_restaurants($this->_user->id);
				$all_ingredients = $ingredient->get_all_ingredients_visible_for_user($this->_user->id);
                $all_users = array();
				$all_dish = array();

            
			}
			else
			{
				$user_rest = $rest->get_all_restaurants();
				$all_users = $user->get_all_users();
                $all_ingredients = $ingredient->get_all_ingredients();
				$all_dish = $dish->get_all_dishes();
			}
			$this->template->content = View::factory('admin/dashboard')
									   ->set('username',$this->_user->username)
                                       ->set('user_rest',$user_rest)
									   ->set('all_users',$all_users)
									   ->set('all_dishes',$all_dish)
                                       ->set('all_ingredients',$all_ingredients)
                                       ->set('all_ingredient_categories',$all_ingredient_categories)
									   ->set('all_restaurant_categories',$all_restaurant_categories)
                                       ->set('all_dish_categories',$all_dish_categories)
									   ->set('is_supadmin', (bool)$this->_supadmin)
                                       ->set('is_admin', (bool)$this->_admin);
		}
		// if not logged in THEN show login page
		else
		{
			$this->template->content = View::factory('admin/login')
									   ->bind('post', $_POST)
									   ->bind('errors', $errors);
		}
		
	}
    public function action_table($table)
	{
		// check if user is logged in the system
		if ( ! empty($this->_user->id))
		{

            $function_name='';
            $item = ORM::factory($table);
			switch ($table) {
                case ("restaurant"):
                    $function_name='get_all_restaurants';
                    break;
                case ("ingredient"):
                    $function_name='get_all_ingredients';
                    break;
                case ("dish"):
                    $function_name='get_all_dishes';
                    break;
                case ("category"):
                    $function_name='get_all_categories';
                    break;
            }

            $all_items = $item->$function_name($table);


			/*if (empty($this->_supadmin))
			{
				$user_rest = $rest->get_user_restaurants($this->_user->id);
				$all_ingredients = $ingredient->get_all_ingredients_visible_for_user($this->_user->id);
                $all_users = array();


			}
			else
			{
				$user_rest = $rest->get_all_restaurants();
				$all_users = $user->get_all_users();
                $all_ingredients = $ingredient->get_all_ingredients();
			}*/
			$this->template->content = View::factory('admin/table')
									   ->set('id',$table)
                                       ->set('all_items',$all_items)
                                       ->set('function_name',$function_name)
                                       ->set('arr_input',$item->get_col());
									   //->set('is_supadmin', (bool)$this->_supadmin)
                                       //->set('is_admin', (bool)$this->_admin);
		}
		// if not logged in THEN show login page


	}


} // End Welcome
