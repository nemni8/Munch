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
        $_SESSION['rest_id']=$rest_id;
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
;
	}
    public function action_dishorder($dish_id)//,$orderdish_id= NULL)
        {
            $type='add';
            $dish = orm::factory('dish',$dish_id);
            $this->template->content = View::factory('admin/dishes/order_dish')
                    ->set('type',$type)
                    ->set('dish', $dish);
        }
    public function action_dishorderedit($orderdish_id)
        {
            $type = 'edit' ;
            $dish_id =$_SESSION['cart_array'][$orderdish_id]['dish_id'];
            $dish = orm::factory('dish',$dish_id);
            $this->template->content = View::factory('admin/dishes/order_dish')
                    ->set('type',$type)
                    ->set('orderdish_id',$orderdish_id)
                    ->set('dish', $dish);
        }
    public function action_dishordercreate($dish_id,$orderdish_id= NULL)
	{
		$type = ($orderdish_id== NULL) ? 'add' : 'edit' ;
        $dish = orm::factory('dish',$dish_id);
		$this->template->content = View::factory('admin/dishes/order_dish')
                ->set('post', $_POST)
                ->set('dish', $dish)
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
                $orderdisharray=$_SESSION['cart_array'][$orderdish_id];
                }
                if ($type=='add') {
                    $orderdisharray=array();
                }
                $ingredients=array();
                $subs=array();
                foreach ($_POST as $key => $value) {
                    $ingredient=array();
                    $sub=array();
                    $swit=NULL;
                    if (strstr($key,'ingredient') !== FALSE )
                        $swit='ingredient' ;
                    if (strstr($key,'group') !==FALSE )
                            $swit='group';
                     if ( ! $swit)
                            $swit=$key;
                    switch ($swit) {
                        case ("ingredient"):
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
                            break;
                        case("group"):
                            if (!strstr($key,'rule')) {
                                $str3= str_replace('group_',"",$key);
                                $str2=strstr( $str3, '_');
                                $str=str_replace($str2,"",$str3);
                                if ($str==0 ||$str=='basic' || $str=='optional' ) break;
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
                $comments = (isset($_POST['comments'])) ? $_POST['comments'] : NULL;
                $orderdisharray=array('rest_id'=>$_SESSION['rest_id'],'dish_id'=>$dish_id,'quantity'=>$quantity,'price'=>$dishprice,'ingredients'=>$ingredients,'subs'=>$subs,'comments'=>$comments);

                if ($type=='add') {
                    array_push($_SESSION['cart_array'], $orderdisharray);
                }
                else {
                    $_SESSION['cart_array'][$orderdish_id]=$orderdisharray;
                }
				$this->request->redirect('main/dishes/'.$dish->restaurant->id);
				//echo debug::vars($_SESSION['cart_array']);
            }
                catch (ORM_Validation_Exception $e)
                {
                    $errors = $e->errors('models');
                }

        }
       // $this->_ajax = TRUE;
	}

} // End Welcome
