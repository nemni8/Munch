<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Site_Main extends Controller_Template_Site {

	public function action_index()
	{
		echo $this->response->body('hello, world!');
	}

} // End Welcome
