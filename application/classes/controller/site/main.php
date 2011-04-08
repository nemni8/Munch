<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Site_Main extends Controller_Template_Site {

	public function action_index()
	{
		echo $this->response->body('hello, world!');
	}
	public function action_dishorder($dish_id)
	{
		$dish = orm::factory('dish',$dish_id);
		$this->template->content = View::factory('admin/dishes/order_dish')
                ->set('dish', $dish);
		//echo debug::vars($dish->groups->subs);
	}

} // End Welcome
