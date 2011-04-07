<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_City extends ORM
{
    protected $_has_many = array(
		'streets' => array(),
	);

	

} 