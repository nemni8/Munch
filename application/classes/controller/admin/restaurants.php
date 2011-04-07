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
            if (isset($_POST['city_name'])) {
            $city=orm::factory('city')->where('name','=',$_POST['city_name'])->find();
            $rest->city_id=$city->id;
            $street=orm::factory('street')->where('name','=',$_POST['street_name'])->and_where('city_id','=',$city->id)->find();
            $rest->street_id=$street->id;}
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
                $result= DB::select('restaurants.*','categories_restaurants.category_id')
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
        $result = DB::select()
			            ->from('dishes')
			            ->where('restaurant_id','=',$rest)->and_where('active','=',1);
        //if (isset($_POST['dish_name'])) {     MAYBE KOBI WILL CREATE AUTOCOMPLETE!!!!
          //      $result->and_where('name','like','%'.$_POST['dish_name'].'%');
        //}

        if (isset($_POST['max_price'])) {
                    $result->and_where('price','<=',$_POST['max_price']);
            }
        if (isset($_POST['mdv'])) {
                $result->and_where('mdv','<=',$_POST['mdv']);
        }
        if (isset($_POST['dish_category'])) {
                $temp= clone $result;
                $result= DB::select('dishes.*','categories_dishes.category_id')
                    ->from('categories_dishes')->join(array($temp,'dishes'),'INNER')
                    ->on('categories_dishes.dish_id','=','dishes.id')
                    ->where('categories_dishes.category_id','=',($_POST['dish_category']));
        }

        $dishes=$result->as_object()->execute();
        $this->template->content = View::factory('site/restaurants/dishes/search')
			->set('post', $_POST)
            ->set('arr_input',ORM::factory('dishes')->get_headers())
			->set('dishes', $dishes)
            ->bind('errors', $errors);

        $this->_ajax = TRUE;

    }
    	public function action_autocomplete($type,$city_name=NULL)
	{
        $term = '%'.$_GET['term'].'%';
		$return_arr = array();
        if ($type=='city') {
    		$query = DB::query(Database::SELECT,'SELECT cities.id,cities.name FROM cities WHERE cities.name LIKE :term');
        }
        else
        {
            $city=orm::factory('city')->where('name','=',$city_name)->find();
            $query = DB::query(Database::SELECT,'SELECT streets.name FROM streets WHERE streets.city_id ='.$city->id. ' AND streets.name LIKE :term');
        }
		$query->parameters(array(
			':term' => $term,
		));
		$return_arr = $query->execute()->as_array();
		$list = array();
		foreach($return_arr as $key=> $name)
		{
			$list[$key] = $name['name'] ;
		}
		echo json_encode($list) ;
	}
    

} // End Welcome
