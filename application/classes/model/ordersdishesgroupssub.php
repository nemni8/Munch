<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ordersdishesgroupssub extends ORM
{
    protected $_table_name = 'orders_dishes_subs';
    protected $_belongs_to= array(
        'ordersdish' =>array('foreign_key' => 'orders_dishes_id')
        );

    /*protected $_rules = array(
        'id' => array('not_empty' => NULL),
        'dish_id' => array('not_empty' => NULL),
        'ingredient_id' => array('not_empty' => NULL),

    );*/
    public function action_add($ordersdish_id,$group_id,$sub_id,$price=NULL){


        $ordersdishesgroupssub = ORM::factory('ordersdishesgroupssub');
        $ordersdishesgroupssub->orders_dishes_id=$ordersdish_id;
        $ordersdishesgroupssub->group_id=$group_id;
        $ordersdishesgroupssub->sub_id=$sub_id;
        $ordersdishesgroupssub->price= (!$price) ? $price : 0 ;
        $ordersdishesgroupssub->save();
    }

    public function action_edit($id,$type,$value)
    {

        $ordersdishesgroupssub = ORM::factory('ordersdishesgroupssub', $id);
        $ordersdishesgroupssub->$type=$value;
        $ordersdishesgroupssub->save();


    }

    public function action_delete($id)
    {
        $ordersdishesgroupssub = ORM::factory('ordersdishesgroupssub',$id);
        $ordersdishesgroupssub->delete();
        //$this->request->redirect(Route::get('admin')->uri());

    }

    } 