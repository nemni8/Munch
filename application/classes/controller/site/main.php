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
    public function action_dishorderedit($orderdish_id)
        {
            $type = 'edit' ;
            $dish_id =$_SESSION['cart_array'][$orderdish_id]['dish_id'];
            //echo debug::vars($dish_id);
            $dish = orm::factory('dish',$dish_id);
            //$ordersdish_id=orm::factory('ordersdish',$orderdish_id);
            $this->template->content = View::factory('admin/dishes/order_dish')
                    ->set('type',$type)
                    ->set('orderdish_id',$orderdish_id)
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

        //$ordersdish=orm::factory('ordersdish',$orderdish_id);
        //$ordersdish->action_add($order->id,$dish_id);

		$this->template->content = View::factory('admin/dishes/order_dish')
                ->set('post', $_POST)
                ->set('order', $order)
                ->set('dish', $dish)
                //->set('ordersdish',$ordersdish)
                ->set('type',$type)
                ->bind('errors', $errors);
        //session_start();
        if (!isset($_SESSION['cart_array'])) {
            $_SESSION['cart_array']=array();
        }
        if ($_POST) {
            try { //NEED TO HANDLE EDIT AS WELL
                $dishprice=$dish->price;
                if ($type=='edit') {
                //$ordersdish->remove('ingredients');
                //$ordersdish->remove('groupssubs');
                $orderdisharray=$_SESSION['cart_array'][$orderdish_id];
                }
                if ($type=='add') {
                    $orderdisharray=array();
                }
                //echo debug::vars($_POST);
                $ingredients=array();
                $subs=array();
                foreach ($_POST as $key => $value) {
                    $ingredient=array();
                    $sub=array();
                    $swit=NULL;
                    if (strstr($key,'ingredient')!=FALSE)
                        $swit='ingredient' ;
                    if (strstr($key,'group')!=FALSE)
                            $swit='group';
                     if (!$swit)
                            $swit=$key;
                    

                    //echo debug::vars($swit);
                    switch ($swit) {
                        case ("ingredient"):
                            //$ordersdishesingredient=orm::factory('ordersdishesingredient');
                            //$ordersdishesingredient->action_add($ordersdish->id,$value);
                            $temp=orm::factory('dishesingredient')->where('dish_id','=',$dish_id)->and_where('ingredient_id','=',$value)->find();
                            $ingredient=array('ingredient_id'=>$value,'price'=>$temp->price);
                            $dishprice+=$temp->price;
                            array_push($ingredients, $ingredient);
                            break;
                        case    ("order_submit"):
                            break;
                        case    ("group_optional_str"):
                            break;
                        case ("quantity"):
                            $quantity=$value;
                            //$ordersdish->quantity=$quantity;
                            break;
                        case("group"):
                            if (!strstr($key,'rule')) {
                                $str3= str_replace('group_',"",$key);
                                $str2=strstr( $str3, '_');
                                $str=str_replace($str2,"",$str3);
                                if ($str==0 ||$str=='basic' || $str=='optional' ) break;
                                //$ordersdishesgroupssub=orm::factory('ordersdishesgroupssub');
                                //$ordersdishesgroupssub->action_add($ordersdish->id,$str,$value);
                                $tempsub=orm::factory('sub')->where('group_id','=',$str)->and_where('sub_id','=',$value)->find();
                                $group_price=orm::factory('group',$str)->price;
                                $price= ($tempsub->price>0) ?$tempsub->price : $group_price ;
                                $sub=array('group_id'=>$str,'sub_id'=>$value,'price'=>$price);
                                $dishprice+=$price;
                                array_push($subs, $sub);
                            }
                            break;
                    }
                }
                //echo debug::vars($subs);
                $comments = (isset($_SESSION['comments'])) ? $_SESSION['comments'] : NULL;
                $orderdisharray=array('rest_id'=>'0','dish_id'=>$dish_id,'quantity'=>$quantity,'price'=>$dishprice,'ingredients'=>$ingredients,'subs'=>$subs,'comments'=>$comments);

                if ($type=='add') {
                    array_push($_SESSION['cart_array'], $orderdisharray);
                }
                else {
                    $_SESSION['cart_array'][$orderdish_id]=$orderdisharray;
                }

                //$ordersdish->calculate_total();
                //$order->calculate_total();
                //echo debug::vars($_SESSION['cart_array']);


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
