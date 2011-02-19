<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Main extends Controller_Template_Admin
{
	public function action_index()
	{
		$this->response->body('hello, world!');
	}

} // End Welcome
