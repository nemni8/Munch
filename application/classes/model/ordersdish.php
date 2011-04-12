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
                'model' => 'ordersdishesgroupssub',
                'through' => 'orders_dishes_subs',
                'foreign_key' => 'orders_dishes_id',
            ),
        );
    public function get_ingredients_in_order_dish()
    {
        return DB::select('ingredient_id')->from('orders_dishes_ingredients')->where('orders_dishes_id','=',$this->id)->as_object()->execute();
    }
    public function is_ingredient_in_order_dish($ingredient_id)
    {
       $temp =  orm::factory('ordersdishesingredient')->where('orders_dishes_id','=',$this->id)->and_where('ingredient_id','=',$ingredient_id)->find();
       return (isset ($temp->id));
    }
    public function get_subs_in_order_dish()
    {
        return DB::select('subs_id')->from('orders_dishes_subs')->where('orders_dishes_id','=',$this->id)->as_object()->execute();
    }
    public function is_sub_in_order_dish($sub_id)
    {
        $temp = orm::factory('ordersdishesgroupssub')->where('orders_dishes_id','=',$this->id)->and_where('sub_id','=',$sub_id)->find();;

        return (isset ($temp->id));
    }
    
    public function action_add($order_id,$dish_id){


            $this->order_id=$order_id;
            $this->dish_id=$dish_id;
            $this->save();
        }

        public function action_edit($id,$type,$value)
        {

            //$ordersdish = ORM::factory('ordersdish', $id);
            $this->$type=$value;
            $this->save();


        }

    public function action_delete($id)
    {
        //$ordersdish = ORM::factory('ordersdish',$id);
        $this->remove('ingredients');
        $this->remove('groupssubs');
        $this->delete();
        //$this->request->redirect(Route::get('admin')->uri());

    }

    } 