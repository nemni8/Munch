<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Restaurants extends Controller_Template_Admin
{
	public function action_add()
	{
		$post = array(
			'name' => 'My Rest',
			'email' => 'rest@moo.com',
			'phone' => '43634634643'
		);

		$rest = ORM::factory('restaurant');
		$rest->add_new($post);
	}

	public function action_show($id)
	{
		$rest = ORM::factory('restaurant', $id);
		$this->template->content = View::factory('admin/restaurants/item')
			->set('rest', $rest)
			->set('rest_arr', $rest->as_array())
			->set('items', ORM::factory('restaurant')
				->find_all()->as_array());
	}

} // End Welcome
