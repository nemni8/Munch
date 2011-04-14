<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ordersdishesingredient extends ORM
{
    protected $_table_name = 'orders_dishes_ingredients';
    protected $_belongs_to= array();


    public function action_add($ordersdish_id,$ingredient_id,$price=NULL){


            $ordersdishesingredient = ORM::factory('ordersdishesingredient');
            $ordersdishesingredient->orders_dishes_id=$ordersdish_id;
            $ordersdishesingredient->ingredient_id=$ingredient_id;
            if (!$price) {
                $dish_id=orm::factory('ordersdish',$ordersdish_id)->dish_id;
                $temp=orm::factory('dishesingredient')->where('dish_id','=',$dish_id)->and_where('ingredient_id','=',$ingredient_id)->find();
                $ordersdishesingredient->price=  $temp->price ;
            }
            else {
                $ordersdishesingredient->price=  $price  ;
            }
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
        //$this->request->redirect(Route::get('admin')->uri());

    }

    } 