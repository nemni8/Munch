<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Site_Main extends Controller_Template_Site {

	public function action_index()
	{
        $kosher_options = Kohana::config ('global.kosher_level');
		$payment_method = Kohana::config ('global.payment_method');
        $categories= Kohana_ORM::factory('category')->where('model','=','restaurant')->find_all();
        $this->template->content = View::factory('site/main_index')
                ->set('kosher_options',$kosher_options)
				->set('payment_method',$payment_method)
                ->set('categories', $categories)
                //->set('is_admin', (bool)$this->_admin);
;
	}
    public function action_dishes()
	{
        $categories= Kohana_ORM::factory('category')->where('model','=','dishes')->find_all();
        $this->template->content = View::factory('site/dishesfilter')
                ->set('categories', $categories)
                //->set('is_admin', (bool)$this->_admin);
;
	}
	public function action_dishorder($dish_id)
	{
		$dish = orm::factory('dish',$dish_id);
		$this->template->content = View::factory('admin/dishes/order_dish')
                ->set('dish', $dish);
		//echo debug::vars($dish->groups->subs);
	}

} // End Welcome
