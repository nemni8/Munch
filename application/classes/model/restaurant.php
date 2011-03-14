<?php defined('SYSPATH') OR die('No Direct Script Access');

class Model_Restaurant extends ORM
{
	protected $_has_many = array(
		'categories' => array(
			'model' => 'category',
			'through' => 'categories_restaurants'
		)
	);

	protected $_belongs_to = array(
		'user' => array(),
	);

	/*protected $_rules = array(
		'name' => array('not_empty' => NULL),
		'user_id' => array('not_empty' => NULL)
	);
	*/

	protected $_filters = array(
		TRUE => array('trim' => NULL)
	);

	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('min_length', array(':value', 4)),
                array('max_length', array(':value', 32))
			),
		);
	}
	
	// col definitions for the CRUD functions
	public function get_col()
	{
		return
				array(
						'name'            => array('col_name' => 'name','title' => 'Rest Name', 'type' => 'text'),
						'street_num'      => array('col_name' => 'street_num','title' => 'Rest Street Num', 'type' => 'text'),
						'delivery_time'   => array('col_name' => 'delivery_time','title' => 'Max Time To Delivery', 'type' => 'text'),
						'delivery_cost'   => array('col_name' => 'delivery_cost','title' => 'Delivery Cost', 'type' => 'text'),
						'delivery_min'    => array('col_name' => 'delivery_min','title' => 'Delivery Min Fee', 'type' => 'text'),
						'address_comment' => array('col_name' => 'address_comment','title' => 'Rest Address Comment', 'type' => 'textarea'),
						'phone'           => array('col_name' => 'phone','title' => 'Rest Main Phone', 'type' => 'text'),
						'phone2'          => array('col_name' => 'phone2','title' => 'Rest Sub Phone', 'type' => 'text'),
						'email' 		  => array('col_name' => 'email','title' => 'Rest E-Mail', 'type' => 'text'),
						'fax'      		  => array('col_name' => 'fax','title' => 'Rest Fax', 'type' => 'text'),
						'about'           => array('col_name' => 'about','title' => 'About', 'type' => 'textarea')
				 )
		;
	}
	protected $_created_column = array('column' => 'created',  'format' => 'Y-m-d H:i:s');
	protected $_updated_column = array('column' => 'modified', 'format' => 'Y-m-d H:i:s');
/*	public function add_new($post)
	{
		$this->values($post);
        if( ! empty($post['active']))
		    $this->active = $post['active'];
		$this->save();
		if(isset($post['category_id']))
		{
			$this->remove('categories');
			foreach($post['category_id'] as $cat)
			{
					$this->add('categories',$cat);
			}
		}

	}*/
	public function get_user_restaurants($id)
	{
		return DB::select()->from('restaurants')->where('user_id','=',$id)->as_object()->execute();
	}
	public function get_all_restaurants()
	{
		return DB::select()->from('restaurants')->as_object()->execute();
	}
	public static function convert()
	{
		return TRUE;
	}
};

// End Model_Restaurant