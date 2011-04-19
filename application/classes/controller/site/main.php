<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Site_Main extends Controller_Template_Site {

	public function action_index()
	{
        $kosher_options = Kohana::config ('global.kosher_level');
		$payment_method = Kohana::config ('global.payment_method');
        $categories= Kohana_ORM::factory('category')->where('model','=','restaurant')->find_all()->as_array('id','name');
        $this->template->content = View::factory('site/main_index')
                ->set('kosher_options',$kosher_options)
				->set('payment_method',$payment_method)
                ->set('categories', $categories)
                //->set('is_admin', (bool)$this->_admin);

;
	}
    public function action_dishes($rest_id)
	{
        $categories= DB::select('categories.name', 'categories.id')->from('categories')
				->join('categories_dishes','LEFT')
				->on('categories_dishes.category_id', '=', 'categories.id')
				->join('dishes','LEFT')
				->on('categories_dishes.dish_id', '=', 'dishes.id')
					->where('model','=','dish')
					->and_where_open()
						->or_where('categories.name', 'LIKE', '%All%')
						->or_where('dishes.restaurant_id','=',$rest_id)
					->and_where_close()
				->execute();

        $this->template->content = View::factory('site/dishesfilter')
                ->set('categories', $categories)
				->set('rest_id',$rest_id);
                //->set('is_admin', (bool)$this->_admin);
;
	}
    public function action_dishorder($dish_id,$orderdish_id= NULL)
        {
            $type = ($orderdish_id== NULL) ? 'add' : 'edit' ;
            $dish = orm::factory('dish',$dish_id);
            $ordersdish=orm::factory('ordersdish',$orderdish_id);
            $this->template->content = View::factory('admin/dishes/order_dish')
                    ->set('type',$type)
                    ->set('ordersdish',$ordersdish)
                    ->set('dish', $dish);
        }
    public function action_dishordercreate($dish_id,$orderdish_id= NULL)
	{
		$type = ($orderdish_id== NULL) ? 'add' : 'edit' ;
        $dish = orm::factory('dish',$dish_id);
        if ( ( ! isset($_SESSION['order_id'])) OR   ($_SESSION['order_id']==NULL) ) {
                    $order=orm::factory('order');
                    $order->save();
                    $_SESSION['order_id']=$order->id;
        }
        else
        {
            $order=orm::factory('order',$_SESSION['order_id']);
        }

        $ordersdish=orm::factory('ordersdish',$orderdish_id);
        $ordersdish->action_add($order->id,$dish_id);

		$this->template->content = View::factory('admin/dishes/order_dish')
                ->set('post', $_POST)
                ->set('order', $order)
                ->set('dish', $dish)
                ->set('ordersdish',$ordersdish)
                ->set('type',$type)
                ->bind('errors', $errors);

        if ($_POST) {
            try { //NEED TO HANDLE EDIT AS WELL
                if ($type=='edit') {
                $ordersdish->remove('ingredients');
                $ordersdish->remove('groupssubs');
                }
                //echo debug::vars($ordersdish);
                foreach ($_POST as $key => $value) {
                    if ($key=='ingredient') {
                        $ordersdishesingredient=orm::factory('ordersdishesingredient');
                        $ordersdishesingredient->action_add($ordersdish->id,$value);
                    }
                    else
                    {
                        if ($key!='order_submit') {
                            $str= str_replace('group_',"",$key);
                            $ordersdishesgroupssub=orm::factory('ordersdishesgroupssub');
                            $ordersdishesgroupssub->action_add($ordersdish->id,$str,$value);
                        }
                    }

                }
                $ordersdish->calculate_total();
                $order->calculate_total();
                //echo debug::vars($_POST);


                die();
            }
                catch (ORM_Validation_Exception $e)
                {
                    $errors = $e->errors('models');
                }

        }
        $this->_ajax = TRUE;


		//echo debug::vars($dish->groups->subs);
	}

} // End Welcome
