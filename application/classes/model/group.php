<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Group extends ORM
{
    protected $_belongs_to = array(
		'dish' => array(),
	);
	protected $_has_many = array(
		'subs' => array(),
	);
	public function get_all_groups_in_dish($id)
    {
    	return DB::select()->from('groups')->where('dish_id','=',$id)->as_object()->execute();
    }

} 