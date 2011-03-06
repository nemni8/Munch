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
			$this->template->content = View::factory('admin/dashbord')
									   ->set('user_rest',$user_rest)
									   ->set('all_users',$all_users)
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
