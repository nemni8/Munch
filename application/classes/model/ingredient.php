<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ingredient extends ORM
{
	protected $_has_many = array(
		'categories' => array(
			'model' => 'category',
			'through' => 'categories_ingredients'
		),
        'dishes' => array(
			'model' => 'dish',
			'through' => 'ingredients_dishes'
		)
	);

	protected $_rules = array(
		'id' => array('not_empty' => NULL),
		'name' => array('not_empty' => NULL),
		'user_id' => array('not_empty' => NULL),
        'approval_level' => array('not_empty' => NULL)
	);

	public function get_col()
	{
		return
				array(
						'name'          => array('col_name' => 'name','title' => 'Ingredient Name', 'type' => 'text'),
						'description'   => array('col_name' => 'description','title' => 'Ingredient Description', 'type' => 'text'),
				 )
		;
	}
	public function get_all_ingredients()
	{
		return DB::select()->from('ingredients')->as_object()->execute();
	}
public function get_all_ingredients_visible_for_user($id)
    {
    return DB::select()->from('ingredients')->where('user_id','=',$id)->or_where( 'user_id','=',0)->as_object()->execute();
    }

} // End Ingredient Model