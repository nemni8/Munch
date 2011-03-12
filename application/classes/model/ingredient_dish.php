<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ingredient_Dish extends ORM
{
	protected $_belongs_to= array(
		'dish' =>array(),
        'ingredient' =>array()
		);


	protected $_rules = array(
		'id' => array('not_empty' => NULL),
		'dish_id' => array('not_empty' => NULL),
		'ingredient_id' => array('not_empty' => NULL),

	);


	public function get_all_ingredients_in_dish($dish_id)
	{
		return DB::select()->from('ingredients_dishes')->where('dish_id','=',$dish_id)->as_object()->execute();
	}

	public function add_new($post)
	{
		$ingredient_dish = ORM::factory('$ingredient_dish');
		$ingredient_dish->dish_id = $post['dish_id'];
        $ingredient_dish->ingredient_id = $post('ingredient_id');
		$ingredient_dish->basic_optional = $post['basic_optional'];
		$ingredient_dish->save();
		

        
	}
	public function edit($post,$admin_level)
	{

		$this->basic_optional = $post['basic_optional'];
        $this->save();
		

	}
} // End Ingredient Model