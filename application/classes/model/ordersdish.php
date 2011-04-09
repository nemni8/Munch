<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ordersdish extends ORM
{
    protected $_table_name = 'orders_dishes';
    protected $_belongs_to= array(
        'order' =>array()
        );
    protected $_has_many= array(
        'ingredients' =>array(
            'model' => 'ordersdishesingredient',
			'through' => 'orders_dishes_ingredients',
            'foreign_key' => 'orders_dishes_id',

        ),
        'groupssubs' =>array(
            'model' => 'ordersdishessubgroup',
            'through' => 'orders_dishes_subs',
            'foreign_key' => 'orders_dishes_id',
        ),
        );


    
    /*public function action_add($order_id,$dish_id){


            $ordersdish = ORM::factory('ordersdish');
            $ordersdish->order_id=$order_id;
            $ordersdish->dish_id=$dish_id;
            $ordersdish->save();
        }

        public function action_edit($id,$type,$value)
        {

            $ordersdish = ORM::factory('ordersdish', $id);
            $ordersdish->$type=$value;
            $ordersdish->save();


        }
        //public function action_create($id = NULL) {}

    public function action_delete($id)
    {
        $ordersdish = ORM::factory('ordersdish',$id);
        $ordersdish->remove('ordersdishesingredients');
        $ordersdish->remove('ordersdishessubgroups');
        $ordersdish->delete();
        $this->request->redirect(Route::get('admin')->uri());

    }*/

    } // End Ingredient Model