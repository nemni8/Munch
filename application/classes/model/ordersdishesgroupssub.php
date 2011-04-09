<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ordersdishessubgroup extends ORM
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


        $ordersdishessubgroup = ORM::factory('ordersdishessubgroup');
        $ordersdishessubgroup->orders_dishes_id=$ordersdish_id;
        $ordersdishessubgroup->group_id=$group_id;
        $ordersdishessubgroup->sub_id=$sub_id;
        $ordersdishessubgroup->price= (!$price) ? $price : 0 ;
        $ordersdishessubgroup->save();
    }

    public function action_edit($id,$type,$value)
    {

        $ordersdishessubgroup = ORM::factory('ordersdishessubgroup', $id);
        $ordersdishessubgroup->$type=$value;
        $ordersdishessubgroup->save();


    }

    public function action_delete($id)
    {
        $ordersdishessubgroup = ORM::factory('ordersdishessubgroup',$id);
        $ordersdishessubgroup->delete();
        $this->request->redirect(Route::get('admin')->uri());

    }

    } 