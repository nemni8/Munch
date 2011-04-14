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



}

