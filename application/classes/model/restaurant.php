<?php defined('SYSPATH') OR die('No Direct Script Access');

class Model_Restaurant extends ORM
{
	protected $_has_many = array(
		//'customers'      => array('through' => 'order_customers'),
		//'services'       => array('model'   => 'order_service'),
	);

	protected $_belongs_to = array(
		//'user' => array(),
	);

	protected $_rules = array(
		'name' => array('not_empty' => NULL),
		'user_id' => array('not_empty' => NULL)
	);

	protected $_filters = array(
		TRUE => array('trim' => NULL)
	);
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
	//protected $_created_column = array('column' => 'created',  'format' => 'Y-m-d H:i:s');
	//protected $_updated_column = array('column' => 'modified', 'format' => 'Y-m-d H:i:s');

	// table definitions
//	protected $_table = array(
//		'header' => array(
//			'id'                 => array('title' => 'ID'),
//			'source_id'          => array('title' => 'Source'),
//			'sourceId'           => array('title' => 'SourceId'),
//			'created'            => array('title' => 'Created'),
//			'contact_name'       => array('title' => 'Contact name'),
//			'contact_phone'      => array('title' => 'Phones'),
//			'customers'          => array('title' => 'Customers Count'),
//			'services'           => array('title' => 'Services'),
//			'services_statuses'  => array('title' => 'Services Statuses'),
//			'order_status_id'    => array('title' => 'Status'),
//			'user_id'            => array('title' => 'User'),
//			'agent_name'         => array('title' => 'Agent'),
//		),
//		'sort' => array('id' => 'desc')
//	);

	public function add_new($post)
	{
		$this->values($post);
		if($this->check())
		{
			$this->save();
			echo 'saved';
		}
		else
		{
			echo 'not saved';
		}
	}
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