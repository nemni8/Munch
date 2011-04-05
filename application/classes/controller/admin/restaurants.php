<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Restaurants extends Controller_Template_Admin
{

    public function action_add(){
		$admins = DB::select('users.id','username')
			->from('users')
			->join('roles_users')
			->on('users.id','=','roles_users.user_id')
			->where('role_id','=',2)
			->execute()->as_array('id','username');
		if( ! $this->_checkSupadmin())
		{
			echo 'you can not access to this page';
			die();
		}
		$rest = ORM::factory('restaurant');
		$this->template->content = View::factory('admin/restaurants/add&edit')
			->set('type','add')
			->set('admins', $admins)
			->set('active',$rest->active)
			->set('is_admin',$this->_checkSupadmin())
			->set('arr_input',$rest->get_col());

	}
	public function action_edit($id)
	{
		$admins = DB::select('users.id','username')
			->from('users')
			->join('roles_users')
			->on('users.id','=','roles_users.user_id')
			->where('role_id','=',2)
			->execute()->as_array('id','username');
		$rest = ORM::factory('restaurant', $id);
		$type = 'edit';
		// check if the current user have access to change restaurant details
		if( ($rest->user_id !== $this->_user->id) AND ! $this->_checkSupadmin())
		{
			echo 'you can not access to this page';
			die();
		}			
		$this->template->content = View::factory('admin/restaurants/add&edit')
			->set('rest', $rest)
			->set('type',$type)
			->set('active',$rest->active)
			->set('id',$id)
			->set('admins', $admins)
			->set('is_admin',$this->_checkSupadmin())
			->set('arr_input',$rest->get_col());
	}

    public function action_create($id = NULL)
	{
		$rest = ORM::factory('restaurant',$id);
		$admins = DB::select('users.id','username')
			->from('users')
			->join('roles_users')
			->on('users.id','=','roles_users.user_id')
			->where('role_id','=',2)
			->execute()->as_array('id','username');
		$type = (isset($id)) ? 'edit' : 'add';
		$this->template->content = View::factory('admin/restaurants/add&edit')
			->set('post', $_POST)
			->set('is_admin',$this->_checkSupadmin())
			->set('type', $type)
			->set('id',$id)
			->set('rest', $rest)
			->set('active',$rest->active)
			->set('admins', $admins)
			->set('arr_input',$rest->get_col())
			->bind('errors', $errors);

		if ($_POST)
		{

            $rest->values($_POST);

			try
			{

				$rest->save();
                if(isset($_POST['category_id']))
                {
                    $rest->remove('categories');
                    foreach($_POST['category_id'] as $cat)
                    {
                            $rest->add('categories',$cat);
                    }
                }

				die();
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('models');
			}
		}
		$this->_ajax = TRUE;

		//$this->response->body($this->template->content);
	}
	public function action_delete($id)
	{
		$rest = ORM::factory('restaurant',$id);
			if (($rest->user_id == $_SESSION['auth_user_munch']->id) OR ($this->_checkSupadmin())) 
		  {
				$rest->remove('dishes');
		      $rest->delete();
            $this->request->redirect(Route::get('admin')->uri());
        }
        else
		  {
            echo "you don't have permission to delete this ingredient" ;
            die();
        }
	}
    function action_restaurant_search() {
        $result = DB::select()
                            ->from('restaurants')
                            ->where('active','=',1);



        //if (isset($_POST['rest_name'])) {     MAYBE KOBI WILL CREATE AUTOCOMPLETE!!!!
          //      $result->and_where('name','like','%'.$_POST['rest_name'].'%');
        //}
        if (isset($_POST['city_id'])) {
                $result->and_where('city_id','=',$_POST['city_id']);
        }
        if (isset($_POST['kitchen_type'])) {
                $temp= clone $result;
                $result= DB::select('rest.*','categories_restaurants.category_id')
                    ->from('categories_restaurants')->join(array($temp,'restaurants'),'INNER')
                    ->on('categories_restaurants.restaurant_id','=','restaurants.id')
                    ->where('categories_restaurants.category_id','=',($_POST['kitchen_type']));
        }
        if (isset($_POST['min_order'])) {
                $result->and_where('delivery_min','<=',$_POST['min_order']);
        }
        if (isset($_POST['delivery_cost'])) {
                $result->and_where('delivery_cost','<=',$_POST['delivery_cost']);
        }
        if (isset($_POST['delivery_time'])) {
                $result->and_where('delivery_time','<=',$_POST['delivery_time']);
        }
        if (isset($_POST['kosher_level'])) {
                $result->and_where('kosher_type','=',$_POST['city_id']);
        }
        $restaurants=$result->as_object()->execute();
        $this->template->content = View::factory('site/restaurants/search')
			->set('post', $_POST)
            ->set('arr_input',ORM::factory('restaurant')->get_headers())
			->set('restaurants', $restaurants)
            ->bind('errors', $errors);

        $this->_ajax = TRUE;

    }
    function dish_search($rest) {
    $dishes = DB::select()
			            ->from('dishes')
			            ->where('restaurant_id','=',$rest);
        // WE NEED TO WORK ON THE DISH QUERY!!!
    $this->template->content = View::factory('admin/restaurants/menu/search')
			->set('post', $_POST)
			->set('dishes', $dishes)
            ->bind('errors', $errors);

        if ($_POST)
        {
            //if (isset($_POST['rest_name'])) {     MAYBE KOBI WILL CREATE AUTOCOMPLETE!!!!
              //      $dishes->and_where('name','like','%'.$_POST['dish_name'].'%');
            //}
            if (isset($_POST['city_id'])) {
                    $dishes->and_where('city_id','=',$_POST['city_id']);
            }
            // NEED TO CHANGE THIS TO FIT THE MENU CATEGORIES
            /*if (isset($_POST['kitchen_type'])) {
                    $temp= clone $restaurants;
                    $dishes= DB::select('rest.*','categories_restaurants.category_id')
			            ->from('categories_restaurants')->join(array($temp,'restaurants'),'INNER')
                        ->on('categories_restaurants.restaurant.id','=','restaurants.id')
			            ->where('categories_restaurants.category_id','=',($_POST['kitchen_type']));
            } */
            if (isset($_POST['max_price'])) {
                    $dishes->and_where('price','<=',$_POST['max_price']);
            }
            if (isset($_POST['mdv'])) {
                    $dishes->and_where('mdv','<=',$_POST['mdv']);
            }
            $dishes->execute();

        }
        $this->_ajax = TRUE;

    }
} // End Welcome
