<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ingredient extends ORM
{
	protected $_rules = array(
		'id' => array('not_empty' => NULL),
		'name' => array('not_empty' => NULL),
	//	'mdv' => array('not_empty' => NULL),
        'approval_level' => array('not_empty' => NULL)
	);

	public function get_col()
	{
		return
				array(
						//'id'   => array('col_name' => 'id','title' => 'Ingredient Id', 'type' => 'int'),
						'name'      => array('col_name' => 'name','title' => 'Ingredient Name', 'type' => 'text'),
						//  'mdv'   => array('col_name' => 'mdv','title' => 'Meat Dairy Parve', 'type' => 'int'),
                        // 'approval_level'   => array('col_name' => 'approval_level','title' => 'User Password', 'type' => 'int'),
				 )
		;
	}
	public function get_all_ingredients()
	{
		return DB::select()->from('ingredients')->as_object()->execute();
	}
	public function add_new($post)
	{
		$ingredient = ORM::factory('ingredient');
		$ingredient->name = $post['name'];
		$ingredient->mdv = $post['mdv'];
		if ( ! empty($is_admin))
		        $ingredient->approval_level = 2 ;
		if ( ! empty($is_supadmin))
		         $ingredient->approval_level = 3 ;
         $ingredient->save();
        
	}
	public function edit($post)
	{

		$this->name = $post['name'];
		$this->mdv = $post['mdv'];
        //$this->approval_level=1;
		if ( ! empty($is_admin))
		    $this->approval_level = 2 ;
		if ( ! empty($is_supadmin))
		    $this->approval_level = 3 ;
       	$this->save();


	}
} // End User Model