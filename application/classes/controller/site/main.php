<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Site_Main extends Controller_Template_Site {

	public function action_index()
	{
        //echo debug::vars($_SESSION);
        $kosher_options= Kohana::config ('global.kosher_level');
        $categories= Kohana_ORM::factory('category')->where('model','=','restaurant')->find_all();
        $this->template->content = View::factory('site/main')
                ->set('kosher_options',$kosher_options)
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
