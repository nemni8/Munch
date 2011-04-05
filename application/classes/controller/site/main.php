<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Site_Main extends Controller_Template_Site {

	public function action_index()
	{
        $kosher_options= Kohana::config ('global.kosher_level');
        $categories= Kohana_ORM::factory('category')->where('model','=','restaurant')->find_all();
        $this->template->content = View::factory('site/main')
                ->set('kosher_options',$kosher_options)
                ->set('categories', $categories)
                //->set('is_admin', (bool)$this->_admin);
;
	}

} // End Welcome
