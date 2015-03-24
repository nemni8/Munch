<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Template_Admin extends Controller_Template
{
	protected $_ajax = FALSE;
	protected $_languages = array();
	protected $_user = false;
	protected $_admin = false;
    protected $_supadmin = false;
    protected $_errors = array();

	public $template = 'admin/template';

	/**
	 * Override Kohana Controller before()
	 *
	 */
	protected function _checkAdmin()
	{
		if($this->_user)
		{
			$user_roles = DB::select()
						  ->from('roles_users')
						  ->where('user_id','=',$this->_user->id)
						  ->as_object()
						  ->execute();
			$flag = FALSE;
			foreach ($user_roles as $role)
			{
				if ($role->role_id == 2)
					$flag = TRUE;
			}
			return $flag;
		}
		else
		{
			return false;
		}
	}
	protected function _checkSupadmin()
	{
		if($this->_user)
		{
			$user_roles = DB::select()
						  ->from('roles_users')
						  ->where('user_id','=',$this->_user->id)
						  ->as_object()
						  ->execute();
			$flag = FALSE;
			foreach ($user_roles as $role)
			{
				if ($role->role_id == 3)
					$flag = TRUE;
			}
			return $flag;
		}
		else
		{
			return false;
		}
	}

	public function before()
	{
		// Open remote URLs in a new window
		html::$windowed_urls = TRUE;

		/**
		 	* Adding admin users
			$user = ORM::factory('user');
			$user->email = 'omryoz@gmail.com';
			$user->username = 'omryo';
			$user->password = 'test123';
			$user->save();
			// dont forget to add roles. 'login' role needs for successful login
			//$user->add('roles', ORM::factory('role', array('name' => 'admin')));
			$user->add('roles', ORM::factory('role', array('name' => 'login')));
		*/
		parent::before();

		$this->template->scripts = array();
		$this->template->styles = array();
		$this->template->title =
		$this->template->content = '';

		$auth = Auth::instance();

		// set user
		$this->_user = $auth->get_user();
		$this->_admin = $this->_checkAdmin();
		$this->_supadmin = $this->_checkSupadmin();
		//echo $this->_user;

		// handle ajax
		if ($this->request->is_ajax())
		{
			// ajax like call detected, don't render whole template!
			$this->_ajax = TRUE;
		}
		else
		{
			// initiates the template dynamic content (header, nav, panel, footer, ...)
			$this->init();
		}
	}

	/**
	 * Override Kohana Controller after()
	 *
	 */
	public function after()
	{
		if ($this->request->action() !== 'error' && $this->_ajax === TRUE)
		{
			// Use the template content as the response
			$this->response->body($this->template->content);
		}
		else
		{
			// render if auto_render is still set to true
			if ($this->auto_render === TRUE)
			{
				$this->response->body($this->template->render());
			}
			parent::after();
		}
	}

	/**
	 * Initiates the template dynamic content (header, nav, panel, footer, languages, ...)
	 *
	 */
	public function init()
	{
		$this->template->header =
		$this->template->nav =
		$this->template->panel =
		$this->template->footer =
		$this->template->content = '';

		// setting up template
		$menu = array();

		//header
		if($this->_user)
		{
			$this->template->header = View::factory('admin/header')
								  ->set('is_admin', (bool)$this->_admin)
								  ->set('is_supadmin', (bool)$this->_supadmin)
								  ->set('username',$this->_user->username);

		}
		else
		{
			$this->template->header = View::factory('admin/header');
		}

		// show logout only if admin
		if($this->_user)
		{
			if($this->_admin)
			{
				//$this->template->header->logout = View::factory('logout');
				//$this->template->header->logout->username = $this->_user->username;
			}
		}

		//footer
		$this->template->footer = View::factory('admin/footer');

		// panel with pages
		$this->template->panel = View::factory('admin/panel')
				->set('menu', $menu)
				->set('is_user', (bool)$this->_user)
				->set('is_admin', (bool)$this->_admin);

		//navigation
		/*
		$nav = View::factory('admin/nav')
				->set('is_user', (bool)$this->_user);

		$this->template->nav = $nav;
		 */

		$scripts = array(
			'media/js/jquery-1.5.1.min.js',
			'media/jquery-ui/js/jquery-ui-1.8.10.custom.min.js',
			'media/js/jquery.multiselect.min.js',
         'media/js/core.js',
			);

		if($this->_admin)
		{
			//$scripts = array_merge($scripts, array('media/js/admin.js'));
		}


		$this->template->scripts  = $scripts;
		$this->template->styles = array(
			'media/css/layout.css',
			'media/jquery-ui/css/cupertino/jquery-ui-1.8.10.custom.css',
			'media/css/jquery.multiselect.css'
			);

		$this->template->controller = Request::initial()->controller();
	}
	/**
	 * Triggered when bootstrap try and catch fails (404 Page not found)
	 *
	 */
	public function action_error()
	{
		// because this action is triggered from bootstrap.php when an errors occures trying to execure request,
		// we need to init the template before we continue to fill content view
		$this->init();
		$this->template->content = View::factory('errors/404');
	}

	public function action_login()
	{
		$this->template->scripts[] = 'media/js/login.js';

		// Set the login page
		$this->template->content = View::factory('admin/login')
			->bind('post', $_POST)
			->bind('errors', $errors);

		if ( ! empty($_POST))
		{
			// Sanitize user input
			$_POST['username'] = $_POST['username'];
			$_POST['password'] = $_POST['password'];
			$_POST['remember'] = (bool) (isset($_POST['remember']) ? $_POST['remember'] : FALSE);

			$auth = Auth::instance();
			// Try to login using username and check if the current user is admin 
			if ( ($auth->login($_POST['username'], $_POST['password'], $_POST['remember'])))
			{
				// get user role
				$user_roles = $auth->get_user()->roles->where('name', '!=', 'login')->find_all()->as_array('id', 'name');
				if (count($user_roles) == 0)
					$errors[] = "You are not authorized to enter to this section of the site";
				else
				{
					$_SESSION['user_roles'] = $user_roles;
					$this->request->redirect(Route::get('admin')->uri());
				}				
			}
			else
			{
				$errors[] = 'user name or password is incorrect';
			}
		}
	}

	public function action_logout()
	{
		$auth = Auth::instance();
		// Completely destroy session and tokens
		$auth->logout(TRUE, TRUE);
		$this->request->redirect(Route::get('admin')->uri());
	}
}