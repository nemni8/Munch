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
		'name' => array('not_empty' => NULL)
	);

	protected $_filters = array(
		TRUE => array('trim' => NULL)
	);

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

	public static function convert()
	{
		return TRUE;
	}
};

// End Model_Restaurant