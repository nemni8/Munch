<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ingredient extends ORM
{
	protected $_has_many = array(
		'categories' => array(
			'model' => 'category',
			'through' => 'categories_ingredients'
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
	public function add_new($post,$admin_level)
	{
		$ingredient = ORM::factory('ingredient');
		$ingredient->name = $post['name'];
        $ingredient->approval_level=$admin_level;
		$ingredient->description = $post['description'];
		$ingredient->user_id = (!$admin_level) ? $_SESSION['auth_user_munch']->id  : 0 ;
        $ingredient->save();
		if(isset($post['category_id']))
		{
			foreach($post['category_id'] as $cat)
			{
					$ingredient->add('categories',$cat);
			}
		}

        
	}
	public function edit($post,$admin_level)
	{

		$this->name = $post['name'];
        $this->approval_level=$admin_level;
		if($admin_level)
			$this->user_id =  0 ;
		$this->save();
		if(isset($post['category_id']))
		{
			$this->remove('categories');
			/*add category*/
			foreach($post['category_id'] as $cat)
			{
					$this->add('categories',$cat);
			}
		}


	}
} // End Ingredient Model