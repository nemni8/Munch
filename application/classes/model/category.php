<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Category extends ORM
{
	protected $_has_many = array(
		'ingredients' => array(
			'model' => 'ingredient',
			'through' => 'categories_ingredients'
		),
		'restaurants' => array(
			'model' => 'restaurant',
			'through' => 'categories_restaurants'
		)
	);

	protected $_rules = array(
		'id' => array('not_empty' => NULL),
		'name' => array('not_empty' => NULL),
		'model' => array('not_empty' => NULL),
	);

	public function get_col()
	{
		return
				array(
						'name'          => array('col_name' => 'name','title' => 'Category Name', 'type' => 'text'),
						'description'   => array('col_name' => 'description','title' => 'Category Description', 'type' => 'text'),
				 )
		;
	}
	public function get_all_categories($model = NULL)
	{
		return ( ! empty($model)) ?
									DB::select()->from('categories')->where('model','=',$model)->as_object()->execute() :
									DB::select()->from('categories')->as_object()->execute();
	}

	public function add_new($post)
	{
		$category = ORM::factory('category');
		$category->name = $post['name'];
		$category->model = $post['model'];
		$category->description = $post['description'];
		$category->save();
        
	}
	public function edit($post)
	{

		$this->name = $post['name'];
		$this->model = $post['model'];
        $this->description = $post['description'];
		$this->save();


	}
} // End Category Model