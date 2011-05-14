<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Orders extends Controller_Template_Admin
{
    public function action_add(){

            $order = ORM::factory('order');
            $order->user_id=$_SESSION['auth_user_munch']->id;
            $order->save();
    }

    public function action_edit($id,$type,$value)
    {

        $order = ORM::factory('order', $id);
        if ($type=='timestamp') {
        // updating the timestamp NEED TO COMPLETE
        }
        else {
        $order->$type=$value;
        }
        $order->save();


    }

    public function action_delete($id)
    {
        $order = ORM::factory('order',$id);
        $orderdishes = ORM::factory('ordersdish')->where('order_id','=',$id)->find_all();
        foreach ($orderdishes as $orderdish) {
            $orderdish->remove('ingredients');
            $orderdish->remove('groupssubs');
        }

        $order->remove('ordersdishes');
        $order->delete();
        $this->request->redirect(Route::get('admin')->uri());

    }

    // ORDERS_DISHES FUNCTIONS
    public function action_addordersdish($order_id,$dish_id){


        $ordersdish = ORM::factory('ordersdish');
        $ordersdish->order_id=$order_id;
        $ordersdish->dish_id=$dish_id;
        $ordersdish->save();
    }

    public function action_editordersdish($id,$type,$value)
    {

        $ordersdish = ORM::factory('ordersdish', $id);
        $ordersdish->$type=$value;
        $ordersdish->save();


    }

    public function action_deleteordersdish($id)
    {
        $ordersdish = ORM::factory('ordersdish',$id);
        $ordersdish->remove('ingredients');
        $ordersdish->remove('groupssubs');
        $ordersdish->delete();
        $this->request->redirect(Route::get('admin')->uri());

    }

    // ORDERS DISHES INGREDIENT FUNCTIONS

    public function action_addordersdishesingredient($ordersdish_id,$ingredient_id,$price=NULL){


            $ordersdishesingredient = ORM::factory('ordersdishesingredient');
            $ordersdishesingredient->orders_dishes_id=$ordersdish_id;
            $ordersdishesingredient->ingredient_id=$ingredient_id;
            $ordersdishesingredient->price= (!$price) ? $price : 0 ;
            $ordersdishesingredient->save();
    }

    public function action_editordersdishesingredient($id,$type,$value)
    {

        $ordersdishesingredient = ORM::factory('ordersdishesingredient', $id);
        $ordersdishesingredient->$type=$value;
        $ordersdishesingredient->save();


    }

    public function action_deleteordersdishesingredient($id)
    {
        $ordersdishesingredient = ORM::factory('ordersdishesingredient',$id);
        $ordersdishesingredient->delete();
        $this->request->redirect(Route::get('admin')->uri());

    }

    // ORDERS DISHES GROUP SUBS FUNCTIONS

    public function action_addordersdishesgroupssub($ordersdish_id,$group_id,$sub_id,$price=NULL){


        $ordersdishesgroupssub = ORM::factory('ordersdishesgroupssub');
        $ordersdishesgroupssub->orders_dishes_id=$ordersdish_id;
        $ordersdishesgroupssub->group_id=$group_id;
        $ordersdishesgroupssub->sub_id=$sub_id;
        $ordersdishesgroupssub->price= (!$price) ? $price : 0 ;
        $ordersdishesgroupssub->save();
    }

    public function action_editordersdishesgroupssub($id,$type,$value)
    {

        $ordersdishesgroupssub = ORM::factory('ordersdishesgroupssub', $id);
        $ordersdishesgroupssub->$type=$value;
        $ordersdishesgroupssub->save();


    }

    public function action_deleteordersdishesgroupssub($id)
    {
        $ordersdishesgroupssub = ORM::factory('ordersdishesgroupssub',$id);
        $ordersdishesgroupssub->delete();
        $this->request->redirect(Route::get('admin')->uri());

    }
    public function action_cart(){

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //       Section 2 (if user chooses to empty their shopping cart)
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (isset($_POST['emptycart']) && $_POST['emptycart'] == "Empty Cart") {
            unset($_SESSION["cart_array"]);
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //       Section 3 (if user chooses to adjust item quantity)
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
            // execute some code
            $item_to_adjust = $_POST['item_to_adjust'];
            $quantity = $_POST['quantity'];
            $quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
            if ($quantity >= 100) { $quantity = 99; }
            if ($quantity < 1) { $quantity = 1; }
            if ($quantity == "") { $quantity = 1; }
            $_SESSION["cart_array"][$item_to_adjust]['quantity']=$quantity;
        /*	$i = 0;
            foreach ($_SESSION["cart_array"] as $each_item) {
                      $i++;
                      while (list($key, $value) = each($each_item)) {
                          if ($key == "item_id" && $value == $item_to_adjust) {
                              // That item is in cart already so let's adjust its quantity using array_splice()
                              array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));
                          } // close if condition
                      } // close while loop
            } // close foreach loop*/
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //       Section 4 (if user wants to remove an item from cart)
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
            // Access the array and run code to remove that array index
            $key_to_remove = $_POST['index_to_remove'];
            if (count($_SESSION["cart_array"]) <= 1) {
                unset($_SESSION["cart_array"]);
            } else {
                unset($_SESSION["cart_array"]["$key_to_remove"]);
                sort($_SESSION["cart_array"]);
            }
        }
		$this->request->redirect($_POST['current_url']);
    }
    public function action_checkout(){
        $this->template->content = View::factory('site/orders/checkout');


        if (isset($_POST['checkout']) && $_POST['total_price'] != "") {
            $order = ORM::factory('order');
            //$order->user_id=$_SESSION['auth_user_munch']->id; //NEED TO HANDLE USER ID IN SESSION
            $order->totalprice=$_POST['total_price'] ;
            echo debug::vars($order);
            $order->save();
            foreach ($_SESSION['cart_array'] as $key=>$dish) {
                $ordersdish = ORM::factory('ordersdish');
                $ordersdish->order_id=$order->id;
                $ordersdish->dish_id=$dish['dish_id'];
                $ordersdish->restaurant_id=$dish['rest_id'];
                $ordersdish->quantity=$dish['quantity'];
                $ordersdish->price=$dish['price'];
                $ordersdish->price=$dish['comments'];
                $ordersdish->save();
                if  (isset($dish['ingredients']) && $dish['ingredients'] != NULL) {
                    foreach ($dish['ingredients'] as $key=>$ingredient) {
                        $ordersdishesingredient=orm::factory('ordersdishesingredient');
                        $ordersdishesingredient->orders_dishes_id=$ordersdish->id;
                        $ordersdishesingredient->ingredient_id=$ingredient['ingredient_id'];
                        $ordersdishesingredient->price=$ingredient['price'];
                        $ordersdishesingredient->save();
                    }
                }
                if  (isset($dish['subs']) && $dish['subs'] != NULL) {
                    foreach ($dish['subs'] as $key=>$sub) {
                        $ordersdishesgroupssub=orm::factory('ordersdishesgroupssub');
                        $ordersdishesgroupssub->orders_dishes_id=$ordersdish->id;
                        $ordersdishesgroupssub->group_id=$sub['group_id'];
                        $ordersdishesgroupssub->sub_id=$sub['sub_id'];
                        $ordersdishesgroupssub->price=$sub['price'];
                        $ordersdishesgroupssub->save();
                    }
                }
            }
            session_unset();
        }


    }



}

