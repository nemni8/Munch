<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Dishesingredient extends ORM
{
   protected $_table_name = 'dishes_ingredients';
	protected $_belongs_to= array(
		'dish' =>array(),
        'ingredient' =>array()
		);
	protected $_rules = array(
		'id' => array('not_empty' => NULL),
		'dish_id' => array('not_empty' => NULL),
		'ingredient_id' => array('not_empty' => NULL),

	);

public function get_dishingredient_id($dish_id,$ingredient_id )
    {
    return DB::select('id')->from('dishes_ingredients')->where('dish_id','=',$dish_id)->
            and_where('ingredient_id','=',$ingredient_id )->as_object()->execute();
    }

public function get_all_ingredients_in_dish($id)
    {
    return DB::select()->from('dishes_ingredients')->where('dish_id','=',$id)->as_object()->execute();
    }
	public function add_new($a,$b,$c)
	{
		$dishesingredient = ORM::factory('dishesingredient');
		$dishesingredient->dish_id = $a;
       $dishesingredient->ingredient_id = $b;
		$dishesingredient->basic_optional = $c;
		$dishesingredient->save();



	}
	public function edit($a,$b,$c)
	{

		$this->basic_optional = $post['basic_optional'];
        $this->save();


	}
} // End Ingredient Model