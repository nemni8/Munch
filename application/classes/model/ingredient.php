<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ingredient extends ORM
{
	protected $_rules = array(
		'id' => array('not_empty' => NULL),
		'name' => array('not_empty' => NULL),
		'ingredient_cat_id' => array('not_empty' => NULL),
        'approval_level' => array('not_empty' => NULL)
	);

	public function get_col()
	{
		return
				array(
						//'id'   => array('col_name' => 'id','title' => 'Ingredient Id', 'type' => 'int'),
						'name'      => array('col_name' => 'name','title' => 'Ingredient Name', 'type' => 'text'),
		    		    //'ingredient_cat_id'   => array('col_name' => 'ingredient_cat_id','title' => 'Meat Dairy Parve', 'type' => 'int'),
                        // 'approval_level'   => array('col_name' => 'approval_level','title' => 'User Password', 'type' => 'int'),
				 )
		;
	}
	public function get_all_ingredients()
	{
		return DB::select()->from('ingredients')->as_object()->execute();
	}

	public function add_new($post,$admin_level)
	{
		$ingredient = ORM::factory('ingredient');
		$ingredient->name = $post['name'];
		$ingredient->ingredient_cat_id = $post['ingredient_cat_id'];
		$ingredient->approval_level = $admin_level ;
		$ingredient->save();
        
	}
	public function edit($post,$admin_level)
	{

		$this->name = $post['name'];
		$this->ingredient_cat_id = $post['ingredient_cat_id'];
        $this->approval_level = $admin_level;
		$this->save();


	}
} // End User Model