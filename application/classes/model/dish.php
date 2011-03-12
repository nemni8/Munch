<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Dish extends ORM
{
	protected $_has_many = array(
		'ingredients' => array(
			'model' => 'ingredient',
			'through' => 'ingredients_dishes'
		),
      
        'categories' => array(
			'model' => 'category',
			'through' => 'categories_dishes'
		)
	);
    protected $_belongs_to = array(
		'restaurant' => array(),
	);

	protected $_rules = array(
		'id' => array('not_empty' => NULL),
		'name' => array('not_empty' => NULL),
		'rest_id' => array('not_empty' => NULL),

	);

	public function get_col()
	{
		return
				array(
					    'name'          => array('col_name' => 'name','title' => 'Dish Name', 'type' => 'text'),
                        'price'          => array('col_name' => 'price','title' => 'Price ', 'type' => 'double'),
                        'price'          => array('col_name' => 'size','title' => 'Size ', 'type' => 'text'),
                        'description'   => array('col_name' => 'description','title' => 'Description', 'type' => 'text'),
                        
				 )
		;
	}
	public function get_all_ingredients()
	{
		return DB::select()->from('dishes')->as_object()->execute();
	}
public function get_all_ingredients_visible_for_rest($id)
    {
    return DB::select()->from('dishes')->where('rest_id','=',$id)->as_object()->execute();
    }
	public function add_new($post)
	{
		$dish = ORM::factory('dish');
		$dish->name = $post['name'];
        $dish->price = $post['price'];
        $dish->size = $post['size'];
		$dish->description = $post['description'];
        $dish->mdv = $post('mdv');
        $dish->save();
		//if(isset($post['category_id']))
		//{
		//	foreach($post['category_id'] as $cat)
		//	{
		//			$ingredient->add('categories',$cat);
		//	}
		//}


	}
	public function edit($post)
	{

		$this->name = $post['name'];
        $this->price = $post['price'];
        $this->size = $post['size'];
        $this->description = $post['description'];
        $this->mdv = $post('mdv');
        $this->save();

		//if(isset($post['category_id']))
		//{
		//	$this->remove('categories');
		//	/*add category*/
		//	foreach($post['category_id'] as $cat)
		//	{
		//			$this->add('categories',$cat);
		//	}
		//}


	}
} // End Ingredient Model