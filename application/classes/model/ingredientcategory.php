<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ingredientcategory extends ORM
{
	protected $_rules = array(
		'id' => array('not_empty' => NULL),
		'name' => array('not_empty' => NULL),

	);

	public function get_col()
	{
		return
				array(

						'name'      => array('col_name' => 'name','title' => 'Category Name', 'type' => 'text'),

				 )
		;
	}
	public function get_all_ingredientcategories()
	{
		return DB::select()->from('ingredientcategories')->as_object()->execute();
	}

	public function add_new($post)
	{
		$ingredientcategory = ORM::factory('ingredientcategory');
		$ingredientcategory->name = $post['name'];

		$ingredientcategory->save();
        
	}
	public function edit($post)
	{

		$this->name = $post['name'];
		$this->save();


	}
} // End User Model