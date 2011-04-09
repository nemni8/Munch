<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ordersdishesingredient extends ORM
{
    protected $_table_name = 'orders_dishes_ingredients';
    protected $_belongs_to= array();


    /*public function action_add($ordersdish_id,$ingredient_id,$price=NULL){


            $ordersdishesingredient = ORM::factory('ordersdishesingredient');
            $ordersdishesingredient->orders_dishes_id=$ordersdish_id;
            $ordersdishesingredient->ingredient_id=$ingredient_id;
            $ordersdishesingredient->price= (!$price) ? $price : 0 ;
            $ordersdishesingredient->save();
    }

    public function action_edit($id,$type,$value)
    {

        $ordersdishesingredient = ORM::factory('ordersdishesingredient', $id);
        $ordersdishesingredient->$type=$value;
        $ordersdishesingredient->save();


    }

    public function action_delete($id)
    {
        $ordersdishesingredient = ORM::factory('ordersdishesingredient',$id);
        $ordersdishesingredient->delete();
        $this->request->redirect(Route::get('admin')->uri());

    }*/

    } 